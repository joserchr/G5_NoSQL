<?php
require 'vendor/autoload.php';
// Datos de conexión a MongoDB
$mongoDBHost = 'localhost'; // Cambia esto si tu base de datos no está en localhost
$mongoDBPort = '27017'; // Puerto predeterminado de MongoDB
$mongoDBDatabase = 'Company'; // Nombre de tu base de datos
// Conexión a MongoDB
try {
    // Establecer conexión
    $mongoClient = new MongoDB\Client("mongodb://$mongoDBHost:$mongoDBPort");
    // Seleccionar la base de datos
    $db = $mongoClient->$mongoDBDatabase;
    echo "Conexión a MongoDB exitosa!";
} catch (Exception $e) {
    // Capturar excepciones en caso de error de conexión
    echo "Error al conectar a MongoDB: " . $e->getMessage();
}
//MongoDB\Driver\Exception\Exception
?>
