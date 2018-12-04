var tblCursos;
var tblMaterias;
var CursoEdit;
$(document).ready(function () {
    var materia_profesor = {}; // clave => id_materia, valor => id_profesor
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        },
        {
            "orderable": false,
            "targets": 6
        },
        {
            "orderable": false,
            "targets": 7,
            className: 'row'
        }, {
            "orderable": false,
            "targets": 8,
            "bVisible": false,
            "searchable": false
        }];//opciones que tendran las columnas en la tabla

    tblCursos = inicializartable('#tblAsignaciones', column,0);

    tblCursos.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblCursos.on('order.dt search.dt', function () {
        tblCursos.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblCursos.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaCursos();
    
    var columnMat = [{        
            "orderable": false,
            "targets": 2,        
            "searchable": false        
        },{
            "orderable": false,
            "targets": 3,
            "searchable": false,
            "bVisible": false
        }
    ];

    tblMaterias = inicializartable('#tblMaterias', columnMat, 0);
    
    $('#tblMaterias tbody').on('click', '#quitar', function () {        
        materia_profesor[tblMaterias.row($(this).parents('tr')).data()[3]] = null;
        tblMaterias
                .row($(this).parents('tr'))
                .remove()
                .draw();
    });

    function cargarTablaCursos() {
        var parametros = {"opcion": "listaCursos"};
        $.ajax({
            data: parametros,
            url: 'funciones/asignaciones/asignacionControlador.php',
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
                        data['data'][i]['nombre']+' '+data['data'][i]['apellido'],
                        '<div class="row"><button type="button" onclick="setModalMaterias('+i+')" class="btn-line modificar btn btn-warning btn-sm" title="Administrar materias"><i class="glyphicon glyphicon-folder-open"></i></button>\n\
                        <button type="button" class="btn-line btn btn-warning btn-sm" title="Administrar estudiantes"><i class="glyphicon glyphicon-user"></i></button>\n\
                        <button type="button" onclick="setModalEditar('+i+')" class="btn-line btn btn-warning btn-sm" title="Editar asignación"><i class="glyphicon glyphicon-edit"></i></button></div>',
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
    
    $('#jornada').change(function(){
        var parametros = {"opcion": "cursosJornada", "jornada":this.value};
        $.ajax({
            type: "POST",
            url: "funciones/asignaciones/asignacionControlador.php",
            data: parametros,
            success: function(data){
                $('#curso option').each(function() {
                    if ( $(this).val() !== '' ) {
                        $(this).remove();
                    }
                });
                if (data['data']){
                    for (var i = 0; i < data['data'].length; i++) {
                        $('#curso').append($('<option>', {
                            value: data['data'][i]['curso'],
                            text: data['data'][i]['curso']
                        }));
                    }
                } else{
                    $('#curso').append('<option disabled value="-">No hay cursos sin asignar</option>');
                }
            }
        });        
    });
    
    $('#curso').change(function(){        
        var parametros = {"opcion": "paralelosCurso", "curso":this.innerText, "jornada": $('#jornada').val()};
        $.ajax({
            type: "POST",
            url: "funciones/asignaciones/asignacionControlador.php",
            data: parametros,
            success: function(data){
                $('#paralelo option').each(function() {
                    if ( $(this).val() !== '' ) {
                        $(this).remove();
                    }
                });
                if (data['data']){
                    for (var i = 0; i < data['data'].length; i++) {
                        $('#paralelo').append($('<option>', {
                            value: data['data'][i]['paralelo'],
                            text: data['data'][i]['paralelo']
                        }));
                    }
                } else{                    
                    $('#paralelo').append('<option disabled value="-">No hay paralelos sin asignar</option>');
                }
            }
        });
    });

    $("#asignarDirigente").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/asignaciones/asignacionControlador.php", // El script a dónde se realizará la petición.
            data: $("#asignarDirigente").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaCursos();
                swal({
                    title: 'Mensaje',
                    text: data['data']['mensaje'],
                    type: data['data']['estado'],
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                }).then(function () {
                    if (data['data']['estado'] == "success") {
                        document.getElementById("asignarDirigente").reset();
                        $('#nuevo').modal('hide');
                    }
                });
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
       

    $("#cambiarDirigente").submit(function () {
        toggleDisableEdit();
        $.ajax({
            type: "POST",
            url: "funciones/asignaciones/asignacionControlador.php", // El script a dónde se realizará la petición.
            data: $("#cambiarDirigente").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaCursos();
                swal({
                    title: 'Mensaje',
                    text: data['data']['mensaje'],
                    type: data['data']['estado'],
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                }).then(function () {
                    toggleDisableEdit();
                    if (data['data']['estado'] == "success") {
                        $('#editar').modal('hide');
                    }
                });
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });
        
    $("#agregarMateria").submit(function(){
        
        if ($('#materia').val() in materia_profesor && materia_profesor[$('#materia').val()] !== null){
            swal({
                title: 'Mensaje',
                text: 'La materia ya fue asignada, si desea cambiar al docente remueva la materia.',
                type: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
            });
        } else {
            materia_profesor[$('#materia').val()] = {
                "idProfesor":$('#docente').val(), 
                "profesor":$('#docente option:selected').text(), 
                "materia":$('#materia option:selected').text()
            };
            
            tblMaterias.row.add([
                $('#materia option:selected').text(),
                $('#docente option:selected').text(),
                '<button type="button" id="quitar" class="btn btn-danger btn-sm" title="Quitar materia">\n\
                                    <i class="glyphicon glyphicon-remove-sign"></i></button>',
                $('#materia').val()
            ]).draw(false);
            
        }
        document.getElementById("agregarMateria").reset();   
        return false;
    });
    
    $('#guardar_materias').submit(function(){
        if (tblMaterias.rows().data().length > 0){
            $.ajax({
                type: "POST",
                url: "funciones/asignaciones/asignacionControlador.php",
                data: {"opcion": "Asignar_materias", "materias": materia_profesor, "idCurso": CursoEdit},
                success: function(data){
                    swal({
                        title: 'Mensaje',
                        text: data['data']['mensaje'],
                        type: data['data']['estado'],
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                    }).then(function () {
                        toggleDisableEdit();
                        if (data['data']['estado'] === "success") {
                            $('#materias').modal('hide');
                            CursoEdit = null;
                        }
                    });
                }
            });
        } else {
            swal({
                title: 'Mensaje',
                text: 'No hay registros para guardar',
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
            });
        }
        return false;
    });
    
    function toggleDisableEdit(){
        $('#Ejornada').prop('disabled', !$('#Ejornada').prop('disabled'));
        $('#Ecurso').prop('disabled', !$('#Ecurso').prop('disabled'));
        $('#Eparalelo').prop('disabled', !$('#Eparalelo').prop('disabled'));
    }
});


function setModalEditar(index){
    var data = tblCursos.row(index).data();
    $('#jornada_edit').text(data[4]);
    $('#jornada_edit').val(data[4]);
    $('#curso_edit').text(data[1]);
    $('#curso_edit').val(data[1]);
    $('#paralelo_edit').text(data[3]);
    $('#paralelo_edit').val(data[3]);    
    
    $('#editar').modal('show');    
}

function setModalMaterias(index){
    var data = tblCursos.row(index).data();    
    $('#curso-paralelo').text(data[1]+' - '+data[3]);
    
    var parametros = {"opcion": "materiasAsignadas", "idCurso": data[8]};
    CursoEdit = data[8];
    $.ajax({
        type: "POST",
        url: "funciones/asignaciones/asignacionControlador.php",
        data: parametros,
        success: function(data){
            tblMaterias.data().clear().draw();
            materia_profesor = {};
            if (data['data'] !== null){
                for (var i = 0; i < data['data'].length; i++) {
                    tblMaterias.row.add([
                        data['data'][i]['materia'],
                        data['data'][i]['nombres'] + ' ' + data['data'][i]['apellidos'],
                        '<button type="button" id="quitar" class="btn btn-danger btn-sm" title="Quitar materia">\n\
                                        <i class="glyphicon glyphicon-remove-sign"></i></button>',
                        data['data'][i]['id']
                    ]).draw(false);
                    materia_profesor[data['data'][i]['id']] = {
                        "idProfesor": data['data'][i]['id_profesor'],
                        "profesor": data['data'][i]['nombres'] + ' ' + data['data'][i]['apellidos'],
                        "materia": data['data'][i]['materia']
                    };
                }
            }
        }
    });
    
    
    $('#materias').modal('show');    
}
