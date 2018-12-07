var tblCursos;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        },        
        {
            "orderable": false,
            "targets": 6            
        }, {
            "orderable": false,
            "targets": 7,
            "bVisible": false,
            "searchable": false
        }];//opciones que tendran las columnas en la tabla

    tblCursos = inicializartable('#tblCursos', column,0);

    tblCursos.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblCursos.on('order.dt search.dt', function () {
        tblCursos.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblCursos.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaCursos();

    function cargarTablaCursos() {
        var parametros = {"opcion": "listaCursos"};
        $.ajax({
            data: parametros,
            url: 'funciones/horarios/horariosControlador.php',
            type: 'POST',
            success: function (data) {
                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado'];
                    tblCursos.row.add([
                        '',
                        data['data'][i]['curso'],
                        data['data'][i]['nivel'],
                        data['data'][i]['paralelo'],
                        data['data'][i]['jornada'],
                        data['data'][i]['aInicio']+'-'+data['data'][i]['aFin'],
                        //data['data'][i]['nombre']+' '+data['data'][i]['apellido'],
                        '<button type="button" onclick="setModalHorario('+i+')" class="btn-line btn btn-warning btn-sm" title="Gestionar horario"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['id']
                    ]).draw(false);
                }
            }
        });
    }

    function refreshTablaCursos() {
        tblCursos.clear().draw();
        cargarTablaCursos();
    }        
        
    var cont=0;
    $('.addHora').click(function(e) {
        var element = $('#'+e.target.value);
        console.log(element);
        
        var desde = $('<input style="min-width:110px;" type="time" name="desde[]" value="00:00" />');
        var hasta = $('<input style="min-width:110px;" type="time" name="hasta[]" value="00:00" />');
        var closebtn = $('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
        var divalert = $('<div class="alert alert-info alert-dismissible"></div>');
        var materia = $('<select id="materia" name="materia[]" style="max-width:110px;"></select>');
        materia.append($('<option selected disabled style="display:none;">Seleccionar...</option>'));
        
        var parametros = {"opcion":"materiasCurso", "idCurso":$('#idCurso').text()};
        $.ajax({
            type: "POST",
            url: "funciones/horarios/horariosControlador.php",
            data: parametros,
            success: function(data){
                if (data['data']){
                    for (var i = 0; i < data['data'].length; i++) {
                        materia.append($('<option>', {
                            value: data['data'][i]['id'],
                            text: data['data'][i]['materia']
                        }));
                    }
                } else {
                    materia.append($('<option disabled value="-">Sin registros</option>'));
                }
            }
        });
                
        divalert.append(closebtn);
        divalert.append($('<label for="desde">Desde:</label>'));
        divalert.append(desde);
        divalert.append($('<label for="hasta">Hasta:</label>'));
        divalert.append(hasta);
        divalert.append($('<label for="materia">Materia:</label>'));
        divalert.append(materia);
        
        element.append(divalert);
        
        cont++;
    });
    
    $('#guardarHorario').submit(function(){
        $.ajax({
            type: "POST",
            url: "",
            data: {"opcion": "Guardar_horario", "horasDesde": $('#'), "horasHasta": $('#'), "materias": $('#')},
            success: function(data){
                
            }
        });
    });
    
});


function setModalHorario(index){
    var data = tblCursos.row(index).data();    
    var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
    $('#curso-name').text(data[1]+' - '+data[3]);
    $('#idCurso').text(data[7]);
    
    dias.forEach(function(dia){
        $('#'+dia).children().remove();        
    });
    
    $('#editor').modal('show');    
}
