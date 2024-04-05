$(".favorite-product").click(function(e) {
    e.preventDefault();
    var productoId = $(this).data('id');
    // Realiza la llamada AJAX para añadir el producto a los favoritos
    $.ajax({
        url: "addToFavorites.php",
        type: 'POST',
        data: { productId: productoId },
        success: function(response) {
            $('#favoritosModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Manejar errores de conexión o de otro tipo
            console.error(error);
            if (xhr.status === 401) {
                $("#addItemFailedModal .modal-body p").text("Por favor, inicia sesión para agregar productos a tus favoritos.");
            } else if (xhr.status === 400) {
                $("#addItemFailedModal .modal-body p").text("Método de solicitud no válido.");
            } else if (xhr.status === 500) {
                $("#addItemFailedModal .modal-body p").text("Error al agregar la prenda a favoritos.");
            }
            $("#addItemFailedModal").modal("show");
        }
    });
});

$(".cart-product").click(function(e) {
    e.preventDefault();
    var productoId = $(this).data('id');
    // Realiza la llamada AJAX para añadir el producto al carrito
    $.ajax({
        url: "addToCart.php",
        type: 'POST',
        data: { productId: productoId },
        success: function(response) {
            $('#cartModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Manejar errores de conexión o de otro tipo
            console.error(error);
            if (xhr.status === 401) {
                $("#addItemFailedModal .modal-body p").text("Por favor, inicia sesión para agregar productos a tu carrito.");
            } else if (xhr.status === 400) {
                $("#addItemFailedModal .modal-body p").text("Método de solicitud no válido.");
            } else if (xhr.status === 500) {
                $("#addItemFailedModal .modal-body p").text("Error al agregar la prenda al carrito.");
            }
            $("#addItemFailedModal").modal("show");
        }
    });
});