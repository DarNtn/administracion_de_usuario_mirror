var tblPersol;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }, {
            "orderable": false,
            "targets": 1
        }, {
            "orderable": false,
            "targets": 2
        }, {
            "orderable": false,
            "targets": 3
        }, {
            "orderable": false,
            "targets": 4
        }, {
            "orderable": false,
            "targets": 5
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "orderable": false,
            "targets": 7
        }, {
            "orderable": false,
            "targets": 8,
            "visible": false
        }, {
            "orderable": false,
            "targets": 9,
            "visible": false,
            "searchable": false
        }
    ];//opciones que tendran las columnas en la tabla
    var grupoDataTable = [8, 10];
    tblPersol = inicializartable('#tblPersol', column, 8, grupoDataTable);

    tblPersol.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblPersol.on('order.dt search.dt', function () {
        tblPersol.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblPersol.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaPersonal();

    function cargarTablaPersonal() {
        var parametros = {"opcion": "listaPersonal"};
        $.ajax({
            data: parametros,
            url: 'funciones/personal/personalControlador.php',
            type: 'POST',
            success: function (data) {
                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado'];
                    tblPersol.row.add([
                        '',
                        data['data'][i]['identificacion'],
                        data['data'][i]['nombre'] + ' ' + data['data'][i]['apellido'],
                        data['data'][i]['ocupacion'],
                        data['data'][i]['email'],
                        data['data'][i]['tel'],
                        function () {
                            if (estado === '1') {
                                return '<span class="label label-success">ACTIVO</span>';
                            } else {
                                return '<span class="label label-danger">INACTIVO</span>';
                            }
                        },
                        '<button type="button" class="modificar btn btn-warning btn-sm" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['categoria'],
                        data['data'][i]['id']
                    ]).draw(false);
                }


            }
        });
    }

    function refreshTablaPersonal() {
        tblPersol.clear().draw();
        cargarTablaPersonal();
    }

    $('#categoria').on('change', function () {
        especialidades('#categoria', '#especialidad');
    });
    $('#categoriaM').on('change', function () {
        especialidades('#categoriaM', '#especialidadM');
    });
    function especialidades(idBusqueda, idRespuesta, check) {
        var parametros = {"opcion": "comboCategoria", "id": $(idBusqueda).val()};
        $.ajax({
            type: "POST",
            url: "funciones/personal/personalControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                var opciones = '';
                for (var i = 0; i < data['data'].length; i++) {
                    if (data['data'][i]['id']===check){
                        opciones = opciones + '<option value="' + data['data'][i]['id'] + '" selected>' + data['data'][i]['nombre'] + '</opcion>';
                    }else{
                        opciones = opciones + '<option value="' + data['data'][i]['id'] + '">' + data['data'][i]['nombre'] + '</opcion>';
                    }
                }
                $(idRespuesta).html(opciones);
            }
        });
    }
    especialidades('#categoria', '#especialidad');

    $("#registarPersonal").submit(function () {
        var formData = new FormData($(this)[0]);
        if (validarCedula($("#ced").val())) {
            $.ajax({
                type: "POST",
                url: "funciones/personal/personalControlador.php", // El script a dónde se realizará la petición.
                data: formData, // Adjuntar los campos del formulario enviado.
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: function (data)
                {
                    refreshTablaPersonal();
                    swal({
                        title: 'Mensaje',
                        text: data['data']['mensaje'],
                        type: data['data']['estado'],
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                    }).then(function () {
                        if (data['data']['estado'] == "success") {
//                            document.getElementById("registarPersonal").reset();
//                            $('#nuevo').modal('hide');
                        }
                    });
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

    $('#tblPersol tbody').on('click', '.modificar', function () {
        var data = tblPersol.row($(this).parents('tr')).data();
        cargarDatosUsuario(data[9]);
        $('#editar').modal('show');
    });
    function cargarDatosUsuario(id) {
        var parametros = {"opcion": "idPersonal", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/personal/personalControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['id']);
                $('#nombres').val(data['data'][0]['nombre']);
                $('#apellidos').val(data['data'][0]['apellido']);
                $('#cedula').val(data['data'][0]['identificacion']);
                $('#telefono').val(data['data'][0]['tel']);
                $('#mail').val(data['data'][0]['email']);
                $('#tipoC').val(data['data'][0]['estado_civil_id']);
                $('#fechaNacEd').val(data['data'][0]['fechaNac']);
                $('#fechaLab').val(data['data'][0]['fechaLaboral']);
                $('#direccion').val(data['data'][0]['direccion']);
                $('#categoriaM').val(data['data'][0]['categoria_id']);
                calcularEdad(data['data'][0]['fechaNac'], '#edadEd');
                especialidades('#categoriaM', '#especialidadM',data['data'][0]['ocupacion_id']);
                $('#aniosE').val(data['data'][0]['aniosExperiencia']);
                $('#cargas').val(data['data'][0]['cargas']);
                $('#archivo').val(data['data'][0]['curriculum_direccion']);
                if (data['data'][0]['sexo'] == "2") {
                    $('#generoFemaleEd').prop("checked", true);
                } else {
                    $('#generoMaleEd').prop("checked", true);
                }
                if (data['data'][0]['estado'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }

    $("#editarPersonal").submit(function () {
        var formData = new FormData($(this)[0]);
        if (validarCedula($("#cedula").val())) {
            $.ajax({
                type: "POST",
                url: "funciones/personal/personalControlador.php", // El script a dónde se realizará la petición.
                data: formData, // Adjuntar los campos del formulario enviado.
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: function (data)
                {
                    refreshTablaPersonal();
                    swal({
                        title: 'Mensaje',
                        text: data['data']['mensaje'],
                        type: data['data']['estado'],
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                    }).then(function () {
                        if (data['data']['estado'] == "success" || data['data']['estado'] == "info") {
                            $('#editar').modal('hide');
                        }
                    });
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });
});



