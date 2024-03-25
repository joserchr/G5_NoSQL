<?php
session_start();

// Obtener el ID del producto a eliminar del carrito
$productID = $_GET['id'];

// Eliminar el producto del carrito en la sesión
unset($_SESSION['carrito'][$productID]);

// Redirigir de vuelta a la página del carrito
header('Location: cart.html');
exit;
?>