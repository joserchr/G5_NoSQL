<?php
require 'connectDB.php';
// Verifica si se recibió un ID de usuario válido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el ID de usuario
    $userId = $_POST['userId'];
    // Obtiene los demás datos del formulario
    $direccion = $_POST['direccion'];
    $total = $_POST['total'];
    // Decodificar la cadena JSON de los items del pedido
    $items = json_decode($_POST['items'], true);
    foreach ($items as &$item) {
        // Asegúrate de que $item['idProducto'] es una cadena que representa un ObjectId válido
        // Si $item['idProducto'] es un array con la clave '$oid', extrae el valor de esa clave
        if (is_array($item['idProducto']) && isset($item['idProducto']['$oid'])) {
            $item['idProducto'] = $item['idProducto']['$oid'];
        }
        // Convertir el productoId a ObjectId
        $item['idProducto'] = new MongoDB\BSON\ObjectId($item['idProducto']);
    }
    // Obtiene la fecha actual en el formato deseado (día/mes/año)
    $fechaActual = date('d/m/Y');
    // Crea un nuevo documento de pedido en la colección "Pedidos"
    $pedido = [
        'idUsuario' => new MongoDB\BSON\ObjectID($userId),
        'Fecha' => $fechaActual,
        'Hora' => date('H:i:s'),
        'Estado' => 'Pendiente',
        'DireccionEnvio' => $direccion,
        'Items' => $items,
        'Total' => $total
    ];
    // Conectar a la base de datos
    $db = connectDB();
    // Guarda el pedido en la base de datos
    $result = $db->Pedidos->insertOne($pedido);

    // Recuperar los detalles de los productos involucrados en el pedido
    $productIds = array_map(function($item) {
        return $item['idProducto'];
    }, $items);
    $productos = $db->Productos->find(['_id' => ['$in' => $productIds]]);

    // Actualizar la cantidad de inventario para cada producto
    foreach ($productos as $producto) {
        $productoId = $producto->_id;
        $cantidadVendida = array_reduce($items, function($carry, $item) use ($productoId) {
            return $carry + ($item['idProducto'] == $productoId ? $item['cantidad'] : 0);
        }, 0);

        // Actualizar la cantidad de inventario
        $db->Productos->updateOne(
            ['_id' => $productoId],
            ['$inc' => ['Cantidad' => -$cantidadVendida]]
        );
    }

    // Elimina los items del carrito del usuario actual
    $deleteResult = $db->Carrito->deleteMany(['idUsuario' => new MongoDB\BSON\ObjectID($userId)]);
    // Redirige al usuario a myaccount.php
    header('Location: my-account.php');
    exit;
} else {
    // Si no se recibió un ID de usuario válido, redirige al usuario a una página de error
    echo "Error al crear el pedido.";
    exit;
}
?>

