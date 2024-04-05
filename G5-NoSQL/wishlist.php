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
        // Obtener los detalles de los productos favoritos del usuario
        $favoritos = $db->Favoritos->findOne(['idUsuario' => new MongoDB\BSON\ObjectId($userId)]);
        // Verificar si se encontraron productos favoritos para este usuario
        if ($favoritos) {
            // Obtener los IDs de los productos favoritos
            $productoIds = $favoritos->Items;
            // Convertir BSONArray a array de PHP
            $productoIdsArray = iterator_to_array($productoIds);
            // Convertir los IDs de producto a objetos ObjectId
            $productoIdsObject = array_map(function($id) { return new MongoDB\BSON\ObjectId($id); }, $productoIdsArray);
            // Consultar los detalles de los productos favoritos por sus IDs
            $productos = $db->Productos->find(['_id' => ['$in' => $productoIdsObject]]);
    ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Colección</a></li>
                    <li class="breadcrumb-item active">Mi Lista de Favoritos</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Wishlist Start -->
        <div class="wishlist-page">
            <div class="container-fluid">
                <div class="wishlist-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Prenda</th>
                                            <th>Precio</th>
                                            <th>Talla</th>
                                            <th>Color</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                    <?php foreach ($productos as $producto) { ?>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="<?php echo $producto['Imagen']; ?>" alt="Image"></a>
                                                    <p><?php echo $producto['Nombre']; ?></p>
                                                </div>
                                            </td>
                                            <td>₡<?php echo $producto['Precio']; ?></td>
                                            <td><?php echo $producto['Talla']; ?></td>
                                            <td><?php echo $producto['Color']; ?></td>
                                            <!-- <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td> -->
                                            <td>
                                                <button class="btn-cart-product" data-id="<?php echo $producto['_id']; ?>"><i class="fa fa-shopping-cart"></i></button>
                                                <button class="btn-delete-product-favorite" data-id="<?php echo $producto['_id']; ?>"><i class="fa fa-trash"></i></button>
                                                <!-- <a href="deleteFavorite.php?id=<?php echo $producto['_id']; ?>"><i class="fa fa-trash"></i></a> -->
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="img/product-7.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td><button class="btn-cart">Add to Cart</button></td>
                                            <td><button><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="img/product-8.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td><button class="btn-cart">Add to Cart</button></td>
                                            <td><button><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="img/product-9.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td><button class="btn-cart">Add to Cart</button></td>
                                            <td><button><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="img/product-10.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td><button class="btn-cart">Add to Cart</button></td>
                                            <td><button><i class="fa fa-trash"></i></button></td>
                                        </tr> -->
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wishlist End -->
        <?php include 'layout\footer.php'; ?>
        <script src="js/deleteFavorite.js"></script>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prenda añadida al Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¡Prenda añadida al Carrito con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="addItemFailedModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al añadir Prenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al añadir la prenda, inténtalo de nuevo más tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
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
                                    <label>Aún no has agregado prendas a tu lista de Favoritos</label>
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
                                <label>Inicia sesión o registrate para agregar prendas a tu lista de favoritos</label>
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