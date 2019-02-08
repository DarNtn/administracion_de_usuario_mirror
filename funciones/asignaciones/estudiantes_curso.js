var tblAlumnos;
var tblRegistrados;
var capacidad;
$(document).ready(function(){
    var columnReg = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric col-md-1'
        },
        {
            "orderable": true,
            "targets": 1,
            className: 'col-md-9 align-left'
        },{            
            "targets": 2,
            className: "col-md-1 align-center"
        },
        {
            "orderable": false,
            "targets": 3,
            "bVisible": false,
            "searchable": false            
        }];//opciones que tendran las columnas en la tabla

    var column = [{        
            "orderable": true,
            "targets": 0,        
            "searchable": true,
            className: "col-md-8 align-left"
        },{            
            "targets": 1,
            className: "col-md-1 align-center"
        },{
            "orderable": false,
            "targets": 3,
            "searchable": false,
            "bVisible": false
        }
    ];

    tblAlumnos = inicializartable('#tblAlumnos', column,0);
    tblRegistrados = inicializartable('#tblRegistrados', columnReg,1);
    
    cargarDatosCurso();
    refreshTablaAlumnos();
    refreshTablaRegistrados();        
    
    $('#btn_volver').click(function(){
        window.location = 'asignaciones.php';
    });        
    
    $('#agregarAlumnos').submit(function(){
        var alumnos=[];
        var indexes=[];
        $.each($('[name="checkAlumno"]:checked'), function(e,v){
            var data = tblRegistrados.row(v.value).data();
            alumnos.push(data[3]);
            indexes.push(v.value);
        });
        
        if (alumnos.length){
            if (alumnos.length+tblAlumnos.rows().data().length > capacidad){
                swal({
                    title: 'Capacidad del curso superada',
                    text: 'No se pudieron agregar los estudiantes seleccionados debido a que supera la capacidad del curso',
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                });
            } else {
                $.ajax({
                    data: {"opcion": "agregarAlumnos", "cursoId": getParameterByName('curso'), "alumnos": alumnos},
                    url: 'funciones/asignaciones/asignacionControlador.php',
                    type: 'POST',
                    success: function (data) {
                        if (data['data']['estado']=='success'){
                            refreshTablaAlumnos();
                            $('#estudiantes').modal('hide');
                            for (var i=0; i<indexes.length; i++){
                                tblRegistrados
                                    .row(indexes[i])
                                    .remove()
                                    .draw();
                            }
                        }
                    }
                });
            }
        } else {
            swal({
                title: 'Mensaje',
                text: 'No hay alumnos seleccionados',
                type: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
            });
        }
        return false;
    });
    
    function cargarDatosCurso(){
        $.ajax({
            data: {"opcion": "idCurso", "id": getParameterByName('curso')},
            url: 'funciones/asignaciones/asignacionControlador.php',
            type: 'POST',
            success: function (data) {
                if (data['data']){
                    $('#curso-paralelo').text(data['data'][0]['curso']+" - "+data['data'][0]['paralelo']);
                    $('#capacidad').text(data['data'][0]['capacidad']);
                    capacidad = data['data'][0]['capacidad'];
                }
            }
        });
    }
    
    function refreshTablaAlumnos(){
        tblAlumnos.clear().draw();
        $.ajax({
            data: {"opcion": "alumnosCurso", "cursoId": getParameterByName('curso')},
            url: 'funciones/asignaciones/asignacionControlador.php',
            type: 'POST',
            success: function (data) {
                if (data['data']){
                    $('#cantidad').text(data['data'].length);
                    for (var i = 0; i < data['data'].length; i++) {                                            
                        tblAlumnos.row.add([                        
                            data['data'][i]['nombres']+' '+data['data'][i]['apellidos'],
                            calcularAños(data['data'][i]['fecha_nacimiento']),
                            '<div class="row"><button id="retirar" type="button" onclick="quitarAlumno('+i+')" class="btn-line btn btn-warning btn-sm" title="Retirar alumno"><i class="glyphicon glyphicon-remove"></i></button></div>',
                            data['data'][i]['cedula']
                        ]).draw(false);
                    }
                }
            }
        });
    }
    
    function refreshTablaRegistrados(){
        tblRegistrados.clear().draw();
        $.ajax({
            data: {"opcion": "alumnosEscuela"},
            url: 'funciones/asignaciones/asignacionControlador.php',
            type: 'POST',
            success: function (data) {
                if (data['data']){
                    for (var i = 0; i < data['data'].length; i++) {                                            
                        tblRegistrados.row.add([   
                            '<input type="checkbox" name="checkAlumno" value="'+i+'">',
                            data['data'][i]['nombres']+' '+data['data'][i]['apellidos'],
                            calcularAños(data['data'][i]['fecha_nacimiento']),
                            data['data'][i]['cedula']
                        ]).draw(false);
                    }
                }
            }
        });
    }
});

function quitarAlumno(index){
    var data = tblAlumnos.row(index).data();
    swal({
        title: '¿Está seguro?',
        text: 'El alumno '+data[0]+" será removido del curso",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sí, retirar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {        
        if (result) {            
            $.ajax({
                data: {"opcion": "retirarAlumno", "alumno": data[3]},
                url: 'funciones/asignaciones/asignacionControlador.php',
                type: 'POST',
                success: function(){
                    tblAlumnos
                        .row(index)
                        .remove()
                        .draw();
                
                    $('#cantidad').text(tblAlumnos.rows().data().length);
                }
            });
        }
    });    
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}