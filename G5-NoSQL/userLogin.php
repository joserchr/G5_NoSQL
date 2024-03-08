<?php
require 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Conectar a la base de datos
    $db = connectDB();

    // Buscar el usuario en la base de datos por correo electrónico
    $user = $db->Usuarios->findOne(['Correo' => $correo]);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($contraseña, $user['Contraseña'])) {
        // Iniciar sesión
        session_start();
        // Almacenar información del usuario en la sesión
        $_SESSION['id'] = $user->_id; 
        $_SESSION['Nombre'] = $user->Nombre; 
        $_SESSION['Apellidos'] = $user->Apellidos; 
        $_SESSION['Correo'] = $user->Correo; 

        /* Redirigir al usuario a la página de inicio o al panel de control
        header('Location: index.php'); */
        echo json_encode(['success' => true]);
        exit;
    } else {
        // Mostrar mensaje de error si la autenticación falla
        echo json_encode(['success' => false, 'message' => 'Correo electrónico o contraseña incorrecta.']);
    }
}
?>