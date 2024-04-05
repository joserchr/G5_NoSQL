<?php
session_start();

// Verificar si hay una sesión de usuario iniciada
if (isset($_SESSION['id'])) {
    // Verificar si la solicitud es mediante el método POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar el ID del producto de la solicitud POST
        $productId = $_POST['productId'];
        // Conectar a la base de datos MongoDB
        require 'connectDB.php';
        $db = connectDB();
        // Obtener el ID del usuario almacenado en la sesión
        $userId = $_SESSION['id'];
        // Verificar si el producto ya está en la lista de favoritos del usuario
        $existingFavorite = $db->Favoritos->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
        // Si no hay un documento favorito existente para este usuario, crea uno nuevo
        if (!$existingFavorite) {
            $result = $db->Favoritos->insertOne([
                'idUsuario' => new MongoDB\BSON\ObjectID($userId),
                'Items' => [$productId]
            ]);
        } else {
            // Si ya existe un documento favorito para este usuario, actualiza la lista de favoritos
            $result = $db->Favoritos->updateOne(
                ['idUsuario' => new MongoDB\BSON\ObjectID($userId)],
                ['$addToSet' => ['Items' => $productId]]
            );
        }
        // Verificar si la operación fue exitosa
        if ($result->getInsertedCount() === 1 || $result->getModifiedCount() === 1) {
            http_response_code(200); // OK
            echo json_encode(['success' => true]);
            exit;
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['success' => false, 'message' => 'Error al agregar la prenda a favoritos.']);
            exit;
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
        exit;
    }
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['success' => false, 'message' => 'Por favor, inicia sesión para agregar productos a tus favoritos.']);
    exit;
}
?>

