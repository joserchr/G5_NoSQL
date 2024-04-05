<?php
require 'connectDB.php';
// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID de la orden y el nuevo estado enviado desde el formulario
    $orderId = $_POST['orderId'];
    $newState = $_POST['newState'];
    // Conectar a la base de datos
    $db = connectDB();
    // Actualizar el estado de la orden en la base de datos
    $result = $db->Pedidos->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($orderId)],
        ['$set' => ['Estado' => $newState]]
    );
    // Verificar si la actualización fue exitosa
    if ($result->getModifiedCount() === 1) {
        // Envía una respuesta JSON indicando que la actualización fue exitosa
        echo json_encode(['success' => true, 'message' => 'Estado de la orden actualizado exitosamente.']);
        exit;
    } else {
        // Envía una respuesta JSON indicando que ocurrió un error al actualizar el estado de la orden
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado de la orden.']);
        exit;
    }
} else {
    // Si la solicitud no es mediante el método POST, retorna un mensaje de error
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
    exit;
}
?>
