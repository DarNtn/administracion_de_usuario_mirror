var tblCursos;
var CursoID;
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
            
    $('.addHora').click(function(e) {
        var element = $('#'+e.target.value);        
        
        var desde = $('<input required style="min-width:110px;" type="time" name="desde[]" value="--:--" />');
        var hasta = $('<input required style="min-width:110px;" type="time" name="hasta[]" value="--:--" />');
        var closebtn = $('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
        var divalert = $('<div class="alert alert-info alert-dismissible"></div>');
        var materia = $('<select required id="materia" name="materia[]" style="max-width:110px;"></select>');
        materia.append($('<option selected disabled style="display:none;" value="">Seleccionar...</option>'));
        
        var parametros = {"opcion":"materiasCurso", "idCurso":CursoID};
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
                
    });
    
    $('#guardarHorario').submit(function(){        
        var horario = generarHorario();
        
        if (validarHorario(horario)){
            $.ajax({
                type: "POST",
                url: "funciones/horarios/horariosControlador.php",
                data: {"opcion": "Guardar_horario", "horario":horario, "curso": CursoID},
                success: function(data){
                    swal({
                        title: 'Mensaje',
                        text: data['data']['mensaje'],
                        type: data['data']['estado'],
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                    }).then(function () {                        
                        if (data['data']['estado'] === "success") {
                            $('#editor').modal('hide');
                        }
                    });
                }
            });
        }        
        return false;
    });
    
    
    function generarHorario(){
        var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        var horario = {Lunes:[], Martes:[], Miercoles:[], Jueves:[], Viernes:[]};
        
        dias.forEach(function(dia){
            if ($("#"+dia).children().length > 0){
                var desde = $("#"+dia+" input[name='desde[]']");
                var hasta = $("#"+dia+" input[name='hasta[]']");
                var materia = $("#"+dia+" select");
                for (var i=0; i<desde.length; i++){
                    horario[dia].push({desde:desde[i].value, hasta:hasta[i].value, materia:materia[i].value});                    
                }
            }
        });
        
        return horario;
    }
    
    function validarHorario(horario){        
        var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        var constraints = [];
        var correcto = true;
        for (var j=0; j<dias.length; j++){
            var dia = dias[j];
            for (var k=0; k<horario[dia].length; k++){
                var clase = horario[dia][k];
                if (clase['desde']<clase['hasta']){
                    for (var i=0; i<constraints.length; i++){
                        var lim = constraints[i];
                        if (clase['hasta']<=lim[0] || clase['desde']>=lim[1]){
                            constraints.push([clase['desde'],clase['hasta']]);
                        } else {
                            correcto = false;
                            swal({
                                title: 'Mensaje',
                                text: 'Existe cruce de horarios en el día '+dia,
                                type: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Cerrar'
                            });
                            break;
                        }
                    }            
                } else {
                    correcto = false;
                    swal({
                        title: 'Mensaje',
                        text: 'La hora de inicio no puede ser mayor o igual a la hora de salida',
                        type: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                    });
                }
                if (!correcto){
                    break;
                }
            }
            if (!correcto){
                break;
            } else {
                constraints = [];
            }            
        }
        return correcto;
    }
    
});


function setModalHorario(index){
    var data = tblCursos.row(index).data();    
    CursoID = data[7];
    var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
    $('#curso-name').text(data[1]+' - '+data[3]);    
    
    dias.forEach(function(dia){
        $('#'+dia).children().remove();        
    });
    
    // CARGAR HORARIO DEL CURSO ALMACENADO EN LA BASE
    var materia = $('<select required id="materia" name="materia[]" style="max-width:110px;"></select>');;
    var parametros = {"opcion":"materiasCurso", "idCurso":CursoID};
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
            }
        }
    });
    
    $.ajax({
        type: "POST",
        url: "funciones/horarios/horariosControlador.php",
        data: {"opcion": "getHorario", "idCurso":CursoID},
        success: function(horario){
            if (horario){
                dias.forEach(function(dia){                    
                    var clases = horario['data'][dia];
                    if (clases.length > 0){
                        clases.forEach(function(clase){                            
                            var desde = $('<input required style="min-width:110px;" type="time" name="desde[]" value="'+clase['desde']+'" />');
                            var hasta = $('<input required style="min-width:110px;" type="time" name="hasta[]" value="'+clase['hasta']+'" />');
                            var closebtn = $('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
                            var divalert = $('<div class="alert alert-info alert-dismissible"></div>');                            
                            var mat = materia.clone();
                            mat.val(clase['materia']);
                            
                            divalert.append(closebtn);
                            divalert.append($('<label for="desde">Desde:</label>'));
                            divalert.append(desde);
                            divalert.append($('<label for="hasta">Hasta:</label>'));
                            divalert.append(hasta);
                            divalert.append($('<label for="materia">Materia:</label>'));
                            divalert.append(mat);
                            
                            $('#'+dia).append(divalert);
                        });
                    }
                });
            }
        }
    });
    //
    
    $('#editor').modal('show');    
}