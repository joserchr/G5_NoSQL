<?php
$servername = "localhost";  // Cambia esto con la información de tu servidor MySQL
$username = "root";   // Cambia esto con tu nombre de usuario de MySQL
$password = ""; // Cambia esto con tu contraseña de MySQL
$dbname = "tienda"; // Cambia esto con el nombre de tu base de datos

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Mostrar los productos en la página
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<h2>" . $row["nombre"] . "</h2>";
        echo "<p><strong>Código:</strong> " . $row["codigo"] . "</p>";
        echo "<p><strong>Detalle:</strong> " . $row["detalle"] . "</p>";
        echo "<p><strong>Precio:</strong> $" . $row["precio"] . "</p>";
        echo "<img class='producto-imagen' src='" . $row["imagen"] . "' alt='" . $row["nombre"] . "'>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron productos.";
}

// Cerrar la conexión
$conn->close();
?>
