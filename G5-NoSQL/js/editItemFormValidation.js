$(document).ready(function() {
    // Manejador de entrada para el campo de nombre
    $("#nombre").on("blur", function() {
        validateName();
    });

    // Manejador de entrada para el campo de marca
    $("#marca").on("change", function() {
        validateMarca();
    });

    // Manejador de entrada para el campo de categoría
    $("#categoria").on("change", function() {
        validateCategoria();
    });

    // Manejador de entrada para el campo de precio
    $("#precio").on("blur", function() {
        validatePrice();
    });

    // Manejador de entrada para el campo de cantidad
    $("#cantidad").on("blur", function() {
        validateQuantity();
    });

    // Manejador de entrada para la dirección
    $("#descripcion").on("blur", function() {
        validateDescription();
    });

    // Manejador de entrada para el campo de imagen
    $("#imagen").on("change", function() {
        validateImage();
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

    // Validación de la marca
    function validateMarca() {
        var marca = $("#marca").val();
        if (marca === "") {
            $("#marca").addClass("is-invalid");
            $("#marca-error").show();
            return false;
        } else {
            $("#marca").removeClass("is-invalid");
            $("#marca-error").hide();
            return true;
        }
    }

    // Validación de la categoría
    function validateCategoria() {
        var categoria = $("#categoria").val();
        if (categoria === "") {
            $("#categoria").addClass("is-invalid");
            $("#categoria-error").show();
            return false;
        } else {
            $("#categoria").removeClass("is-invalid");
            $("#categoria-error").hide();
            return true;
        }
    }

    // Validación del precio
    function validatePrice() {
        var price = $("#precio").val();
        var pricePattern = /^\d+(\.\d{1,2})?$/; // Expresión regular para validar precio con dos decimales
        if (!pricePattern.test(price) || price.trim() === "") {
            $("#precio").addClass("is-invalid");
            $("#precio-error").show();
            return false;
        } else {
            $("#precio").removeClass("is-invalid");
            $("#precio-error").hide();
            return true;
        }
    }

    // Validación de la cantidad
    function validateQuantity() {
        var quantity = $("#cantidad").val();
        if (isNaN(quantity) || quantity.trim() === "" || parseInt(quantity) < 1) {
            $("#cantidad").addClass("is-invalid");
            $("#cantidad-error").show();
            return false;
        } else {
            $("#cantidad").removeClass("is-invalid");
            $("#cantidad-error").hide();
            return true;
        }
    }

    // Validación de la dirección
    function validateDescription() {
        var description = $("#descripcion").val();
        if (description.trim() === "") {
            $("#descripcion").addClass("is-invalid");
            $("#descripcion-error").show();
            return false;
        } else {
            $("#descripcion").removeClass("is-invalid");
            $("#descripcion-error").hide();
            return true;
        }
    }

    // Validación del color
    function validateColor() {
        var colorSelected = $("input[name='color']:checked").length > 0;
        if (!colorSelected) {
            $("#color-error").show();
            return false;
        } else {
            $("#color-error").hide();
            return true;
        }
    }

    // Validación de la talla
    function validateTalla() {
        var tallaSelected = $("input[name='talla']:checked").length > 0;
        if (!tallaSelected) {
            $("#talla-error").show();
            return false;
        } else {
            $("#talla-error").hide();
            return true;
        }
    }

    // Validación de la imagen
    function validateImage() {
        var image = $("#imagen").val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; // Extensiones permitidas
        if (!allowedExtensions.exec(image) || image.trim() === "") {
            $("#imagen").addClass("is-invalid");
            $("#imagen-error").show();
            return false;
        } else {
            $("#imagen").removeClass("is-invalid");
            $("#imagen-error").hide();
            return true;
        }
    }

    // Manejador de envío del formulario
    $("#editItem").on("submit", function(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Validación de los campos del formulario
        if (validateName() && validateMarca() && validateCategoria() && validatePrice() &&
            validateQuantity() && validateDescription() && validateColor() && validateTalla()) {

            // Construir objeto FormData para enviar archivos
            var formData = new FormData(this);

            // Si todos los campos son válidos, enviar los datos del formulario por AJAX
            $.ajax({
                url: "modifyItem.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false, // No procesar datos (importante para enviar archivos)
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Registro exitoso, mostrar modal de éxito y redireccionar
                        $("#actualizacionPrendaExitosaModal").modal("show");
                        setTimeout(function() {
                            window.location.href = "stock.php";
                        }, 2000); // Redireccionar después de 2 segundos
                    } else {
                        // Registro fallido, mostrar modal de error
                        $("#actualizacionPrendaFallidaModal .modal-body p").text(response.message);
                        $("#actualizacionPrendaFallidaModal").modal("show");
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de conexión o de otro tipo
                    $("#registroPrendaFallidoModal .modal-body p").text(error);
                    $("#registroPrendaFallidoModal").modal("show");
                }
            });
        }
    });
});