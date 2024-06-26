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
    $productos = $db->Productos->find();
    ?>
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Colección</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Recent Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="section-header text-center">
                    <h1>Nueva Colección</h1>
                </div>
                <!-- Product List Start -->
                <div class="product-view">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <!-- <div class="col-md-12">
                                        <div class="product-view-top">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="product-search">
                                                        <input type="email" value="Buscar">
                                                        <button><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="product-short">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item">Newest</a>
                                                                <a href="#" class="dropdown-item">Popular</a>
                                                                <a href="#" class="dropdown-item">Most sale</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="product-price-range">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item">$0 to $50</a>
                                                                <a href="#" class="dropdown-item">$51 to $100</a>
                                                                <a href="#" class="dropdown-item">$101 to $150</a>
                                                                <a href="#" class="dropdown-item">$151 to $200</a>
                                                                <a href="#" class="dropdown-item">$201 to $250</a>
                                                                <a href="#" class="dropdown-item">$251 to $300</a>
                                                                <a href="#" class="dropdown-item">$301 to $350</a>
                                                                <a href="#" class="dropdown-item">$351 to $400</a>
                                                                <a href="#" class="dropdown-item">$401 to $450</a>
                                                                <a href="#" class="dropdown-item">$451 to $500</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> -->
                                    <?php foreach ($productos as $producto): ?>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#"><?php echo htmlspecialchars($producto->Nombre); ?></a>
                                                <!-- <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> -->
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="<?php echo htmlspecialchars($producto->Imagen); ?>" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#" class="btn cart-product" data-id="<?php echo htmlspecialchars($producto->_id); ?>"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#" class="btn favorite-product" data-id="<?php echo htmlspecialchars($producto->_id); ?>"><i class="fa fa-heart"></i></a>
                                                    <!-- <a href="product-detail.php?id=<?php echo htmlspecialchars($producto->_id); ?>"><i class="fa fa-search"></i></a> -->
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>₡</span><?php echo htmlspecialchars($producto->Precio); ?></h3>
                                                <a class="btn" href="product-detail.php?id=<?php echo htmlspecialchars($producto->_id); ?>"><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <!-- <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Enterizo Azul</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-2.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Vestido Largo Azul</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-3.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Blusa Café Manga Larga</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-4.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Camisa Niño Celeste</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-5.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Skinny Jeans</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-6.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Abrigo Negro</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-7.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Blusa Manga Larga Negra</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-8.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Abrigo Beige</a>
                                                 <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> 
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-9.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar Ahora</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                Pagination Start 
                                <div class="col-md-12">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Siguiente</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                 Pagination Start -->
                            </div>           
                            <!-- Side Bar Start 
                            <div class="col-lg-4 sidebar">
                                <div class="sidebar-widget category">
                                    <h2 class="title">Category</h2>
                                    <nav class="navbar bg-light">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="fa fa-female"></i>Fashion & Beauty</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="fa fa-child"></i>Kids & Babies Clothes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Men & Women Clothes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="fa fa-mobile-alt"></i>Gadgets & Accessories</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><i class="fa fa-microchip"></i>Electronics & Accessories</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                
                                <div class="sidebar-widget widget-slider">
                                    <div class="sidebar-slider normal-slider">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Product Name</a>
                                                <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-10.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                            </div>
                                        </div>
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Product Name</a>
                                                <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-9.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                            </div>
                                        </div>
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#">Product Name</a>
                                                <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="img/product-8.jpg" alt="Product Image">
                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="#"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3><span>$</span>99</h3>
                                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sidebar-widget brands">
                                    <h2 class="title">Our Brands</h2>
                                    <ul>
                                        <li><a href="#">Nulla </a><span>(45)</span></li>
                                        <li><a href="#">Curabitur </a><span>(34)</span></li>
                                        <li><a href="#">Nunc </a><span>(67)</span></li>
                                        <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                                        <li><a href="#">Fusce </a><span>(89)</span></li>
                                        <li><a href="#">Sagittis</a><span>(28)</span></li>
                                    </ul>
                                </div>
                                
                                <div class="sidebar-widget tag">
                                    <h2 class="title">Tags Cloud</h2>
                                    <a href="#">Lorem ipsum</a>
                                    <a href="#">Vivamus</a>
                                    <a href="#">Phasellus</a>
                                    <a href="#">pulvinar</a>
                                    <a href="#">Curabitur</a>
                                    <a href="#">Fusce</a>
                                    <a href="#">Sem quis</a>
                                    <a href="#">Mollis metus</a>
                                    <a href="#">Sit amet</a>
                                    <a href="#">Vel posuere</a>
                                    <a href="#">orci luctus</a>
                                    <a href="#">Nam lorem</a>
                                </div>
                            </div>
                            Side Bar End -->
                        </div>
                </div>
                <!-- Product List End -->  
            </div>
        </div>
        <!-- Recent Product End -->
        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->
        <?php include 'layout\footer.php'; ?>
        <script src="js/product.js"></script>
        <!-- Modal Error User-->
        <div class="modal fade" id="favoritosModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prenda añadida a Favoritos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¡Prenda añadida a tu lista de Favoritos con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prenda añadida al Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¡Prenda añadida al Carrito con éxito!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="addItemFailedModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error al añadir Prenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ha ocurrido un error al añadir la prenda, inténtalo de nuevo más tarde.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Error User-->
        <div class="modal fade" id="favoritosSessionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Iniciar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Por favor inicia sesión para añadir prendas a tu lista de Favoritos</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>