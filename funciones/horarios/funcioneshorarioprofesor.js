var tblHorario;

$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            "className": "col-md-1"
        },        
        {
            "orderable": false,
            "targets": 1,
            "className": "col-md-2"
        }, {
            "orderable": false,
            "targets": 2,
            "className": "col-md-2"
        },        
        {
            "orderable": false,
            "targets": 3,
            "className": "col-md-2"
        },        
        {
            "orderable": false,
            "targets": 4,
            "className": "col-md-2"
        },        
        {
            "orderable": false,
            "targets": 5,
            "className": "col-md-2"
        }];

    tblHorario = inicializartable('#tblHorario', column,0);        

    tblHorario.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    refreshTablaHorario();
    
    function refreshTablaHorario() {
        tblHorario.clear().draw();
        cargarTablaHorario();
    } 
    
    function cargarTablaHorario() {
        var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        var parametros = {"opcion": "getHorarioProf", "idProf": $('#idProf').text()};
        $.ajax({
            data: parametros,
            url: 'funciones/horarios/horariosControlador.php',
            type: 'POST',
            success: function (data) {
                if (data){
                    var horario = data['data']['horario'];                    
                    
                    $.each( horario, function( hora, clases ) {                                                                        
                        var fila = $('<tr></tr>');
                        fila.append($('<td></td>').append(hora));
                        fila.append(clases['Lunes']? crearCellClase(clases['Lunes']['materia'], clases['Lunes']['curso']): $('<td></td>'));
                        fila.append(clases['Martes']? crearCellClase(clases['Martes']['materia'], clases['Martes']['curso']): $('<td></td>'));
                        fila.append(clases['Miercoles']? crearCellClase(clases['Miercoles']['materia'], clases['Miercoles']['curso']): $('<td></td>'));
                        fila.append(clases['Jueves']? crearCellClase(clases['Jueves']['materia'], clases['Jueves']['curso']): $('<td></td>'));
                        fila.append(clases['Viernes']? crearCellClase(clases['Viernes']['materia'], clases['Viernes']['curso']): $('<td></td>'));
                        
                        tblHorario.row.add(fila).draw(false);
                    });
                }
            }
        });
    }
    
    function crearCellClase(materia, curso){
        var cell = $('<div style="padding: 5px"></div>');
        cell.append('<div class="row"><label>Materia:</label> '+materia+'</div>');        
        cell.append('<div class="row"><label>Curso:</label> '+curso+'</div>');        
        return $('<td></td>').append(cell);
    }
    
    /*
    function generarHorarioBase(minimo, maximo){
        var i=1;
        while (minimo < maximo){
            var fila = $('<tr id="fila_'+i+'"></tr>');
            fila.append($('<th align="center">'+minimo.substr(0,5)+' - '+ addTimes(minimo,'00:30:00').substr(0,5)+'</th>'))            
            for (var j=1; j<6; j++){
                fila.append($('<td align="center" id="celda_'+i+'_'+j+'" headers="columna'+j+'"></td>'));
            }            
            
            minimo = addTimes(minimo, '00:30:00');            
            tblHorario.row.add(fila).draw();
        }
    }
    
    function addTimes(hora1, hora2){
        var horas = parseInt(hora1.split(':')[0]);
        var minutos = parseInt(hora1.split(':')[1]);
        
        horas += parseInt(hora2.split(':')[0]);
        minutos += parseInt(hora2.split(':')[1]);        
        
        if (minutos>=60){
            var res = (minutos / 60) | 0;
            horas += res;
            minutos = minutos - (60 * res);
        }
        
        if (horas>=24){
            horas = horas %24;
            horas = horas < 0 ? 24 + horas : +horas;
        }
        
        return (horas<10? '0'+horas: horas) + ':' + (minutos<10? '0'+minutos: minutos) + ':00';
    }
    */
});