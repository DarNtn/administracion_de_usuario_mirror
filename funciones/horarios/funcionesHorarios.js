var tblCursos;
var tblHorario;
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
    
    var columnH = [{
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

    tblHorario = inicializartablesencilla('#tblHorario', columnH, 0)
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
    
    $('#agregarFila').click(function(){
        agregarFilaHorario();
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
        var filasTbl = $('#tblHorario tr');
        
        for (var i=1; i<filasTbl.length; i++){
            var desde = filasTbl[i].cells[0].childNodes[0].childNodes[1].value;
            var hasta = filasTbl[i].cells[0].childNodes[0].childNodes[3].value;
            for (var j=1; j<=5; j++){
                var mat = filasTbl[i].cells[j].childNodes[0].childNodes[1].value;
                horario[dias[j-1]].push({desde: desde, hasta: hasta, materia: mat});
            }
        }                
        
        return horario;
    } 
   
   function validarHorario(horario){        
        var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        var constraints = [];
        var correcto = true;        
        var dia = 'Lunes';
        for (var k=0; k<horario[dia].length; k++){
            var clase = horario[dia][k];
            if (clase['desde']<clase['hasta']){
                if (k==0){
                    constraints.push([clase['desde'],clase['hasta']]);
                } else {
                    let size = constraints.length;
                    for (var i=0; i<size; i++){
                        var lim = constraints[i];                        
                        if (clase['hasta']<=lim[0] || clase['desde']>=lim[1]){
                            constraints.push([clase['desde'],clase['hasta']]);
                        } else {
                            correcto = false;
                            swal({
                                title: 'Mensaje',
                                text: 'Existe cruce en la hora de inicio y finalización',
                                type: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Cerrar'
                            });
                            break;
                        }
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
                            
        return correcto;
    }    
});

function agregarFilaHorario(){
    var fila = $('<tr></tr>');            
        
    fila.append($('<td></td>').append(createInputHoras()));
    for (var i=0; i<5; i++){
        var mat = $('<td></td>');
        var divmat = $('<div id="mat'+i+'"></div>');
        divmat.append($('<label for="materia">Materia:</label>'));
        divmat.append(createSelectMaterias());
        fila.append(mat.append(divmat));
        fila.append(mat);
    }
    
    tblHorario.row.add(fila).draw(false);
}

function createInputHoras(inicio="--:--", fin="--:--"){
    var desde = $('<input required style="min-width:90px;" type="time" name="desde[]" value="'+inicio+'" />');
    var hasta = $('<input required style="min-width:90px;" type="time" name="hasta[]" value="'+fin+'" />');    
    var divalert = $('<div class="" style="margin:7 0;"></div>');
    
    
    divalert.append($('<label for="desde">Desde:</label>'));
    divalert.append(desde);
    divalert.append($('<label for="hasta">Hasta:</label>'));
    divalert.append(hasta);
        
    return divalert;
}

function createSelectMaterias(value=""){    
    var materia = $('<select required name="materia[]" style="max-width:110px;"></select>');
    materia.append($('<option selected disabled style="display:none;" value="">Seleccionar...</option>'));    

    var parametros = {"opcion":"materiasCurso", "idCurso":CursoID};
    $.ajax({
        type: "POST",
        url: "funciones/horarios/horariosControlador.php",
        data: parametros,
        success: function(data){
            if (data['data']){
                for (var i = 0; i < data['data'].length; i++) {                
                    if (value===data['data'][i]['id']){
                        materia.append($('<option value="'+data['data'][i]['id']+'" selected>'+data['data'][i]['materia']+'</option>'));
                    } else {
                        materia.append($('<option value="'+data['data'][i]['id']+'">'+data['data'][i]['materia']+'</option>'));
                    }
                }
            } else {
                materia.append($('<option disabled value="-">Sin registros</option>'));
            }
        }
    });        
    
    return materia;
}


function setModalHorario(index){
    var data = tblCursos.row(index).data();    
    CursoID = data[7];    
    var dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
    $('#curso-name').text(data[1]+' - '+data[3]);    
    
    // CARGAR HORARIO DEL CURSO ALMACENADO EN LA BASE  
    tblHorario.clear().draw();
    $.ajax({
        type: "POST",
        url: "funciones/horarios/horariosControlador.php",
        data: {"opcion": "getHorario", "idCurso":CursoID},
        success: function (data) {
            if (data){
                var horario = data['data']['horario'];                    

                $.each( horario, function( hora, clases ) {
                    var inicio = hora.split(' - ')[0];
                    var fin = hora.split(' - ')[1];
                    var fila = $('<tr></tr>');
                    fila.append($('<td></td>').append(createInputHoras(inicio, fin)));
                    dias.forEach(function(dia){
                        var divmat = $('<div id="mat'+clases[dia]['materia']+'"></div>');
                        divmat.append($('<label for="materia">Materia:</label>'));
                        divmat.append(createSelectMaterias(clases[dia]['materia']));
                        fila.append($('<td></td>').append(divmat));
                    });
                    
                    tblHorario.row.add(fila).draw(false);
                });
            }
        }
    });    
    
    $('#editor').modal('show');    
}
