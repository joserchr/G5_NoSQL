<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $categoriaId = $_POST['id']; // Asegúrate de recibir el ID de la prenda a editar

    // Verificar si se proporcionó una nueva imagen
        $db = connectDB();
        $result = $db->Categorias->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($categoriaId)], // Filtrar por ID de la prenda que se está editando
            ['$set' => [
                'Categoria' => $categoria,
                'Descripcion' => $descripcion
            ]] // Actualizar los demás campos de la prenda
        );
        if ($result->getModifiedCount() === 1) {
            echo json_encode(['success' => true, 'message' => 'Categoria actualizada exitosamente.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la Categoria.']);
            exit;
        }
    }
?>