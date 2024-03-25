<?php
session_start();

// Obtener el ID del producto a agregar al carrito
$productID = $_GET['id'];

// Agregar el producto al carrito en la sesión
if (isset($_SESSION['carrito'][$productID])) {
    $_SESSION['carrito'][$productID]++;
} else {
    $_SESSION['carrito'][$productID] = 1;
}

// Redirigir de vuelta a la página de productos
header('Location: product-list.html');
exit;
?>
