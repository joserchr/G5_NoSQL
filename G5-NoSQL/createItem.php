<?php
require 'connectDB.php';

// Verificar si la solicitud es mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    // Convertir precio a tipo double
    $precio = (double)$_POST['precio'];
    // Convertir cantidad a tipo int
    $cantidad = (int)$_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $talla = $_POST['talla'];

    // Manejar la imagen
    $imagen = $_FILES['imagen'];
    $imagenNombre = $imagen['name'];
    $imagenTipo = $imagen['type'];
    $imagenTmpName = $imagen['tmp_name'];
    $imagenError = $imagen['error'];
    $imagenSize = $imagen['size'];

    // Ruta donde se guardará la imagen
    $rutaImagen = 'img/' . $imagenNombre;

    // Mover la imagen al directorio deseado
    if (move_uploaded_file($imagenTmpName, $rutaImagen)) {
        // Conectar a la base de datos
        $db = connectDB();

        // Insertar la nueva prenda en la colección de prendas
        try {
            $result = $db->Productos->insertOne([
                'Nombre' => $nombre,
                'idMarca' => new MongoDB\BSON\ObjectID($marca),
                'idCategoria' => new MongoDB\BSON\ObjectID($categoria),
                'Precio' => $precio,
                'Cantidad' => $cantidad,
                'Descripcion' => $descripcion,
                'Color' => $color,
                'Talla' => $talla,
                'Imagen' => $rutaImagen  // Guardar la ruta de la imagen en la base de datos
            ]);

            // Verificar si la prenda fue insertada correctamente
            if ($result->getInsertedCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Prenda registrada exitosamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar la prenda.']);
            }
        } catch (Exception $e) {
            echo 'Error al insertar la prenda en la base de datos: ' . $e->getMessage();
        }
    } else {
        echo 'Error al mover la imagen al directorio deseado.';
    }
}
?>

