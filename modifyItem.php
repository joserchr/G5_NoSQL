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
    $id = $_POST['id']; // Asegúrate de recibir el ID de la prenda a editar

    // Verificar si se proporcionó una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Manejar la imagen
        $imagen = $_FILES['imagen'];
        $imagenNombre = $imagen['name'];
        $imagenTmpName = $imagen['tmp_name'];

        // Ruta donde se guardará la nueva imagen
        $rutaImagen = 'img/' . $imagenNombre;

        // Mover la imagen al directorio deseado
        if (move_uploaded_file($imagenTmpName, $rutaImagen)) {
            // Actualizar la ruta de la imagen en la base de datos
            $db = connectDB();
            $result = $db->Productos->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($id)], // Filtrar por ID de la prenda que se está editando
                ['$set' => [
                    'Nombre' => $nombre,
                    'idMarca' => new MongoDB\BSON\ObjectID($marca),
                    'idCategoria' => new MongoDB\BSON\ObjectID($categoria),
                    'Precio' => $precio,
                    'Cantidad' => $cantidad,
                    'Descripcion' => $descripcion,
                    'Color' => $color,
                    'Talla' => $talla,
                    'Imagen' => $rutaImagen // Actualizar la ruta de la imagen
                ]] // Actualizar los demás campos de la prenda
            );
            if ($result->getModifiedCount() === 1) {
                echo json_encode(['success' => true, 'message' => 'Prenda actualizada exitosamente.']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la prenda.']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al subir la nueva imagen.']);
            exit;
        }
    } else {
        // Si no se proporciona una nueva imagen, simplemente actualiza los demás campos en la base de datos
        $db = connectDB();
        $result = $db->Productos->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($id)], // Filtrar por ID de la prenda que se está editando
            ['$set' => [
                'Nombre' => $nombre,
                'idMarca' => new MongoDB\BSON\ObjectID($marca),
                'idCategoria' => new MongoDB\BSON\ObjectID($categoria),
                'Precio' => $precio,
                'Cantidad' => $cantidad,
                'Descripcion' => $descripcion,
                'Color' => $color,
                'Talla' => $talla
            ]] // Actualizar los demás campos de la prenda
        );
        if ($result->getModifiedCount() === 1) {
            echo json_encode(['success' => true, 'message' => 'Prenda actualizada exitosamente.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la prenda.']);
            exit;
        }
    }
}
?>
