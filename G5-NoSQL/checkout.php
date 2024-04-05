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
        <?php include 'layout\navbar.php'; ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Carrito</a></li>
                    <li class="breadcrumb-item active">Confirmar Compra</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Detalles de la Compra</h2>
                                <?php
                                require 'getUser.php'; // Asegúrate de incluir el archivo que contiene la función getUserData
                                // Verificar si el usuario ha iniciado sesión y obtener su ID
                                if (isset($_SESSION['id'])) {
                                    $userId = $_SESSION['id'];
                                    // Obtener los datos del usuario
                                    $userData = getUserData($userId);

                                    // Verificar si se obtuvieron los datos del usuario correctamente
                                    if ($userData) {
                                        // Mostrar los datos del usuario en los campos del formulario
                                        $nombre = $userData['Nombre'];
                                        $apellidos = $userData['Apellidos'];
                                        $telefono = $userData['Telefono'];
                                        $email = $userData['Correo'];
                                        $direccion = $userData['DireccionEnvio'];
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" value="<?php echo $nombre; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Apellidos</label>
                                        <input class="form-control" type="text" value="<?php echo $apellidos; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Correo</label>
                                        <input class="form-control" type="text" value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>No.Teléfono</label>
                                        <input class="form-control" type="text" value="<?php echo $telefono; ?>" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Dirección de Envío</label>
                                        <input class="form-control" type="text" value="<?php echo $direccion; ?>" readonly>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" placeholder="ZIP Code">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="newaccount">
                                            <label class="custom-control-label" for="newaccount">Create an account</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="shipto">
                                            <label class="custom-control-label" for="shipto">Ship to different address</label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <?php
                            $db = connectDB();
                            // Obtener los detalles de los productos en el carrito del usuario
                            $carrito = $db->Carrito->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
                            // Obtener los Items del carrito
                            $items = $carrito->Items;
                            // Inicializar un array para almacenar los IDs de los productos en el carrito
                            $productoIds = [];
                            // Inicializar un array para almacenar las cantidades de los productos en el carrito
                            $cantidades = [];
                            // Inicializar un array para almacenar los items del pedido
                            $itemsPedido = [];
                            // Iterar sobre los Items del carrito y obtener los IDs de los productos y sus cantidades
                            foreach ($items as $item) {
                                // Agregar el ID del producto al array
                                $productoIds[] = $item->productoId;
                                // Agregar la cantidad del producto al array
                                $cantidades[] = $item->cantidad;
                                // Crear un array asociativo para cada item
                                $itemPedido = [
                                    'idProducto' => new MongoDB\BSON\ObjectId($item->productoId),
                                    'cantidad' => $item->cantidad
                                ];
                                // Agregar el item al array de items del pedido
                                $itemsPedido[] = $itemPedido;
                            }
                            // Consultar los detalles de los productos en el carrito por sus IDs
                            $productos = $db->Productos->find(['_id' => ['$in' => $productoIds]]);
                            // Convertir el array de items a una cadena JSON
                            $itemsJson = json_encode($itemsPedido);
                            ?>  
                            <div class="billing-address">
                                <div class="wishlist-page">
                                    <div class="wishlist-page-inner">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>Prenda</th>
                                                                <th>Talla</th>
                                                                <th>Color</th>
                                                                <th>Precio</th>
                                                                <th>Cantidad</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="align-middle">
                                                            <?php 
                                                            // Inicializar el total
                                                            $total = 0;
                                                            // Variable para almacenar los detalles de la factura
                                                            $detalleFactura = '';
                                                            foreach ($productos as $contador => $producto) { 
                                                                // Obtener la cantidad de productos en el carrito
                                                                $cantidad = $cantidades[$contador];
                                                                // Obtener el precio del producto
                                                                $precio = $producto['Precio'];
                                                                // Calcular el monto total para este producto
                                                                $montoTotal = $cantidad * $precio;
                                                                // Sumar el monto total al total general
                                                                $total += $montoTotal;
                                                                // Agregar el detalle de la factura para este producto a la variable
                                                                $detalleFactura .= '<p>' . $cantidad . ' ' . $producto['Nombre'] . '<span>₡' . $montoTotal . '</span></p>';
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="img">
                                                                        <a href="#"><img src="<?php echo $producto['Imagen']; ?>" alt="Image"></a>
                                                                        <p><?php echo $producto['Nombre']; ?></p>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $producto['Talla']; ?></td>
                                                                <td><?php echo $producto['Color']; ?></td>
                                                                <td>₡<?php echo $producto['Precio']; ?></td>
                                                                <td>
                                                                    <div class="qty">
                                                                        <!-- <button class="btn-minus"><i class="fa fa-minus"></i></button> -->
                                                                        <input type="text" value="<?php echo $cantidad; ?>">
                                                                        <!-- <button class="btn-plus"><i class="fa fa-plus"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td>₡<?php echo $montoTotal; ?></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="shipping-address">
                                <h2>Shipping Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text" placeholder="Mobile No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Total del Carrito</h1>
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
                                <!-- <p><?php echo $cantidad; ?> <?php echo $producto['Nombre']; ?><span>₡<?php echo $montoTotal; ?></span></p> -->
                                <?php echo $detalleFactura; ?>
                                <p class="sub-total">Sub Total<span>₡<?php echo $subtotalNeto; ?></span></p>
                                <p class="ship-cost">Costo de Envío<span>₡1500</span></p>
                                <p class="ship-cost">Impuestos<span>₡<?php echo $iva; ?></span></p>
                                <h2>Total<span>₡<?php echo $totalGeneral; ?></span></h2>
                            </div>
                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Métodos de Pago</h1>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-3" name="payment">
                                            <label class="custom-control-label" for="payment-3">Tarjeta de Crédito</label>
                                        </div>
                                        <!-- <div class="payment-content" id="payment-3-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div> -->
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-5" name="payment">
                                            <label class="custom-control-label" for="payment-5">Efectivo en la Entrega</label>
                                        </div>
                                        <!-- <div class="payment-content" id="payment-5-show">
                                            <p>
                                                Al llegar nuestro mensajero con su paquete, debe cancelarle el monto de su compra en efectivo y completo.
                                            </p>
                                        </div> -->
                                    </div>
                                </div>
                                <form id="checkout" action="createOrder.php" method="post">
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                                    <input type="hidden" name="direccion" value="<?php echo $direccion; ?>">
                                    <input type="hidden" name="total" value="<?php echo $totalGeneral; ?>">
                                    <input type="hidden" name="items" value='<?php echo $itemsJson; ?>'>
                                    <div class="checkout-btn">
                                        <button type="submit">Completar Pedido</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->
        <?php include 'layout\footer.php'; ?>
    </body>
</html>
