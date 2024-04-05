<?php
header('Content-Type: application/json');
require 'connectDB.php';
// Verificar si la solicitud es mediante el método GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recuperar el ID de la prenda a eliminar
    $productId = $_GET['id']; // Aquí se cambió de $_POST a $_GET
    // Obtener el ID del usuario de la sesión
    session_start();
    $userId = $_SESSION['id'];
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el documento de favoritos del usuario
    $favoritos = $db->Favoritos->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
    if ($favoritos) {
        // Obtener los items actuales y convertirlos en un array de PHP
        $items = iterator_to_array($favoritos['Items']);
        // Encontrar y eliminar el producto del array
        $index = array_search($productId, $items);
        if ($index !== false) {
            unset($items[$index]);
            // Actualizar los items en el documento de favoritos
            $result = $db->Favoritos->updateOne(
                ['idUsuario' => new MongoDB\BSON\ObjectID($userId)],
                ['$set' => ['Items' => array_values($items)]]
            );
            // Verificar si se eliminó correctamente
            if ($result->getModifiedCount() === 1) {
                // Éxito: enviar respuesta JSON
                echo json_encode(['success' => true, 'message' => 'Prenda eliminada exitosamente.']);
                exit;
            }
        }
    }
    // Si no se encontró la prenda o no se pudo eliminar, enviar respuesta JSON con error
    echo json_encode(['success' => false, 'message' => 'Error al eliminar la prenda.']);
}
?>


