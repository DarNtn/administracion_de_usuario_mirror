var tblCitaciones;

$(document).ready(function () {
    var column = [
        {
            "orderable": false,
            "targets": 0,            
            "searchable": false,
            "className": "col-md-1"
        },
        {
            "orderable": true,
            "targets": 1,
            "className": "col-md-2 align-left"
        },
        {
            "orderable": false,
            "targets": 2,
            "className": "col-md-2 align-left"
        },
        {            
            "targets": 3,
            "className": "col-md-1 align-left"
        },
        {            
            "targets": 4,
            "className": "col-md-1 align-left"
        },
        {
            "orderable": false,
            "targets": 5,            
            "searchable": false,
            "className": "col-md-1 align-left"
        },
        {
            "orderable": false,
            "targets": 6,
            "bVisible": false,
            "searchable": false
        }
    ];
    
    tblCitaciones = inicializartable('#tblCitaciones', column, 4);
    
    refreshTablaCitaciones();
    
    function refreshTablaCitaciones(){
        $.ajax({
            url: 'funciones/citaciones/citacionControlador.php',
            type:'POST',
            data: {"opcion": "citaciones", "user": $('#username').val()},
            success: function(data){
                var citaciones = data['data'];
                for (var i = 0; i < citaciones.length; i++) {                                      
                    tblCitaciones.row.add([
                        '',
                        citaciones[i]['curso']+" "+citaciones[i]['paralelo'],
                        citaciones[i]['asunto'],                        
                        citaciones[i]['fecha'],
                        citaciones[i]['hora'],
                        '<div class="row"><button type="button" onclick="abrirCitacion('+i+')" class="btn-line btn btn-warning btn-sm" title="Ver mensaje"><i class="glyphicon glyphicon-eye-open"></i></button>\n\
                        <button hidden type="button" onclick="borrarMensaje('+i+')" class="btn-line btn btn-danger btn-sm" title="Borrar mensaje"><i class="glyphicon glyphicon-trash"></i></button></div>',
                        citaciones[i]['id']
                    ]).draw(false);
                }
            }
        });
    }
});

function abrirCitacion(i){        
    $.ajax({
        url: 'funciones/citaciones/citacionControlador.php',
        type: 'POST',
        data: {"opcion":"getCitacion", "id": tblCitaciones.row(i).data()[6]},
        success: function (data){
            var mensaje = data['data']['mensaje'];
            var adjunto = data['data']['adjunto'];
            var citacion = data['data']['citacion'];
            $('#hora').val(citacion['hora'].substring(0,5));
            $('#asunto').val(mensaje['asunto']);
            $('#contenido').text(mensaje['contenido']+'\n\nDuracion: '+citacion['duración'].substring(0,5));
        }
    });
    $('#mensaje').modal('show');
}

function borrarMensaje(i){
    console.log("borrar mensaje",i);
}