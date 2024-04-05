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
                    <li class="breadcrumb-item"><a href="stock.php">Inventario</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Products</a></li> -->
                    <li class="breadcrumb-item active">Editar Prenda Existente</li>
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
                            require 'getProduct.php'; // Asegúrate de incluir el archivo que contiene la función getProductData
                            // Verificar si se ha proporcionado un ID de producto en la URL
                            if (isset($_GET['id'])) {
                                // Obtener el ID del producto desde la URL
                                $productId = $_GET['id'];
                                // Obtener los datos del usuario
                                $productData = getProductData($productId);

                                // Verificar si se obtuvieron los datos del usuario correctamente
                                if ($productData) {
                                    // Mostrar los datos del usuario en los campos del formulario
                                    $idPrenda = $productData['_id'];
                                    $nombre = $productData['Nombre'];
                                    $marcaPrenda = $productData['idMarca'];
                                    $categoriaPrenda = $productData['idCategoria'];
                                    $precio = $productData['Precio'];
                                    $cantidad = $productData['Cantidad'];
                                    $descripcion = $productData['Descripcion'];
                                    $tallaPrenda = $productData['Talla'];
                                    $colorPrenda = $productData['Color'];
                                    $imagen = $productData['Imagen'];
                                } else {
                                    echo "No se encontraron datos para el producto con ID: $productId";
                                }
                                $db = connectDB();
                            }
                            ?>
                            <h4 class="text-center">Editar Prenda</h4>
                            <form id="editItem" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $idPrenda; ?>"> <!-- Campo oculto para el ID de la prenda -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Nombre de la Prenda</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
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
                                                // Verificar si la marca actual coincide con la marca de la prenda
                                                $selected = ($marca['_id'] == $marcaPrenda) ? 'selected' : '';
                                                echo '<option value="' . $marca['_id'] . '" ' . $selected . '>' . $marca['Marca'] . '</option>';
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
                                                // Verificar si la categoría actual coincide con la categoría de la prenda
                                                $selected = ($categoria['_id'] == $categoriaPrenda) ? 'selected' : '';
                                                echo '<option value="' . $categoria['_id'] . '" ' . $selected . '>' . $categoria['Categoria'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="invalid-feedback" id="categoria-error">Debes seleccionar una categoría.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Precio</label>
                                        <input class="form-control" type="text" name="precio" id="precio" value="<?php echo $precio; ?>">
                                        <span class="invalid-feedback" id="precio-error">Ingresa un precio válido, con dos decimales.</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad:</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="<?php echo $cantidad; ?>">
                                            <span class="invalid-feedback" id="cantidad-error">Ingresa una cantidad válida, mayor a 0.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Descripción</label>
                                        <textarea class="form-control" type="text" name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
                                        <span class="invalid-feedback" id="descripcion-error">Ingresa una descripción válida.</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="imagen">Imagen actual:</label><br>
                                            <img src="<?php echo $imagen; ?>" alt="Imagen actual" style="max-width: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="imagen">Selecciona una nueva Imagen:</label>
                                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                                            <span class="invalid-feedback" id="imagen-error">Debes seleccionar una imagen.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Color</label>
                                        <div class="p-color">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <?php
                                                // Colores disponibles
                                                $colores_disponibles = array("Blanco", "Negro", "Azul", "Rojo", "Verde", "Gris");
                                                // Iterar sobre los colores y crear botones de opción
                                                foreach ($colores_disponibles as $color) {
                                                    // Verificar si el color actual coincide con el color de la prenda
                                                    $checked = ($color == $colorPrenda) ? 'checked' : '';
                                                    echo '<label class="btn btn-warning">';
                                                    echo '<input type="radio" name="color" value="' . $color . '" ' . $checked . '> ' . $color;
                                                    echo '</label>';
                                                }
                                                ?>
                                            </div>
                                            <span class="invalid-feedback" id="color-error">Selecciona al menos un color.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Talla</label>
                                        <div class="p-size">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <?php
                                                // Tallas disponibles
                                                $tallas_disponibles = array("S", "M", "L", "XL");
                                                // Iterar sobre las tallas y crear botones de opción
                                                foreach ($tallas_disponibles as $talla) {
                                                    // Verificar si la talla actual coincide con la talla de la prenda
                                                    $checked = ($talla == $tallaPrenda) ? 'checked' : '';
                                                    echo '<label class="btn btn-warning">';
                                                    echo '<input type="radio" name="talla" value="' . $talla . '" ' . $checked . '> ' . $talla;
                                                    echo '</label>';
                                                }
                                                ?>
                                            </div>
                                            <span class="invalid-feedback" id="talla-error">Selecciona al menos una talla.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-4">
                                        <a class="btn mr-5" href="stock.php">Cancelar</a>
                                        <button class="btn" type="submit">Modificar Prenda</button>
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
        <script src="js/editItemFormValidation.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="actualizacionPrendaExitosaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Prenda Actualizada Exitosamente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¡La Prenda se actualizó correctamente!</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="actualizacionPrendaFallidaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al actualizar la prenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al actualizar la prenda</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>