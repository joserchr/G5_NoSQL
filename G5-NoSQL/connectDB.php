<?php
require 'vendor/autoload.php';

function connectDB() {
    // Datos de conexión a MongoDB
    $mongoDBHost = 'localhost'; 
    $mongoDBPort = '27017'; // Puerto predeterminado de MongoDB
    $mongoDBDatabase = 'TiendaRopa';

    // Conexión a MongoDB
    try {
        // Establecer conexión
        $mongoClient = new MongoDB\Client("mongodb://$mongoDBHost:$mongoDBPort");
        // Seleccionar la base de datos
        $db = $mongoClient->$mongoDBDatabase;
    } catch (Exception $e) {
        // Capturar excepciones en caso de error de conexión
        echo "Error al conectar a MongoDB: " . $e->getMessage();
        exit; // Es importante detener la ejecución en caso de error
    }
    // Devolver la instancia de conexión para ser utilizada en otros archivos
    return $db;
}
?>
