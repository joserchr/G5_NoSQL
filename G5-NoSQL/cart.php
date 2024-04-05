<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E Store - eCommerce HTML Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">
        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php
    include 'layout\navbar.php';
    require 'connectDB.php';
    // Verificar si hay una sesión de usuario iniciada
    if (isset($_SESSION['id'])) {
        // Obtener el ID del usuario almacenado en la sesión
        $userId = $_SESSION['id'];
        // Conectar a la base de datos MongoDB
        $db = connectDB();
        // Obtener los detalles de los productos en el carrito del usuario
        $carrito = $db->Carrito->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
        // Verificar si se encontraron productos en el carrito para este usuario
        if ($carrito) {
            // Obtener los Items del carrito
            $items = $carrito->Items;
            // Inicializar un array para almacenar los IDs de los productos en el carrito
            $productoIds = [];
            // Inicializar un array para almacenar las cantidades de los productos en el carrito
            $cantidades = [];
            // Iterar sobre los Items del carrito y obtener los IDs de los productos y sus cantidades
            foreach ($items as $item) {
                // Agregar el ID del producto al array
                $productoIds[] = $item->productoId;
                // Agregar la cantidad del producto al array
                $cantidades[] = $item->cantidad;
            }
            // Consultar los detalles de los productos en el carrito por sus IDs
            $productos = $db->Productos->find(['_id' => ['$in' => $productoIds]]);
    ?>  
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Colección</a></li>
                    <li class="breadcrumb-item active">Carrito</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                    <?php 
                                        // Inicializar el total
                                        $total = 0;
                                        foreach ($productos as $contador => $producto) { 
                                            // Obtener la cantidad de productos en el carrito
                                            $cantidad = $cantidades[$contador];
                                            // Obtener el precio del producto
                                            $precio = $producto['Precio'];
                                            // Calcular el monto total para este producto
                                            $montoTotal = $cantidad * $precio;
                                            // Sumar el monto total al total general
                                            $total += $montoTotal;
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="<?php echo $producto['Imagen']; ?>" alt="Image"></a>
                                                    <p><?php echo $producto['Nombre']; ?></p>
                                                </div>
                                            </td>
                                            <td>₡<?php echo $producto['Precio']; ?></td>
                                            <td>
                                                <div class="qty">
                                                    <!-- <button class="btn-minus"><i class="fa fa-minus"></i></button> -->
                                                    <input type="text" value="<?php echo $cantidad; ?>">
                                                    <!-- <button class="btn-plus"><i class="fa fa-plus"></i></button> -->
                                                </div>
                                            </td>
                                            <td>₡<?php echo $montoTotal; ?></td>
                                            <td>
                                                <button class="btn-delete-product" data-id="<?php echo $producto['_id']; ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <div class="coupon">
                                        <input type="text" placeholder="Coupon Code">
                                        <button>Apply Code</button>
                                    </div> -->
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Resumen del Carrito</h1>
                                            <?php 
                                                // Verificar si el total es igual a 0
                                                if ($total == 0) {
                                                    // Si el total es igual a 0, el envío también será 0
                                                    $envio = 0;
                                                } else {
                                                    // Si el total es diferente de 0, se cobra el envío normalmente
                                                    $envio = 1500;
                                                }
                                                // Calcular el IVA
                                                $iva = $total * 0.13;
                                                $subtotalNeto = $total - $iva;
                                                // Calcular el total general (subtotal + envío + IVA)
                                                $totalGeneral = $subtotalNeto + $iva + $envio;
                                            ?>
                                            <p>Sub Total<span>₡<?php echo $subtotalNeto; ?></span></p>
                                            <p>Costo de Envío<span>₡1500</span></p>
                                            <p>Impuestos<span>₡<?php echo $iva; ?></span></p>
                                            <h2>Total<span>₡<?php echo $totalGeneral; ?></span></h2>
                                        </div>
                                        <div class="cart-btn mt-3">
                                            <a class="btn ml-5 mr-5" href="product-list.php">Seguir Comprando</button>
                                            <a class="btn" href="checkout.php">Pagar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
         <!-- Wishlist End -->
         <?php include 'layout\footer.php'; ?>
        <script src="js/deleteCart.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Prenda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¿Está seguro(a) que desea eliminar la prenda?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary" id="confirmDeleteButton">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="deletePrendaFallida" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al eliminar la prenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al eliminar la prenda</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    } else {
        // No se encontraron productos favoritos para este usuario
        echo '<div class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="login-form">
                        <h4 class="text-center">¿Aún no te decides?</h4>
                        <form id="userLogin" method="post">
                            <div class="row">
                                <div class="col-md-12 mx-auto text-center">
                                    <label>Aún no has agregado prendas al Carrito</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="product-list.php" type="button" class="btn">Ver Colección</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    include 'layout\footer.php'; 
    }
} else {
    // Si no hay una sesión de usuario, recomienda al usuario iniciar sesión
    echo '<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="login-form">
                    <h4 class="text-center">Iniciar Sesión</h4>
                    <form id="userLogin" method="post">
                        <div class="row">
                            <div class="col-md-12 mx-auto text-center">
                                <label>Inicia sesión o registrate para agregar prendas al carrito</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mt-4">
                                <a class="btn mr-5" href="register.php">Registrarse</a>
                                <a class="btn mr-5" href="login.php">Iniciar Sesión</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
include 'layout\footer.php';
   
}
?>