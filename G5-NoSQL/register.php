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
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" placeholder="Nombre">
                                </div>
                                <div class="col-md-6">
                                    <label>Apellidos</label>
                                    <input class="form-control" type="text" placeholder="Apellidos">
                                </div>
                                <div class="col-md-6">
                                    <label>Correo Electrónico</label>
                                    <input class="form-control" type="text" placeholder="usuario@correo.com">
                                </div>
                                <div class="col-md-6">
                                    <label>Teléfono</label>
                                    <input class="form-control" type="text" placeholder="8888-8888">
                                </div>
                                <div class="col-md-12">
                                    <label>Dirección</label>
                                    <textarea class="form-control" type="text" placeholder="Dirección Completa..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Contraseña</label>
                                    <input class="form-control" type="text" placeholder="Contraseña">
                                </div>
                                <div class="col-md-6">
                                    <label>Confirmar Contraseña</label>
                                    <input class="form-control" type="text" placeholder="Confirmar Contraseña">
                                </div>
                                <div class="col-md-12 text-center">
                                    <button class="btn">Registrarme</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        <?php include 'layout\footer.php'; ?>
    </body>
</html>