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
    <?php include 'layout\navbar.php';?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="categoria.php">Categorias</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Products</a></li> -->
                    <li class="breadcrumb-item active">Editar Categoria Existente</li>
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
                        <?php
                            require 'getCategoria.php'; // Asegúrate de incluir el archivo que contiene la función getMarcaData
                            // Verificar si se ha proporcionado un ID de producto en la URL
                            if (isset($_GET['id'])) {
                                // Obtener el ID del producto desde la URL
                                $categoriaId = $_GET['id'];
                                // Obtener los datos del usuario
                                $categoriaData = getCategoriaData($categoriaId);

                                // Verificar si se obtuvieron los datos del usuario correctamente
                                if ($categoriaData) {
                                    // Mostrar los datos del usuario en los campos del formulario
                                    $idCategoria = $categoriaData['_id'];
                                    $categoria = $categoriaData['Categoria'];
                                    $descripcion = $categoriaData['Descripcion'];
                                } else {
                                    echo "No se encontraron datos para el producto con ID: $categoriaId";
                                }
                                $db = connectDB();
                            }
                            ?>
                            <h4 class="text-center">Editar Categoria</h4>
                            <form id="editCategoria" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $idCategoria; ?>"> <!-- Campo oculto para el ID de la prenda -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Categoria</label>
                                        <input class="form-control" type="text" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
                                        <span class="invalid-feedback" id="nombre-error">Ingresa un nombre válido para la categoria.</span>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Descripcion</label>
                                        <input class="form-control" type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">
                                        <span class="invalid-feedback" id="nombre-error">Ingresa una descripcion válida para la Categoria.</span>
                                    </div>
                                    <div class="col-md-12 text-center mt-4">
                                        <a class="btn mr-5" href="categoria.php">Cancelar</a>
                                        <button class="btn" type="submit">Modificar Categoria</button>
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
        <script src="js/editCategoriaFormValidation.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="actualizacionCategoriaExitosaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Categoria Actualizada Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡La Categoria se actualizó correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="actualizacionCategoriaFallidaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al actualizar la categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al actualizar la categoria</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>