<?php
session_start();


$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$collection = $mongoClient->TiendaRopa->carrito;

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $producto) {
        echo "<li>{$producto['nombre']} - {$producto['precio']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Su carrito de compras está vacío.</p>";
}
?>

