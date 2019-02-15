 var destinatarios;
 $(document).ready(function () {
     destinatarios = [];
     var cursosDisp = [];
     
     loadCursosDisponibles();
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
                '<button type="button" class="close" data-dismiss="alert" aria-label="Quitar"><span aria-hidden="true">&times;</span></button>'));                                
        $(this).val("");
        
    });
    
    $('#curso').change(function(){
        let curso = $(this).find(':selected').text();
        let idCurso = Number($(this).val());
        $(this).val('');
        
        if (destinatarios.length === 0){
            $('#cursosSeleccionados').empty();
        }
        
        addCursoBadge(curso, idCurso);
                
    });
    
    function loadCursosDisponibles(){
        var opcion;
        opcion = ($('#tipo').text()==='a')? 'getCursos': 'getCursosProf';
        
        $.ajax({
            url: 'funciones/comunicados/comunicadoControlador.php',
            type: 'POST',
            data: {"opcion":opcion, "username": $('#user').text()},
            success: function (data){
                var cursos = data['data'];
                
                if (cursos){
                    for(var i = 0; i < cursos.length; i++){
                        cursosDisp.push({"id":Number(cursos[i]['id']), "curso":cursos[i]['nombre']+' - '+cursos[i]['paralelo']});
                        $('#curso').append($('<option value='+cursos[i]['id']+'>'+cursos[i]['nombre']+' - '+cursos[i]['paralelo']+'</option>'));
                    }
                    $('#curso').append($('<option value="0">Todos</option>'));
                } else {
                    $('#curso').append($('<option disabled value="-1">No hay cursos</option>'));
                }
            }
        });
    }
    
    function addCursoBadge(curso, idCurso){
        if (idCurso === 0){
            for (var i=0; i<cursosDisp.length; i++){
                addCursoBadge(cursosDisp[i]['curso'],cursosDisp[i]['id']);
            }
        } else if (destinatarios.indexOf(idCurso) < 0){
            $('#cursosSeleccionados').append(
                    $('<div class="alert alert-info alert-dismissible badge-correo">\n\
                    <a class="close" data-dismiss="alert" aria-label="quitar" onclick="updateDestinatarios('+idCurso+')">&times;</a>\n\
                    '+curso+'</div>'));
            destinatarios.push(idCurso);
        }
    }
    
    $('#asunto').change(function(){
        var id = $(this).val();
        
        if ($('#asunto').find(':selected').text() === "Otro"){
            $('.note-editable').empty();
            $('#otroAsunto').show();
            $('#otroAsunto').prop('disabled', false);
        } else{
            $('#otroAsunto').hide();
            $('#otroAsunto').prop('disabled', true);
            $.ajax({
                url: 'funciones/comunicados/comunicadoControlador.php',
                type: 'POST',
                data: {"opcion":"getPlantilla", "id": id},
                success: function (data){
                    var mensaje = data['data']['mensaje'];

                    $('.note-editable').empty();
                    $('.note-editable').append($('<p>'+mensaje['contenido']+'</p>'));
                }
            });
        }                
    });
        
    $('#correoCurso').submit(function (e) {
        e.preventDefault();
        
        if (destinatarios.length){
            var texto = $('.summernote').val();
            var parametros = {'opcion': 'enviarComunicado','cursosDest': destinatarios, 'contenido': texto, 'asunto': $('#asunto').find(':selected').text()};
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
        } else {
            swal({
                title: 'Mensaje',
                text: 'No hay ningún curso seleccionado',
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
            });
        }
        
        return false;
    });

});

function updateDestinatarios(idCurso){    
    destinatarios.splice(destinatarios.indexOf(idCurso),1);
    
    if (destinatarios.length === 0){
        $('#cursosSeleccionados').text('Ninguno seleccionado');
    }
}
