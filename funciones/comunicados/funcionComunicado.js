 $(document).ready(function () {
//        $('#edito_txt').Editor();
    $('.summernote').summernote({
        height: 300
    });
    
    /*
    $('.note-statusbar').append(
        $('<div class="adjunto-panel" style="padding: 0px 10px"></div>')
    );*/
    
    $('.note-view').hide();
    
    $('.note-toolbar').append(
        $('<div class="note-btn-group btn-group"></div>').append($('<input type="file" name="adjunto">'))
    );
    
    $('[name="adjunto"]').on('change', function(){
        $('.adjunto-panel').children().empty();
        $('.adjunto-panel').append(
                $('<div id="filename" class="alert alert-secondary" role="alert" style="margin: 5px; height: 100px; width: 200px; color: white; background-color: gray">'+$(this).val().split('\\')[2]+'</div>').append(
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'));                                
        $(this).val("");
        
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


