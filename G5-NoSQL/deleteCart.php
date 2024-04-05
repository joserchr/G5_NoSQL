<?php
header('Content-Type: application/json');
require 'connectDB.php';
// Verificar si la solicitud es mediante el método GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recuperar el ID del producto a eliminar
    $productId = $_GET['id']; // Aquí se cambió de $_POST a $_GET
    // Obtener el ID del usuario de la sesión
    session_start();
    $userId = $_SESSION['id'];
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el documento del carrito del usuario
    $carrito = $db->Carrito->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
    if ($carrito) {
        // Obtener los items actuales y convertirlos en un array de PHP
        $items = iterator_to_array($carrito['Items']);
        // Buscar el índice del producto a eliminar en los items del carrito
        $index = array_search($productId, array_column($items, 'productoId'));
        if ($index !== false) {
            // Eliminar el producto del array
            unset($items[$index]);
            // Actualizar los items en el documento del carrito
            $result = $db->Carrito->updateOne(
                ['idUsuario' => new MongoDB\BSON\ObjectID($userId)],
                ['$set' => ['Items' => array_values($items)]]
            );
            // Verificar si se eliminó correctamente
            if ($result->getModifiedCount() === 1) {
                // Éxito: enviar respuesta JSON
                echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente del carrito.']);
                exit;
            }
        }
    }
    // Si no se encontró el producto en el carrito o no se pudo eliminar, enviar respuesta JSON con error
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto del carrito.']);
}
?>
