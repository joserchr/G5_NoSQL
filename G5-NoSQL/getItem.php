<?php
// Incluir el archivo de conexión a la base de datos
require 'connectDB.php';
// Verificar si se recibió el ID del pedido
if(isset($_POST['pedidoId'])) {
    // Obtener el ID del pedido
    $pedidoId = $_POST['pedidoId'];
    // Conectar a la base de datos
    $db = connectDB();
    // Buscar el pedido por su ID
    $pedido = $db->Pedidos->findOne(['_id' => new MongoDB\BSON\ObjectID($pedidoId)]);
    // Verificar si se encontró el pedido
    if ($pedido) {
        // Obtener los items del pedido
        $items = $pedido->Items;
        // Inicializar un array para almacenar los detalles de los productos
        $productosDetalles = [];
        // Iterar sobre los items y obtener los detalles de los productos por su ID
        foreach ($items as $item) {
            // Obtener el ID del producto
            $idProducto = $item->idProducto;
            // Buscar el producto por su ID
            $producto = $db->Productos->findOne(['_id' => $idProducto]);
            // Verificar si se encontró el producto
            if ($producto) {
                // Agregar los detalles del producto al array
                $productosDetalles[] = [
                    'nombre' => $producto->Nombre,
                    'talla' => $producto->Talla,
                    'color' => $producto->Color,
                    'imagen' => $producto->Imagen,
                    'precio' => $producto->Precio,
                    'cantidad' => $item->cantidad
                ];
            }
        }
        // Devolver los detalles de los productos en formato JSON
        echo json_encode($productosDetalles);
    } else {
        // Si no se encontró el pedido, devolver un mensaje de error en formato JSON
        echo json_encode(['error' => 'Pedido no encontrado']);
    }
} else {
    // Si no se recibió el ID del pedido, devolver un mensaje de error en formato JSON
    echo json_encode(['error' => 'ID del pedido no proporcionado']);
}
?>


