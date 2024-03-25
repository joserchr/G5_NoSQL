<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del usuario de la sesión
    session_start();
    $userId = $_SESSION['id'];

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    // Conectar a la base de datos
    $db = connectDB();

    // Actualizar los datos del usuario
    try {
        $result = $db->Usuarios->updateOne(
            ['_id' => ($userId)],
            ['$set' => [
                'Nombre' => $nombre,
                'Apellidos' => $apellidos,
                'Telefono' => $telefono,
                'Correo' => $correo,
                'DireccionEnvio' => $direccion
            ]]
        );

        // Verificar si la operación fue exitosa
        if ($result->getModifiedCount() > 0) {
            echo json_encode(['success' => true]); // Enviar respuesta de éxito en formato JSON
        } else {
            echo json_encode(['success' => false, 'message' => 'No se modificaron los datos del usuario.']); // Enviar respuesta de error en formato JSON
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del usuario: ' . $e->getMessage()]); // Enviar respuesta de error en formato JSON
    }
}
?>

