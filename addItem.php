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
    <?php 
    include 'layout\navbar.php';
    require 'connectDB.php';
    $db = connectDB();
    ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="stock.php">Inventario</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Products</a></li> -->
                    <li class="breadcrumb-item active">Registro de Nueva Prenda</li>
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
                            <h4 class="text-center">Registro de Nueva Prenda</h4>
                            <form id="createItem" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Nombre de la Prenda</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                                        <span class="invalid-feedback" id="nombre-error">Ingresa un nombre válido para la prenda.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="marca">Marca</label>
                                        <select class="form-control" id="marca" name="marca">
                                            <?php
                                            // Obtener las marcas desde la base de datos
                                            $marcas = $db->Marcas->find();
                                            // Iterar sobre las marcas y crear opciones de selección
                                            foreach ($marcas as $marca) {
                                                echo '<option value="' . $marca['_id'] . '">' . $marca['Marca'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="invalid-feedback" id="marca-error">Debes seleccionar una marca.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categoria">Categoría</label>
                                        <select class="form-control" id="categoria" name="categoria">
                                            <?php
                                            // Obtener las categorías desde la base de datos
                                            $categorias = $db->Categorias->find();
                                            // Iterar sobre las categorías y crear opciones de selección
                                            foreach ($categorias as $categoria) {
                                                echo '<option value="' . $categoria['_id'] . '">' . $categoria['Categoria'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="invalid-feedback" id="categoria-error">Debes seleccionar una categoría.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Precio</label>
                                        <input class="form-control" type="text" name="precio" id="precio" placeholder="0.0">
                                        <span class="invalid-feedback" id="precio-error">Ingresa un precio válido, con dos decimales.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad:</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="1">
                                            <span class="invalid-feedback" id="cantidad-error">Ingresa una cantidad válida, mayor a 0.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Descripción</label>
                                        <textarea class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Dirección de la prenda..."></textarea>
                                        <span class="invalid-feedback" id="descripcion-error">Ingresa una descripción válida.</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="imagen">Imagen:</label>
                                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                                            <span class="invalid-feedback" id="imagen-error">Debes seleccionar una imagen.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Color</label>
                                        <div class="p-color">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorBlanco" value="Blanco"> Blanco
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorNegro" autocomplete="off" value="Negro"> Negro
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorAzul" autocomplete="off" value="Azul"> Azul
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorRojo" autocomplete="off" value="Rojo"> Rojo
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorVerde" autocomplete="off" value="Verde"> Verde
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="color" id="colorGris" autocomplete="off" value="Gris"> Gris
                                                </label>
                                            </div>
                                            <span class="invalid-feedback" id="color-error">Selecciona al menos un color.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Talla</label>
                                        <div class="p-size">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="talla" id="tallaS" value="S"> S
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="talla" id="tallaM" autocomplete="off" value="M"> M
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="talla" id="tallaL" autocomplete="off" value="L"> L
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input type="radio" name="talla" id="tallaXL" autocomplete="off" value="XL"> XL
                                                </label>
                                            </div>
                                            <span class="invalid-feedback" id="talla-error">Selecciona al menos una talla.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-4">
                                        <a class="btn mr-5" href="stock.php">Cancelar</a>
                                        <button class="btn" type="submit">Ingresar Prenda</button>
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
        <script src="js/itemFormValidation.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="registroPrendaExitosoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Prenda Ingresada Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡La Prenda se ingresó correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="registroPrendaFallidoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al registrar la prenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al registrar la prenda</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>