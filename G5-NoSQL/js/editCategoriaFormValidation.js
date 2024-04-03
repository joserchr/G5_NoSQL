$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#categoria").on("blur", function() {
        validateName();
    });



    // Validación del nombre
    function validateName() {
        var name = $("#categoria").val();
        var namePattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
        if (!namePattern.test(name) || name.trim() === "") {
            $("#categoria").addClass("is-invalid");
            $("categoria-error").show();
            return false;
        } else {
            $("#categoria").removeClass("is-invalid");
            $("#categoria-error").hide();
            return true;
        }
    }


    // Manejador de envío del formulario
    $("#editCategoria").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateName()) {
            // Construir objeto FormData para enviar archivos
            var formData = new FormData(this);
            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "modifyCategoria.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false, // No procesar datos (importante para enviar archivos)
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Registro exitoso, mostrar modal de éxito y redireccionar
                        $("#actualizacionCategoriaExitosaModal").modal("show");
                        setTimeout(function() {
                            window.location.href = "categoria.php";
                        }, 2000); // Redireccionar después de 2 segundos
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#actualizacionCategoriaFallidaModal .modal-body p").text(response.message);
                        $("#actualizacionCategoriaFallidaModal").modal("show");
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de conexión o de otro tipo
                    console.error(error);
                }
            });
        }
    });
});