<?php
require 'connectDB.php';
session_start();
// Inicializar el array de respuesta
$response = array();
// Verificar si hay una sesión iniciada
if (isset($_SESSION['id'])) {
    // Obtener el ID del usuario de la sesión
    $userId = $_SESSION['id'];
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el documento de favoritos del usuario
    $favoritos = $db->Favoritos->findOne(['idUsuario' => new MongoDB\BSON\ObjectId($userId)]);
    // Contar los items en los favoritos
    $cantidadItems = $favoritos ? count($favoritos->Items) : 0;
    // Asignar la cantidad de items al array de respuesta
    $response['cantidadItems'] = $cantidadItems;
} else {
    // Si no hay una sesión de usuario, asignar 0 al array de respuesta
    $response['cantidadItems'] = 0;
}
// Convertir el array de respuesta a formato JSON y enviarlo
echo json_encode($response);
?>

