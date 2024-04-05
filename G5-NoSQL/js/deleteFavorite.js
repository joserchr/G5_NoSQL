$(".btn-delete-product-favorite").click(function(e) {
    e.preventDefault();
    var productoId = $(this).data('id');
    // Utiliza una ventana modal para confirmar la eliminación
    $('#confirmModal').modal('show');
    // Maneja el clic en el botón "Eliminar" en la ventana modal
    $('#confirmDeleteButton').off('click').on('click', function() {
        $('#confirmModal').modal('hide');
        // Realiza la llamada AJAX para eliminar el elemento
        $.ajax({
            url: "deleteFavorite.php", // URL del script para eliminar el elemento
            type: 'GET', // Método de solicitud POST para enviar el ID del producto
            data: { id: productoId }, // Enviar el ID del producto
            success: function(response) {
                // Manejar la respuesta si es necesario
                location.reload(); // Recargar la página después de eliminar el elemento
            },
            error: function(xhr, status, error) {
                // Manejar errores de conexión o de otro tipo
                console.error(error);
                //alert("Error al eliminar el producto de favoritos");
                // Registro fallido, mostrar modal de error
                $("#deletePrendaFallida .modal-body p").text(response.message);
                $("#deletePrendaFallida").modal("show");
            }
        });
    });
});

$(".btn-cart-product").click(function(e) {
    e.preventDefault();
    var productoId = $(this).data('id');
    // Realiza la llamada AJAX para añadir el producto a los favoritos
    $.ajax({
        url: "addToCart.php", // URL del script para añadir el producto a los favoritos
        type: 'POST', // Método de solicitud POST para enviar el ID del producto
        data: { productId: productoId }, // Enviar el ID del producto
        success: function(response) {
            $('#cartModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Manejar errores de conexión o de otro tipo
            console.error(error);
            //alert("Error al añadir el producto a favoritos");
            $("#addItemFailedModal .modal-body p").text(error);
            $("#addItemFailedModal").modal("show");
        }
    });
});