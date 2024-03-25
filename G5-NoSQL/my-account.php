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
        <!-- My Account Start -->
        <div class="my-account">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                            <!-- <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i>Dashboard</a> -->
                            <a class="nav-link active" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Detalles de mi Cuenta</a>
                            <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>
                            <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Payment Method</a>
                            <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>address</a>
                            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i>Cerrar Sesión</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                                <h4>Dashboard</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                                </p> 
                            </div> -->
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
                            <div class="tab-pane fade show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                                <form id="editUser" method="post">
                                    <h4>Detalles de mi Cuenta</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                                            <span class="invalid-feedback" id="nombre-error">Ingresa un nombre válido.</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>">
                                            <span class="invalid-feedback" id="apellidos-error">Ingresa apellidos válidos.</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                                            <span class="invalid-feedback" id="telefono-error">Ingresa un teléfono válido.</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="correo" id="correo" value="<?php echo $email; ?>">
                                            <span class="invalid-feedback" id="correo-error">Ingresa un correo electrónico válidos.</span>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>">
                                            <span class="invalid-feedback" id="direccion-error">Ingresa una dirección válida.</span>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn">Actualizar Datos</button>
                                            <br><br>
                                        </div>
                                    </div>
                                </form>
                                <form id="editUserPassword" method="post">
                                    <h4>Cambio de Contraseña</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="contraseña" id="contraseña" placeholder="Contraseña Actual">
                                            <span class="invalid-feedback" id="contraseña-error">Ingresa tu contraseña actual.</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="nuevaContraseña" id="nuevaContraseña" placeholder="Nueva Contraseña">
                                            <span class="invalid-feedback" id="nuevaContraseña-error">Ingresa una contraseña con mínimo una maýuscula, un número y un caracter especial.</span>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="confirmarContraseña" id="confirmarContraseña" placeholder="Confirmar Contraseña">
                                            <span class="invalid-feedback" id="confirmarContraseña-error">La nueva contraseña no coincide o no cumple con el formato solicitado.</span>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn">Cambiar Contraseña</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$99</td>
                                                <td>Approved</td>
                                                <td><button class="btn">View</button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$99</td>
                                                <td>Approved</td>
                                                <td><button class="btn">View</button></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$99</td>
                                                <td>Approved</td>
                                                <td><button class="btn">View</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                                <h4>Payment Method</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus. Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque.
                                </p> 
                            </div>
                            <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                                <h4>Address</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Payment Address</h5>
                                        <p>123 Payment Street, Los Angeles, CA</p>
                                        <p>Mobile: 012-345-6789</p>
                                        <button class="btn">Edit Address</button>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Shipping Address</h5>
                                        <p>123 Shipping Street, Los Angeles, CA</p>
                                        <p>Mobile: 012-345-6789</p>
                                        <button class="btn">Edit Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account End -->
        <?php include 'layout\footer.php'; ?>
        <script src="js/editUserFormValidation.js"></script>
        <!-- Modal User updated-->
        <div class="modal fade" id="actualizacionExitosoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Usuario Actualizado Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡Usuario actualizado correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error Update User-->
        <div class="modal fade" id="actualizacionFallidoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al actualizar el usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al actualizar el usuario</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal password updated-->
        <div class="modal fade" id="actualizacionContraseñaExitosaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contraseña Actualizada Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡La Contraseña se actualizó correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="actualizacionContraseñaFallidaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al actualizar la contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al actualizar la contraseña</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>