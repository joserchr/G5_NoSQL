<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tienda</title>
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
                    <!-- <li class="breadcrumb-item"><a href="#">Products</a></li> -->
                    <li class="breadcrumb-item active">Registro de Nuevo Usuario</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Login Start -->
        <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 mx-auto">    
                        <div class="register-form">
                            <h4 class="text-center">Registro de Usuario</h4>
                            <form id="createUser" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                                        <span class="invalid-feedback" id="nombre-error">Ingresa un nombre válido.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Apellidos</label>
                                        <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
                                        <span class="invalid-feedback" id="apellidos-error">Ingresa apellidos válidos.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Correo Electrónico</label>
                                        <input class="form-control" type="email" name="correo" id="correo" placeholder="usuario@correo.com">
                                        <span class="invalid-feedback" id="correo-error">Ingresa un correo electrónico válidos.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="tel" name="telefono" id="telefono" placeholder="8888-8888">
                                        <span class="invalid-feedback" id="telefono-error">Ingresa un teléfono válido.</span>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Dirección</label>
                                        <textarea class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección Completa..."></textarea>
                                        <span class="invalid-feedback" id="direccion-error">Ingresa una dirección válida.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Contraseña</label>
                                        <input class="form-control" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                                        <span class="invalid-feedback" id="contraseña-error">Ingresa una contraseña con mínimo una maýuscula, un número y un caracter especial.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirmar Contraseña</label>
                                        <input class="form-control" type="password" name="confirmarContraseña" id="confirmarContraseña" placeholder="Confirmar Contraseña">
                                        <span class="invalid-feedback" id="confirmarContraseña-error">La nueva contraseña no coincide o no cumple con el formato solicitado.</span>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button class="btn" type="submit">Registrarme</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        <?php include 'layout\footer.php'; ?>
        <script src="js/userFormValidation.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="registroExitosoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Usuario Creado Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡Usuario registrado correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="registroFallidoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al crear el usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al registrar el usuario</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>