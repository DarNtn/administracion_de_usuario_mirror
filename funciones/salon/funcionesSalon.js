var tblSalones;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }
        , {
            "orderable": false,
            "targets": 5
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "orderable": false,
            "targets": 7,
            "bVisible": false,
            "searchable": false
        }
    ];//opciones que tendran las columnas en la tabla

    tblSalones = inicializartable('#tblSalones', column, 0);

    tblSalones.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblSalones.on('order.dt search.dt', function () {
        tblSalones.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblSalones.cell(cell).invalidate('dom');
        });
    }).draw();

    refreshTablaSalones();

    function cargarTablaSalones() {

        var parametros = {"opcion": "listaSalones"};
        $.ajax({
            data: parametros,
            url: 'funciones/salon/salonControlador.php',
            type: 'POST',
            success: function (data) {

                for (var i = 0; i < data['data'].length; i++) {
                    var estado = data['data'][i]['estado'];
                    tblSalones.row.add([
                        '',
                        data['data'][i]['nombre'],
                        data['data'][i]['paralelo'],
                        data['data'][i]['profesor'],
                        data['data'][i]['periodo'],
                        function () {
                            if (estado === '1') {
                                return '<span class="label label-success">ACTIVO</span>';
                            } else {
                                return '<span class="label label-danger">INACTIVO</span>';
                            }
                        },
                        '<button type="button" class="modificar btn btn-warning btn-sm" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>',
                        data['data'][i]['id']
                    ]).draw(false);
                }


            }
        });
    }

    function refreshTablaSalones() {
        tblSalones.clear().draw();
        cargarTablaSalones();
    }

    $("#registarSalon").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/salon/salonControlador.php", // El script a dónde se realizará la petición.
            data: $("#registarSalon").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaSalones();
                swal({
                    title: 'Mensaje',
                    text: data['data']['mensaje'],
                    type: data['data']['estado'],
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                }).then(function () {
                    if (data['data']['estado'] == "success") {
                        document.getElementById("registarSalon").reset();
                        $('#nuevo').modal('hide');
                    }
                });
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });

    $('#tblSalones tbody').on('click', '.modificar', function () {
        var data = tblSalones.row($(this).parents('tr')).data();
        cargarDatosSalon(data[7]);
        $('#editar').modal('show');
    });
    function cargarDatosSalon(id) {
        var parametros = {"opcion": "idSalon", "id": id};
        $.ajax({
            data: parametros,
            url: 'funciones/salon/salonControlador.php',
            type: 'POST',
            success: function (data) {
                $('#id').val(data['data'][0]['salon_id']);
                $('#curso').val(data['data'][0]['curso_id']);
                $('#periodo').val(data['data'][0]['periodo_id']);
                $('#profesor').val(data['data'][0]['ids'].split(','));
                if (data['data'][0]['estado_id'] == "2") {
                    $('#estadoInactivoEd').prop("checked", true);
                } else {
                    $('#estadoActivoEd').prop("checked", true);
                }
            }
        });
    }

    $("#editarSalon .estado").on('change', function () {
        var mensaje = '', estado = '', confirm = '';
        var estadoSalon = $('#editarSalon input:radio[name=estado]:checked').val();
        var id = $('#id').val();
        if (estadoSalon === 1) {
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
            cambioEstadoSalon(id, estadoSalon);
        });
        cargarDatosSalon(id);
    });
    function cambioEstadoSalon(id, estadoSalon) {
        var parametros = {"opcion": "estadoSalon", "id": id, "estado": estadoSalon};
        $.ajax({
            type: "POST",
            url: "funciones/salon/salonControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                cargarDatosSalon(id);
                refreshTablaSalones();
            }
        });
    }

    $("#editarSalon").submit(function () {
        $.ajax({
            type: "POST",
            url: "funciones/salon/salonControlador.php", // El script a dónde se realizará la petición.
            data: $("#editarSalon").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                refreshTablaSalones();
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



