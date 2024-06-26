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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php session_start();?>
    <!-- Nav Bar Start -->
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
                    <a href="product-list.php" class="nav-item nav-link">Colección</a>
                    <!-- <a href="product-detail.html" class="nav-item nav-link">Hombre</a> -->
                    <!-- <a href="product-detail.html" class="nav-item nav-link">Mujer</a> -->
                    <a href="contact.php" class="nav-item nav-link">Contáctanos</a>
                    <!-- <a href="cart.html" class="nav-item nav-link"><i class="fa fa-shopping-cart"></i></a> -->
                </div> 
                <div class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['Rol']) && $_SESSION['Rol'] === 'Cliente'): ?>
                        <!-- Si el usuario tiene Rol Cliente -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Bienvenido(a) <?php echo htmlspecialchars($_SESSION['Nombre']); ?> </a>
                            <div class="dropdown-menu">
                                <a href="my-account.php" class="dropdown-item">Mi Perfil</a>
                                <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>
                            </div>
                        </div>
                    <?php elseif(isset($_SESSION['Rol']) && $_SESSION['Rol'] === 'Administrador'): ?>
                        <!-- Si el usuario tiene Rol Administrador -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Gestión de Tienda</a>
                            <div class="dropdown-menu">
                                <a href="stock.php" class="dropdown-item">Inventario</a>
                                <a href="marca.php" class="dropdown-item">Marcas</a>
                                <a href="categoria.php" class="dropdown-item">Categorias</a>
                                <a href="orders.php" class="dropdown-item">Órdenes</a>
                                <a href="logout.php" class="dropdown-item">Cerrar Sesión</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Si el usuario no está logueado -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Mi Cuenta</a>
                            <div class="dropdown-menu">
                                <a href="login.php" class="dropdown-item">Iniciar Sesión</a>
                                <a href="register.php" class="dropdown-item">Registrarse</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
    <!-- Bottom Bar Start -->
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="index.php">
                            <img src="img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="search">
                        <input type="text" placeholder="Buscar">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="user">
                        <a href="wishlist.php" class="btn wishlist">
                            <i class="fa fa-heart"></i>
                            <span>(0)</span>
                        </a>
                        <a href="cart.php" class="btn cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>(0)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Bar End -->
</body>
</html>
<script>
    $(document).ready(function() {
        // Función para actualizar la cantidad de elementos en la lista de favoritos
        function updateWishlistCount() {
            $.ajax({
                url: "wishlistCount.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Actualiza el texto con la cantidad de elementos en la lista de favoritos
                    $('.wishlist span').text('(' + response.cantidadItems + ')');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        // Función para actualizar la cantidad de elementos en el carrito
        function updateCartCount() {
            $.ajax({
                url: "cartlistCount.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Actualiza el texto con la cantidad de elementos en la lista de favoritos
                    $('.cart span').text('(' + response.cantidadItems + ')');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        // Llamar a las funciones de actualización al cargar la página
        updateWishlistCount();
        updateCartCount();
    });
</script>
