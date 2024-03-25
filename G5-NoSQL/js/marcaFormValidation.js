$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#nombre").on("blur", function() {
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
            $("#marca-error").hide();
            return true;
        }
    }
$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#nombre").on("blur", function() {
        validateName();
    });

    // Validación del nombre
    function validateName() {
        var name = $("#marca").val();
        var namePattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
        if (!namePattern.test(name) || name.trim() === "") {
            $("#marca").addClass("is-invalid");
            // $("#marca-error").show(); // Remove this line
            return false;
        } else {
            $("#marca").removeClass("is-invalid");
            return true;
        }
    }
});


    // Manejador de envío del formulario
    $("#createMarca").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateName()) {

            // Construir objeto FormData para enviar archivos
            var formData = new FormData(this);

            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "createMarca.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false, // No procesar datos (importante para enviar archivos)
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Registro exitoso, mostrar modal de éxito y redireccionar
                        $("#registroMarcaExitosoModal").modal("show");
                        setTimeout(function() {
                            window.location.href = "marca.php";
                        }, 2000); // Redireccionar después de 2 segundos
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#registroMarcaFallidoModal .modal-body p").text(response.message);
                        $("#registroMarcaFallidoModal").modal("show");
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de conexión o de otro tipo
                    console.error(error);
                    $("#registroMarcaFallidoModal .modal-body p").text(error);
                    $("#registroMarcaFallidoModal").modal("show");
                }
            });
        }
    });
});