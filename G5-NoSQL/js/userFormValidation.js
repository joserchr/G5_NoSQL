$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#nombre").on("blur", function() {
        validateName();
    });

    // Manejador de entrada para el campo de apellidos
    $("#apellidos").on("blur", function() {
        validateLastName();
    });

    // Manejador de entrada para el campo de correo electrónico
    $("#correo").on("blur", function() {
        validateEmail();
    });

    // Manejador de entrada para el campo de teléfono
    $("#telefono").on("blur", function() {
        validatePhone();
    });

    // Manejador de entrada para la dirección
    $("#direccion").on("blur", function() {
        validateAddress();
    });

    // Manejador de entrada para la contraseña
    $("#contraseña").on("blur", function() {
        validatePassword();
    });

    // Manejador de entrada para confirmar contraseña
    $("#confirmarContraseña").on("blur", function() {
        validateConfirmPassword();
    });

    // Validación del nombre
    function validateName() {
        var name = $("#nombre").val();
        var namePattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
        if (!namePattern.test(name) || name.trim() === "") {
            $("#nombre").addClass("is-invalid");
            $("#nombre-error").show();
            return false;
        } else {
            $("#nombre").removeClass("is-invalid");
            $("#nombre-error").hide();
            return true;
        }
    }

    // Validación de apellidos
    function validateLastName() {
        var lastName = $("#apellidos").val();
        var lastNamePattern = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
        if (!lastNamePattern.test(lastName) || lastName.trim() === "") {
            $("#apellidos").addClass("is-invalid");
            $("#apellidos-error").show();
            return false;
        } else {
            $("#apellidos").removeClass("is-invalid");
            $("#apellidos-error").hide();
            return true;
        }
    }

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

    // Validación de número de teléfono
    function validatePhone() {
        var phone = $("#telefono").val();
        var phonePattern = /^[24678]\d{7}$/;
        if (!phonePattern.test(phone) || phone.trim() === "") {
            $("#telefono").addClass("is-invalid");
            $("#telefono-error").show();
            return false;
        } else {
            $("#telefono").removeClass("is-invalid");
            $("#telefono-error").hide();
            return true;
        }
    }

    // Validación de la dirección
    function validateAddress() {
        var address = $("#direccion").val();
        if (address.trim() === "") {
            $("#direccion").addClass("is-invalid");
            $("#direccion-error").show();
            return false;
        } else {
            $("#direccion").removeClass("is-invalid");
            $("#direccion-error").hide();
            return true;
        }
    }

    // Validación de la nueva contraseña
    function validatePassword() {
        var newPassword = $("#contraseña").val();
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!regex.test(newPassword) || newPassword.trim() === "") {
            $("#contraseña").addClass("is-invalid");
            $("#contraseña-error").show();
            return false;
        } else {
            $("#contraseña").removeClass("is-invalid");
            $("#contraseña-error").hide();
            return true;
        }
    }

    // Validación de confirmar contraseña
    function validateConfirmPassword() {
        var newPassword = $("#contraseña").val();
        var confirmPassword = $("#confirmarContraseña").val();

        if (newPassword !== confirmPassword || confirmPassword.trim() === "") {
            $("#confirmarContraseña").addClass("is-invalid");
            $("#confirmarContraseña").show();
            return false;
        } else {
            $("#confirmarContraseña").removeClass("is-invalid");
            $("#confirmarContraseña").hide();
            return true;
        }
    }

    // Manejador de envío del formulario
    $("#createUser").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateName() && validateLastName() && validateEmail() && validatePhone() &&
            validateAddress() && validatePassword() && validateConfirmPassword()) {

            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "createUser.php",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Registro exitoso, mostrar modal de éxito y redireccionar
                        $("#registroExitosoModal").modal("show");
                        setTimeout(function() {
                            window.location.href = "login.php";
                        }, 2000); // Redireccionar después de 2 segundos
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#registroFallidoModal").modal("show");
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de conexión o de otro tipo
                    console.error(textStatus, errorThrown);
                    $("#registroFallidoModal").modal('show')
                }
            });
        }
    });
});