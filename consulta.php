<?php
$servername = "localhost"; 
$username = "root";  
$password = "";
$dbname = "tienda"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$detalle = $_POST['detalle'];

// Consulta para insertar la consulta en la base de datos
$sql = "INSERT INTO consultas (nombre, telefono, correo, detalle) VALUES ('$nombre', '$telefono', '$correo', '$detalle')";

if ($conn->query($sql) === TRUE) {
    echo "Consulta enviada con éxito.";
} else {
    echo "Error al enviar la consulta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

