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
                    <li class="breadcrumb-item active">Iniciar Sesión</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Login Start -->
        <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="login-form">
                            <h4 class="text-center">Iniciar Sesión</h4>
                            <form id="userLogin" method="post">
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <label>Correo Electrónico</label>
                                        <input class="form-control" type="text" name="correo" id="correo" placeholder="usuario@correo.com">
                                        <span class="invalid-feedback" id="correo-error">Ingresa un correo electrónico válido.</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <label>Contraseña</label>
                                        <input class="form-control" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                                        <span class="invalid-feedback" id="contraseña-error">Ingresa la contraseña.</span>
                                    </div>
                                    <!-- <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="newaccount">
                                            <label class="custom-control-label" for="newaccount">Keep me signed in</label> 
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 text-center">
                                        <button class="btn">Iniciar Sesión</button>
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
        <script src="js/userLoginValidation.js"></script>
        <!-- Modal Error User-->
        <div class="modal fade" id="sesionFallidoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al iniciar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Usuario o Contraseña inválidos.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
