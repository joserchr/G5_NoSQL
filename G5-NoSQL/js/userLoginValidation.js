$(document).ready(function() {
    // Manejador de entrada para el campo de correo electrónico
    $("#correo").on("blur", function() {
        validateEmail();
    });

    // Manejador de entrada para la contraseña
    $("#contraseña").on("blur", function() {
        validatePassword();
    });

    // Validación de correo electrónico
    function validateEmail() {
        var email = $("#correo").val();
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email) || email.trim() === "") {
            $("#correo").addClass("is-invalid");
            $("#correo-error").show();
            return false;
        } else {
            $("#correo").removeClass("is-invalid");
            $("#correo-error").hide();
            return true;
        }
    }

    // Validación de la nueva contraseña
    function validatePassword() {
        var password = $("#contraseña").val();
        if (password.trim() === "") {
            $("#contraseña").addClass("is-invalid");
            $("#contraseña-error").show();
            return false;
        } else {
            $("#contraseña").removeClass("is-invalid");
            $("#contraseña-error").hide();
            return true;
        }
    }

    // Manejador de envío del formulario
    $("#userLogin").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateEmail() && validatePassword()) {

            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "userLogin.php",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        window.location.href = "index.php";
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#sesionFallidoModal").modal("show");
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de conexión o de otro tipo
                    console.error(textStatus, errorThrown);
                    $("#sesionFallidoModal").modal("show");
                }
            });
        }
    });
});