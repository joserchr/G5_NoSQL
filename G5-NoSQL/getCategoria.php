<?php
require 'connectDB.php';
function getCategoriaData($categoriaId) {
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el usuario en la base de datos por su ID
    $categoria = $db->Categorias->findOne(['_id' => new MongoDB\BSON\ObjectId($categoriaId)]);
    // Verificar si el usuario existe
    if ($categoria) {
        return $categoria;
    } else {
        return null;
    }
}
?>