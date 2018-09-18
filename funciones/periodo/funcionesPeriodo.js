var tblPeriodos;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }
        , {
            "orderable": false,
            "targets": 7,
            "visible": false,
            "searchable": false
        }, {
            "orderable": false,
            "targets": 5
        }, {
            "orderable": false,
            "targets": 6
        }
    ];//opciones que tendran las columnas en la tabla
    tblPeriodos = inicializartable('#tblPeriodos', column,0);

    tblPeriodos.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblPeriodos.on('order.dt search.dt', function () {
        tblPeriodos.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblPeriodos.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaPeriodos();

    function cargarTablaPeriodos() {
        var parametros = {"opcion": "listaPeriodos"};
        $.ajax({
            data: parametros,
            url: 'funciones/periodo/periodoControlador.php',
            type: 'POST',
            success: function (data) {
                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado_id'];
                    
                    tblPeriodos.row.add([
                        '',
                        data['data'][i]['anio_inicio'],
                        data['data'][i]['anio_fin'],
                        data['data'][i]['fecha_inicio_periodo'],
                        data['data'][i]['fecha_fin_periodo'],
                        function () {
                            if (estado === '1') {
                                return '<span class="label label-success">ACTIVO</span>';
                            } else {
                                return '<span class="label label-danger">INACTIVO</span>';
                            }
                        },
                        '<button type="button" class="modificar btn btn-warning btn-sm" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['periodo_id']
                    ]).draw(false);
                }


            }
        });
    }

    function refreshTablaPeriodos() {
        tblPeriodos.clear().draw();
        cargarTablaPeriodos();
    }

    $("#registarPeriodo").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/periodo/periodoControlador.php", // El script a dónde se realizará la petición.
            data: $("#registarPeriodo").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaPeriodos();
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

    $('#tblPeriodos tbody').on('click', '.modificar', function () {
        var data = tblPeriodos.row($(this).parents('tr')).data();
        cargarDatosPeriodo(data[7]);
        $('#editar').modal('show');
    });
    function cargarDatosPeriodo(id) {
        var parametros = {"opcion": "idPeriodo", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/periodo/periodoControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['periodo_id']);
                $('#anio_inicio').val(data['data'][0]['anio_inicio']);
                $('#anio_fin').val(data['data'][0]['anio_fin']);
                $('#fecha_inicio').val(data['data'][0]['fecha_inicio_periodo']);
                $('#fecha_fin').val(data['data'][0]['fecha_fin_periodo']);

                if (data['data'][0]['estado_id'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }
    
    $("#editarPeriodo .estado").on('change', function () {
        var mensaje = '', estado = '', confirm = '';
        var estadoPeriodo = $('#editarPeriodo input:radio[name=estado]:checked').val();
        var id = $('#id').val();
        if (estadoPeriodo === 1) {
            mensaje = 'Se activara el periodo';
            estado = 'warning';
            confirm = 'Si activar';
        } else {
            mensaje = 'Está seguro de poner el estado en Inactivo, se inactivará también cursos';
            estado = 'info';
            confirm = 'Si, estoy seguro!';
        }
        swal({
            title: 'Mensaje',
            text: mensaje,
            type: estado,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirm,
            cancelButtonText: 'No, cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {
            swal(
                    'Mensaje',
                    'Cambio estado realizado',
                    'success'
                    );
            cambioEstadoPeriodo(id, estadoPeriodo);
        });
        cargarDatosPeriodo(id);
    });
    function cambioEstadoPeriodo(id, estadoPeriodo) {
        var parametros = {"opcion": "estadoPeriodo", "id": id, "estado": estadoPeriodo};
        $.ajax({
            type: "POST",
            url: "funciones/periodo/periodoControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                cargarDatosPeriodo(id);
                refreshTablaPeriodos();
            }
        });
    };
    
    $("#editarPeriodo").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/periodo/periodoControlador.php", // El script a dónde se realizará la petición.
            data: $("#editarPeriodo").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaPeriodos();
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



