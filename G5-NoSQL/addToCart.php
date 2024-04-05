<?php
session_start();

// Verificar si hay una sesión de usuario iniciada
if (isset($_SESSION['id'])) {
    // Verificar si la solicitud es mediante el método POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar el ID del producto y la cantidad de la solicitud POST
        $productId = $_POST['productId'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; // Si no se envía la cantidad, se asigna 1 por defecto
        // Conectar a la base de datos MongoDB
        require 'connectDB.php';
        $db = connectDB();
        // Obtener el ID del usuario almacenado en la sesión
        $userId = $_SESSION['id'];
        // Verificar si el producto ya está en el carrito del usuario
        $existingCart = $db->Carrito->findOne(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
        // Si no hay un documento de carrito existente para este usuario, crea uno nuevo
        if (!$existingCart) {
            $result = $db->Carrito->insertOne([
                'idUsuario' => new MongoDB\BSON\ObjectID($userId),
                'Items' => [['productoId' => new MongoDB\BSON\ObjectID($productId), 'cantidad' => $quantity]]
            ]);
        } else {
            // Si ya existe un documento de carrito para este usuario, actualiza el carrito
            $result = $db->Carrito->updateOne(
                ['idUsuario' => new MongoDB\BSON\ObjectID($userId)],
                ['$addToSet' => ['Items' => ['productoId' => new MongoDB\BSON\ObjectID($productId), 'cantidad' => $quantity]]]
            );
        }
        // Verificar si la operación fue exitosa
        if ($result->getInsertedCount() === 1 || $result->getModifiedCount() === 1) {
            http_response_code(200); // OK
            echo json_encode(['success' => true]);
            exit;
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['success' => false, 'message' => 'Error al agregar la prenda al carrito.']);
            exit;
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
        exit;
    }
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['success' => false, 'message' => 'Por favor, inicia sesión para agregar productos a tu carrito.']);
    exit;
}
?>