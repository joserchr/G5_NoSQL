<?php
require 'connectDB.php';
function getProductData($productId) {
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el usuario en la base de datos por su ID
    $product = $db->Productos->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
    // Verificar si el usuario existe
    if ($product) {
        return $product;
    } else {
        return null;
    }
}
?>