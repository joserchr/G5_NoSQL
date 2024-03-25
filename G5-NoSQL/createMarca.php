<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $marca = $_POST['marca'];
    $db = connectDB();
        // Insertar la nueva prenda en la colección de prendas
        try {
            $result = $db->Marcas->insertOne([
                'Marca' => $marca,
            ]);
            if ($result->getInsertedCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Prenda registrada exitosamente.']);
            }
        } catch (Exception $e) {
            echo 'Error al insertar la prenda en la base de datos: ' . $e->getMessage();
        }



    
}
?>

