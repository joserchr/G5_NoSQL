<?php
require 'connectDB.php';
function getMarcaData($marcaId) {
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el usuario en la base de datos por su ID
    $marca = $db->Marcas->findOne(['_id' => new MongoDB\BSON\ObjectId($marcaId)]);
    // Verificar si el usuario existe
    if ($marca) {
        return $marca;
    } else {
        return null;
    }
}
?>