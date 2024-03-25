<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $marca = $_POST['marca'];
    $marcaId = $_POST['id']; // Asegúrate de recibir el ID de la prenda a editar

    // Verificar si se proporcionó una nueva imagen
        $db = connectDB();
        $result = $db->Marcas->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($marcaId)], // Filtrar por ID de la prenda que se está editando
            ['$set' => [
                'Marca' => $marca
            ]] // Actualizar los demás campos de la prenda
        );
        if ($result->getModifiedCount() === 1) {
            echo json_encode(['success' => true, 'message' => 'Prenda actualizada exitosamente.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la prenda.']);
            exit;
        }
    }
?>