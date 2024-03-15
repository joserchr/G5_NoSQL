<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del usuario de la sesión
    session_start();
    $userId = $_SESSION['id'];

    // Obtener la contraseña antigua y la nueva del formulario
    $oldPassword = $_POST['contraseña'];
    $newPassword = $_POST['confirmarContraseña'];

    // Conectar a la base de datos
    $db = connectDB();

    // Buscar al usuario en la base de datos por su ID
    $user = $db->Usuarios->findOne(['_id' => ($userId)]);

    // Verificar si el usuario existe
    if ($user) {
        // Verificar si la contraseña antigua es válida
        if (password_verify($oldPassword, $user->Contraseña)) {
            // La contraseña antigua es válida, puedes proceder a actualizar la contraseña
            try {
                // Hashear la nueva contraseña antes de almacenarla en la base de datos
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Actualizar la contraseña del usuario
                $result = $db->Usuarios->updateOne(
                    ['_id' => ($userId)],
                    ['$set' => ['Contraseña' => $hashedPassword]]
                );

                // Verificar si la operación fue exitosa
                if ($result->getModifiedCount() > 0) {
                    echo json_encode(['success' => true]); // Enviar respuesta de éxito en formato JSON
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se modificó la contraseña del usuario.']); // Enviar respuesta de error en formato JSON
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña del usuario: ' . $e->getMessage()]); // Enviar respuesta de error en formato JSON
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'La contraseña antigua no es correcta.']); // Enviar respuesta de error en formato JSON
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El usuario no existe.']); // Enviar respuesta de error en formato JSON
    }
}
?>