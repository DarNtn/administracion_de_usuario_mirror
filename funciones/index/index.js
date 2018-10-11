$(document).ready(function () {
    $(function () {
        $("#formulario").submit(function () {
            $.ajax({
                type: "POST",
                url: "funciones/index/indexControlador.php", // El script a dónde se realizará la petición.
                data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                success: function (data)
                {
                    if (data['data']['estado'] == "success") {
                        console.log(data['data']['mensaje'])
                        window.location = data['data']['mensaje'];
                    } else {
                        swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
                    }
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        });
    });
});

