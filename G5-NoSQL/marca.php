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
        $marcas = $db->Marcas->find();
        ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active"> Marcas</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Recent Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Marcas Registradas</h1>
                    <!-- Botón para agregar una nueva prenda -->
                    <a href="addMarca.php" type="button" class="btn">
                        <i class="fa fa-plus"></i> Agregar Marca
                    </a>
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
                                                <th>Marca</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <?php foreach ($marcas as $marca): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($marca->Marca); ?></td>
                                                <td>
                                                    <a class="btn" href="editMarca.php?id=<?php echo htmlspecialchars($marca->_id); ?>"><i class="fa fa-edit"></i></a>
                                                    <button class="btn-delete-marca" data-id="<?php echo htmlspecialchars($marca->_id); ?>"><i class="fa fa-trash"></i></button>
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
        <script src="js/deleteMarca.js"></script>
        <!-- Modal User created-->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>¿Está seguro(a) que desea eliminar la marca registrada?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary" id="confirmDeleteButton">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="deleteMarcaFallida" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al eliminar la marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al eliminar la marca, inténtelo de nuevo más tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>