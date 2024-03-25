<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <link rel="stylesheet" href="final_compra.css"> 
</head>
<body>
    <?php
    session_start();

    function calcularTotalCarrito($carrito) {
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'];
        }
        return $total;
    }

    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        $carrito = $_SESSION['carrito'];
        $totalCompra = calcularTotalCarrito($carrito);

        echo "<h1>¡Compra Exitosa!</h1>";
        echo "<h2>Artículos comprados:</h2>";
        echo "<ul>";
        foreach ($carrito as $producto) {
            echo "<li>{$producto['nombre']} - {$producto['precio']} Colones</li>";
        }
        echo "</ul>";
        echo "<p>Total: $totalCompra Colones</p>";

        unset($_SESSION['carrito']);
    } else {
        
        echo "<h1>Carrito Vacío</h1>";
        echo "<p>No ha agregado ningún artículo al carrito.</p>";
    }
    ?>

    <a href="index.php">Volver a la Tienda</a>
</body>
</html>

