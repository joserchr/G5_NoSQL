// Capturar el evento de clic en el botón "Ver Prendas"
$(".ver-prendas").click(function(e) {
    e.preventDefault();
    var pedidoId = $(this).data('id');
    // Realizar la solicitud AJAX
    $.ajax({
        url: 'getItem.php',
        method: 'POST',
        data: { pedidoId: pedidoId },
        dataType: 'json',
        success: function(response) {
            // Verificar si se obtuvo una respuesta válida
            if (response && !response.error) {
                // Construir la tabla de detalles de productos
                var tableHTML = '<table class="table table-bordered">' +
                    '<thead class="thead-dark">' +
                    '<tr>' +
                    '<th>Producto</th>' +
                    '<th>Talla</th>' +
                    '<th>Color</th>' +
                    '<th>Cantidad</th>' +
                    '<th>Precio</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                // Iterar sobre los detalles de los productos y agregar filas a la tabla
                $.each(response, function(index, producto) {
                    tableHTML += '<tr>' +
                        ' <td><div class="img"><a href="#"><img src="' + producto.imagen + '" alt="' + producto.nombre + '" style="max-width: 100px;"></a><p>' +
                        producto.nombre + '</p></div></td> ' +
                        '<td>' + producto.talla + '</td>' +
                        '<td>' + producto.color + '</td>' +
                        '<td>' + producto.cantidad + '</td>' +
                        '<td>' + '₡' + producto.precio + '</td>' +
                        '</tr>';
                });
                // Cerrar la tabla
                tableHTML += '</tbody></table>';
                // Insertar la tabla en el cuerpo del modal
                $('#viewItems .modal-body').html(tableHTML);
                // Mostrar el modal
                $('#viewItems').modal('show');
            } else {
                // Mostrar mensaje de error si no se obtuvieron datos del servidor
                alert('Error: No se pudieron obtener los detalles de los productos.');
            }
        },
        error: function(xhr, status, error) {
            // Mostrar mensaje de error en caso de error de la solicitud AJAX
            console.error('Error en la solicitud AJAX:', status, error);
            alert('Error: No se pudo completar la solicitud.');
        }
    });
});

// Manejar el evento click del botón para guardar cambios en el estado de la orden
$(".btn-save-order").click(function(e) {
    e.preventDefault();
    // Obtener el ID de la orden desde el atributo data-id del botón
    var orderId = $(this).data('id');
    // Obtener el nuevo estado seleccionado del <select>
    var newState = $("#estado").val();
    // Realizar la llamada AJAX para modificar el estado de la orden
    $.ajax({
        url: "modifyOrder.php",
        type: "POST",
        dataType: "json",
        data: { orderId: orderId, newState: newState },
        success: function(response) {
            if (response.success) {
                // Registro exitoso, mostrar modal de éxito y redireccionar
                $("#actualizacionOrdenExitosaModal").modal("show");
                setTimeout(function() {
                    window.location.reload();
                }, 2000); // Redireccionar después de 2 segundos
            } else {
                // Si hubo un error, mostrar un mensaje de error
                $("#actualizacionOrdenFallidaModal").modal("show");
            }
        },
        error: function(xhr, status, error) {
            // Manejar errores de conexión u otros errores
            console.error(error);
            $("#actualizacionOrdenFallidaModal").modal('show');
        }
    });
});