<?php
require 'connectDB.php';
// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Recuperar el ID de la prenda a eliminar
    $id = $_GET['id'];
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar la prenda por su ID y eliminarla
    $result = $db->Categorias->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    // Verificar si se eliminó correctamente
    if ($result->getDeletedCount() === 1) {
        echo json_encode(['success' => true, 'message' => 'Categoria eliminada exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Categoria al eliminar la prenda.']);
    }
}
?>