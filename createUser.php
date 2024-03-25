<?php
require 'connectDB.php';

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$contraseña = $_POST['contraseña'];
$confirmarContraseña = $_POST['confirmarContraseña'];

/* Validar datos (este es un ejemplo básico, puedes agregar más validaciones)
if ($contraseña !== $confirmarContraseña) {
    echo "Las contraseñas no coinciden.";
    exit;
}*/

// Conectar a la base de datos
$db = connectDB();

// Insertar el nuevo usuario en la colección de usuarios
try {
    $result = $db->Usuarios->insertOne([
        'Rol' => 'Cliente', // Rol por defecto para los nuevos usuarios
        'Nombre' => $nombre,
        'Apellidos' => $apellidos,
        'Correo' => $correo,
        'Telefono' => $telefono,
        'DireccionEnvio' => $direccion,
        'Contraseña' => password_hash($contraseña, PASSWORD_DEFAULT), // Encriptar la contraseña
    ]);

    // Verificar si el usuario fue insertado correctamente
    if ($result->getInsertedCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error al insertar el usuario en la base de datos: ' . $e->getMessage()]);
}
?>