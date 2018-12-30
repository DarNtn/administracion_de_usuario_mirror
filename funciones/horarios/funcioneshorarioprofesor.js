var tblHorario;

$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0            
        },        
        {
            "orderable": false,
            "targets": 1            
        }, {
            "orderable": false,
            "targets": 2
        },        
        {
            "orderable": false,
            "targets": 3       
        },        
        {
            "orderable": false,
            "targets": 4       
        },        
        {
            "orderable": false,
            "targets": 5       
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
                    var minimo = data['data']['minimo'];
                    var maximo = data['data']['maximo'];
                    generarHorarioBase('07:30:00', '13:00:00');
                    dias.forEach(function(dia){                    
                        var clases = horario[dia];
                        if (clases.length > 0){
                            clases.forEach(function(clase){                            
                                //var desde = clase['desde'];
                                //var hasta = clase['hasta'];
                                
                            });
                        }
                    });
                }
            }
        });
    }
    
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
});