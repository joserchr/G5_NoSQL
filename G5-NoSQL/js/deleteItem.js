$("button[data-id]").click(function(e) {
    e.preventDefault();
    var productoId = $(this).data('id');
    // Utiliza una ventana modal para confirmar la eliminación
    $('#confirmModal').modal('show');
    // Maneja el clic en el botón "Eliminar" en la ventana modal
    $('#confirmDeleteButton').off('click').on('click', function() {
        $('#confirmModal').modal('hide');
        // Realiza la llamada AJAX para eliminar el elemento
        $.ajax({
            url: "deleteItem.php", // URL del script para eliminar el elemento
            type: 'POST', // Método de solicitud POST para enviar el ID del producto
            data: { id: productoId }, // Enviar el ID del producto
            success: function(response) {
                // Manejar la respuesta si es necesario
                location.reload(); // Recargar la página después de eliminar el elemento
            },
            error: function(xhr, status, error) {
                // Registro fallido, mostrar modal de error
                $("#deletePrendaFallida .modal-body p").text(response.message);
                $("#deletePrendaFallida").modal("show");
            }
        });
    });
});