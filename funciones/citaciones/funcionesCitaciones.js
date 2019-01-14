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
            "orderable": false,
            "targets": 3,
            "className": "col-md-2 align-left"
        },
        {
            "orderable": false,
            "targets": 6,            
            "searchable": false,
            "className": "col-md-1"
        },
        {
            "orderable": false,
            "targets": 7,
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
            data: {"opcion": "citaciones", "id": "1"},
            success: function(data){
                var citaciones = data['data'];
                for (var i = 0; i < citaciones.length; i++) {                                      
                    tblCitaciones.row.add([
                        '',
                        citaciones[i]['curso']+" "+citaciones[i]['paralelo'],
                        citaciones[i]['asunto']+" "+citaciones[i]['asunto'],
                        citaciones[i]['materia'],
                        citaciones[i]['fecha'],
                        '',
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
        data: {"opcion":"getCitacion", "id": tblCitaciones.row(i).data()[7]},
        success: function (data){
            var mensaje = data['data']['mensaje'];
            var adjunto = data['data']['adjunto'];
            var citacion = data['data']['citacion'];
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