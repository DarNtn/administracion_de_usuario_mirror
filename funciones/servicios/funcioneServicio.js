var tblServicios;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        },
        {
            targets: [0],
            className: 'mdl-data-table__cell--non-numeric'
        }
        ,{
            "orderable": false,
            "targets": 4
        },
        {
            "orderable": false,
            "targets": 5
        }, 
        {
            "orderable": false,
            "targets": 6,
            "visible": false,
            "searchable": false
        }
    ];//opciones que tendran las columnas en la tabla
    tblServicios = inicializartable('#tblServicios', column,3);

    tblServicios.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblServicios.on('order.dt search.dt', function () {
        tblServicios.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblServicios.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaServicios();

    function cargarTablaServicios() {
        var parametros = {"opcion": "listaServicios"};
        $.ajax({
            data: parametros,
            url: 'funciones/servicios/servicioControlador.php',
            type: 'POST',
            success: function (data) {
                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado_id'];
                    
                    tblServicios.row.add([
                        '',
                        data['data'][i]['nombre'],
                        data['data'][i]['valor_servicio'],
                        data['data'][i]['tipo'],
                        function () {
                            if (estado === '1') {
                                return '<span class="label label-success">ACTIVO</span>';
                            } else {
                                return '<span class="label label-danger">INACTIVO</span>';
                            }
                        },
                        '<button type="button" class="modificar btn btn-warning btn-sm" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['servicio_id']
                    ]).draw(false);
                }


            }
        });
    }

    function refreshTablaServicios() {
        tblServicios.clear().draw();
        cargarTablaServicios();
    }

    $("#registarServicio").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/servicios/servicioControlador.php", // El script a dónde se realizará la petición.
            data: $("#registarServicio").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaServicios();
                swal({
                    title: 'Mensaje',
                    text: data['data']['mensaje'],
                    type: data['data']['estado'],
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                }).then(function () {
                    if (data['data']['estado'] == "success") {
                        document.getElementById("registarPeriodo").reset();
                        $('#nuevo').modal('hide');
                    }
                });
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });

    $('#tblServicios tbody').on('click', '.modificar', function () {
        var data = tblServicios.row($(this).parents('tr')).data();
        cargarDatosServicios(data[6]);
        $('#editar').modal('show');
    });
    function cargarDatosServicios(id) {
        var parametros = {"opcion": "idServicio", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/servicios/servicioControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['servicio_id']);
                $('#nombre').val(data['data'][0]['nombre']);
                $('#valor').val(data['data'][0]['valor_servicio']);
                $('#tipoI').val(data['data'][0]['tipo_servicio_id']);
                if (data['data'][0]['estado_id'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }
    
    $("#editarServicios").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/servicios/servicioControlador.php", // El script a dónde se realizará la petición.
            data: $("#editarServicios").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaServicios();
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



