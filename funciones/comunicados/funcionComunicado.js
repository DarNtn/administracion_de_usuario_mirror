 $(document).ready(function () {
//        $('#edito_txt').Editor();
    $('.summernote').summernote({
        height: 300
    });
    
    $('.note-statusbar').append(
        $('<div class="adjunto-panel" style="padding: 0px 10px"></div>')
    );
    
    $('.note-view').hide();
    
    $('.note-toolbar').append(
        $('<div class="note-btn-group btn-group"></div>').append($('<input type="file" name="adjunto">'))
    );
        
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


