$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#marca").on("blur", function() {
        validateName();
    });



    // Validación del nombre
    function validateName() {
        var name = $("#marca").val();
        var namePattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
        if (!namePattern.test(name) || name.trim() === "") {
            $("#marca").addClass("is-invalid");
            $("#marca-error").show();
            return false;
        } else {
            $("#marca").removeClass("is-invalid");
            $("#marca").hide();
            return true;
        }
    }

    // Manejador de envío del formulario
    $("#editMarca").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateName()) {
            // Construir objeto FormData para enviar archivos
            var formData = new FormData(this);
            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "modifyMarca.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false, // No procesar datos (importante para enviar archivos)
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Registro exitoso, mostrar modal de éxito y redireccionar
                        $("#actualizacionMarcaExitosaModal").modal("show");
                        setTimeout(function() {
                            window.location.href = "marca.php";
                        }, 2000); // Redireccionar después de 2 segundos
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#actualizacionMarcaFallidaModal .modal-body p").text(response.message);
                        $("#actualizacionMarcaFallidaModal").modal("show");
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