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
                        '<div class="row"><button type="button" class="btn-line modificar btn btn-warning btn-sm" title="Administrar materias"><i class="glyphicon glyphicon-folder-open"></i></button>\n\
                        <button type="button" class="btn-line btn btn-warning btn-sm" title="Administrar estudiantes"><i class="glyphicon glyphicon-user"></i></button>\n\
                        <button type="button" class="btn-line btn btn-warning btn-sm" title="Editar asignación"><i class="glyphicon glyphicon-edit"></i></button></div>',                        
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

    $('#tblCursos tbody').on('click', '.modificar', function () {
        var data = tblCursos.row($(this).parents('tr')).data();
        cargarDatosCurso(data[9]);
        $('#editar').modal('show');
    });
    function cargarDatosCurso(id) {
        var parametros = {"opcion": "idCurso", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/curso/cursoControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['id']);
                $('#nombre').val(data['data'][0]['salon']);
                $('#nivel').val(data['data'][0]['nivelI']);
                $('#jornada').val(data['data'][0]['horario']);
                $('#paralelo').val(data['data'][0]['para']);
                $('#cantidad').val(data['data'][0]['numero']);

                if (data['data'][0]['estado'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }

    $("#editarCurso").submit(function () {
                $.ajax({
                    type: "POST",
                    url: "funciones/curso/cursoControlador.php", // El script a dónde se realizará la petición.
                    data: $("#editarCurso").serialize(), // Adjuntar los campos del formulario enviado.
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
                                $('#editar').modal('hide');
                            }
                        });
                    }
                });
        return false; // Evitar ejecutar el submit del formulario.
    });
});



