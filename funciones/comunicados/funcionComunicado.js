 $(document).ready(function () {
//        $('#edito_txt').Editor();
$('.summernote').summernote({
        height: 300
      });
        $('#correoPersonal').submit(function (e) {
            e.preventDefault();
            var texto = $('.summernote').val();
            var parametros = {'correo': $('#correo').val(), 'contenido': texto, 'seleccion': $('#seleccion').val()};
            $.ajax({
                type: "POST",
                url: "funciones/comunicados/comunicadoControlador.php", // El script a dónde se realizará la petición.
                data: parametros, // Adjuntar los campos del formulario enviado.
                beforeSend: function () {
                    $('body').append("<div id='loading' class='loading'></div>");
                },
                success: function (data)
                {
                    $(".loading").remove();
                    swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
                }
            });
            return false;
        });

    });


