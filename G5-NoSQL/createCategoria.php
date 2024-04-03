<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $db = connectDB();
        // Insertar la nueva prenda en la colección de prendas
        try {
            $result = $db->Categorias->insertOne([
                'Categoria' => $categoria,
                'Descripcion' => $descripcion
            ]);
            if ($result->getInsertedCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Categoria registrada exitosamente.']);
            }
        } catch (Exception $e) {
            echo 'Error al insertar la categoria en la base de datos: ' . $e->getMessage();
        }



    
}
?>

