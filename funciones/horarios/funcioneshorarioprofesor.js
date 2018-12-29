var tblHorario;

$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
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
        var parametros = {"opcion": "getHorarioProf", "idProf": ""};
        $.ajax({
            data: parametros,
            url: 'funciones/horarios/horariosControlador.php',
            type: 'POST',
            success: function (horario) {
                if (horario){
                    dias.forEach(function(dia){                    
                        var clases = horario['data'][dia];
                        if (clases.length > 0){
                            clases.forEach(function(clase){                            
                                var desde = clase['desde'];
                                var hasta = clase['hasta'];
                                
                            });
                        }
                    });
                }
            }
        });
    }
});