var tblUsuarios;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        },
        {
            targets: [0],
            className: 'mdl-data-table__cell--non-numeric'
        }, {
            "orderable": false,
            "targets": 8,
            "visible": false,
            "searchable": false
        },{
            "orderable": false,
            "targets": 6
        },{
            "orderable": false,
            "targets": 7
        }];//opciones que tendran las columnas en la tabla

    tblUsuarios = inicializartable('#tblUsuarios', column,0);

    tblUsuarios.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblUsuarios.on('order.dt search.dt', function () {
        tblUsuarios.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblUsuarios.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaUsuarios();

    function cargarTablaUsuarios() {
        var parametros = {"opcion": "listaUsuarios"};
        $.ajax({
            data: parametros,
            url: 'funciones/usuario/usuarioControlador.php',
            type: 'POST',
            success: function (data) {
                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado'];
                    tblUsuarios.row.add([
                        '',
                        data['data'][i]['cedula'],
                        data['data'][i]['nombre'],
                        data['data'][i]['usuario'],
                        data['data'][i]['clave'],
                        data['data'][i]['tipo'],
                        function () {
                            if (estado === '1') {
                                return '<span class="label label-success">ACTIVO</span>';
                            } else {
                                return '<span class="label label-danger">INACTIVO</span>';
                            }
                        },
                        '<button type="button" class="modificar btn btn-warning btn-sm" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['usuario_id']
                    ]).draw(false);
                }


            }
        });
    }

    function refreshTablaUsuarios() {
        tblUsuarios.clear().draw();
        cargarTablaUsuarios();
    }

    $("#registarUsuario").submit(function () {
        if (validarCedula($("#ced").val())) {
            if (validar_clave($("#clave").val(), $("#re-clave").val())) {
                $.ajax({
                    type: "POST",
                    url: "funciones/usuario/usuarioControlador.php", // El script a dónde se realizará la petición.
                    data: $("#registarUsuario").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function (data)
                    {
                        refreshTablaUsuarios();
                        swal({
                            title: 'Mensaje',
                            text: data['data']['mensaje'],
                            type: data['data']['estado'],
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Cerrar'
                        }).then(function () {
                            if (data['data']['estado'] == "success") {
                                document.getElementById("registarUsuario").reset();
                                $('#nuevo').modal('hide');
                            }
                        });
                    }
                });
            }
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

    $('#tblUsuarios tbody').on('click', '.modificar', function () {
        var data = tblUsuarios.row($(this).parents('tr')).data();
        cargarDatosUsuario(data[8]);
        $('#editar').modal('show');
    });
    function cargarDatosUsuario(id) {
        var parametros = {"opcion": "idUsuario", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/usuario/usuarioControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['usuario_id']);
                $('#cedula').val(data['data'][0]['cedula']);
                $('#nombre').val(data['data'][0]['nombre']);
                $('#email').val(data['data'][0]['usuario']);
                $('#claveEd').val(data['data'][0]['clave']);
                $('#re-claveEd').val(data['data'][0]['clave']);

                $('#tipo').val(data['data'][0]['tipo']);
                if (data['data'][0]['estado'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }

    $("#editarUsuario").submit(function () {
        if (validarCedula($("#cedula").val())) {
            if (validar_clave($("#claveEd").val(), $("#re-claveEd").val())) {
                $.ajax({
                    type: "POST",
                    url: "funciones/usuario/usuarioControlador.php", // El script a dónde se realizará la petición.
                    data: $("#editarUsuario").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function (data)
                    {
                        refreshTablaUsuarios();
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
            }
        }
        return false; // Evitar ejecutar el submit del formulario.
    });
});



