var tblEntrada;

$(document).ready(function () {
    var column = [
        {
            "orderable": false,
            "targets": 0,            
            "searchable": false,
            "className": "col-md-1"
        },
        {
            "orderable": false,
            "targets": 3,
            "className": "col-md-5 align-left"
        },
        {
            "orderable": false,
            "targets": 5,            
            "searchable": false,
            "className": "col-md-1"
        },
        {
            "orderable": false,
            "targets": 6,
            "bVisible": false,
            "searchable": false
        }
    ];
    
    tblEntrada = inicializartable('#tblEntrada', column, 4);
    
    refreshTablaEntrada();
    
    function refreshTablaEntrada(){
        $.ajax({
            url: 'funciones/bandejas/bandejaControlador.php',
            type:'POST',
            data: {"opcion": "mensajesEntrada", "user": $('#username').val()},
            success: function(data){
                var mensajes = data['data'];
                if (mensajes){
                    for (var i = 0; i < mensajes.length; i++) {
                        var mensaje = (mensajes[i]['asunto']?mensajes[i]['asunto']:"Sin asunto")+": "+mensajes[i]['contenido'];
                        mensaje = (mensaje.length >67)?mensaje.substring(0,67)+"...":mensaje;                    
                        tblEntrada.row.add([
                            '',
                            mensajes[i]['curso']+" "+mensajes[i]['paralelo'],
                            mensajes[i]['autnombre']+" "+mensajes[i]['autapellido'],
                            mensaje,
                            mensajes[i]['fecha'],
                            '<div class="row"><button type="button" onclick="abrirMensaje('+i+')" class="btn-line btn btn-warning btn-sm" title="Ver mensaje"><i class="glyphicon glyphicon-eye-open"></i></button>\n\
                            <button type="button" onclick="borrarMensaje('+i+')" class="btn-line btn btn-danger btn-sm" title="Borrar mensaje"><i class="glyphicon glyphicon-trash"></i></button></div>',
                            mensajes[i]['id_mensaje']
                        ]).draw(false);
                    }
                }
                
            }
        });
    }
});

function abrirMensaje(i){        
    $.ajax({
        url: 'funciones/bandejas/bandejaControlador.php',
        type: 'POST',
        data: {"opcion":"getMensaje", "id": tblEntrada.row(i).data()[6]},
        success: function (data){
            var mensaje = data['data']['mensaje'];
            var adjunto = data['data']['adjunto'];
            $('#remitente').val(mensaje['autnombre']+" "+mensaje['autapellido']);
            $('#asunto').val(mensaje['asunto']);
            $('#contenido').text(mensaje['contenido']);
        }
    });
    $('#mensaje').modal('show');
}

function borrarMensaje(i){
    console.log("borrar mensaje",i);
}