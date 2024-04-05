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
        // Conectar a la base de datos
        $db = connectDB();
        // Consultar los productos
        $pedidos = $db->Pedidos->find();
        // Función para obtener el nombre del usuario por su ID
        function obtenerNombreUsuario($userId, $db) {
            $usuario = $db->Usuarios->findOne(['_id' => new MongoDB\BSON\ObjectID($userId)]);
            return $usuario ? $usuario->Nombre : 'Desconocido';
        }
        ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Pedidos</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Recent Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Pedidos de Venta</h1>
                    <!-- Botón para agregar una nueva prenda 
                    <a href="addItem.php" type="button" class="btn">
                        <i class="fa fa-plus"></i> Agregar Prenda
                    </a> -->
                </div>
            </div>
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
                                                <th>No.Pedido</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <!-- <th>Dirección de Envio</th> -->
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php foreach ($pedidos as $pedido): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($pedido->_id); ?></td>
                                                <td><?php echo obtenerNombreUsuario($pedido->idUsuario, $db); ?></td>
                                                <td><?php echo htmlspecialchars($pedido->Fecha); ?></td>
                                                <!-- <td><?php echo htmlspecialchars($pedido->DireccionEnvio); ?></td> -->
                                                <td>₡<?php echo htmlspecialchars($pedido->Total); ?></td>
                                                <td>
                                                    <select class="form-control" id="estado" name="estado">
                                                        <option value="Pendiente" <?php echo ($pedido->Estado == "Pendiente") ? "selected" : ""; ?>>Pendiente</option>
                                                        <option value="En Proceso" <?php echo ($pedido->Estado == "En Proceso") ? "selected" : ""; ?>>En Proceso</option>
                                                        <option value="Entregado" <?php echo ($pedido->Estado == "Entregado") ? "selected" : ""; ?>>Entregado</option>
                                                    </select>
                                                </td> 
                                                <td>
                                                    <button class="btn ver-prendas" data-id="<?php echo $pedido->_id;?>"><i class="fa fa-eye"></i></button>
                                                    <button class="btn-save-order" data-id="<?php echo $pedido->_id; ?>"><i class="fa fa-save"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wishlist End -->
        </div>
        <?php include 'layout\footer.php'; ?>
        <script src="js/pedidos.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="viewItems" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Agrega la clase modal-lg aquí -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="actualizacionOrdenExitosaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Orden Actualizada Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡La Orden se actualizó correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="actualizacionOrdenFallidaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al actualizar la orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al actualizar la orden, inténtalo de nuevo más tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>