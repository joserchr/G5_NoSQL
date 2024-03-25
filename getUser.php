<?php
require 'connectDB.php';

function getUserData($userId) {
    // Conectar a la base de datos
    $db = connectDB();

    // Buscar el usuario en la base de datos por su ID
    $user = $db->Usuarios->findOne(['_id' => ($userId)]);

    // Verificar si el usuario existe
    if ($user) {
        return $user;
    } else {
        return null;
    }
}
?>

