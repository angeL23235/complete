$(function () {
    $("#signup").click(function () {
        $("#firstname").fadeOut("fast", function () {
            $("#second").fadeIn("fast");
        });
    });

    $("#signin").click(function () {
        $("#second").fadeOut("fast", function () {
            $("#first").fadeIn("fast");
        });
    });

    $("form[name='login']").validate({
        rules: {
            doc: {
                required: true,
                email: true
            },
            pass: {
                required: true
            }
        },
        messages: {
            email: "Por favor revise el numero de documento",
            password: "Por favor revise la contraseña"
        }
    });
});

