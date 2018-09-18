$(document).ready(function () {

    var id = $("#idAlumno").val();
    if (id != null) {
        datosAlumno(id);
    }
    function datosAlumno(id) {

        var parametros = {"id": id, "opcion": "buscarAlumno"};
        $.ajax({
            type: "POST",
            url: "funciones/matriculacion/matriculacionControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                console.log(JSON.stringify(data));
                $("#id").val(data['data'][0]['alumno_id']);
                $("#ced").val(data['data'][0]['cedula']);
                $("#nombres").val(data['data'][0]['nombres']);
                $("#apellidos").val(data['data'][0]['apellidos']);
                $("#tipoI").val(data['data'][0]['instituciones_id']);
            }
        });

    }




    var parametros = {"opcion": "Representantes_Alumnos", "id": id};
    var t = $('#example').DataTable({
        "processing": true,
        "ajax": {
            "url": "funciones/matriculacion/matriculacionControlador.php",
            "data": parametros,
            "type": "POST"
        },
        "columns": [
            {
                "defaultContent": ""
            },
            {"data": "cedula"},
            {"data": "nombres"},
            {"data": "apellidos"},
            {"data": "alumno_id"},
            {"data": "direccion"},
            {"data": "telefono"},
            {"data": function (data, type, dataToSet) {
                    if (data['principal'] == 1) {
                        return 'Principal';
                    } else {
                        return 'Secundario';
                    }
                }
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": '<button type="button" id="boton" class="btn btn-sm" title="Cambiar Estado Usuario"><i class="glyphicon glyphicon-off"></i></button>'
            }

        ],

        "createdRow": function (row, data, index) {
            if (data['principal'] != 1) {
                $(row).addClass('danger');
            }
        },

        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 8
            }],
        "order": [[1, 'asc']],

        lengthChange: false,
        dom: 'Bfrtip',
        "language": {
            "zeroRecords": "No hay resultados - lo sentimos",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": ""
        }

    });
    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            t.cell(cell).invalidate('dom');
        });
    }).draw();

    $('#example tbody').on('click', '#boton', function () {
        var data = t.row($(this).parents('tr')).data();
        var parametros = {"opcion": "cambiarPrincipal", "id": data['alumno_id'], "idR": data['representante_id']};
        $.ajax({
            type: "POST",
            url: "funciones/matriculacion/matriculacionControlador.php", // El script a dónde se realizará la petición.
            data: parametros// Adjuntar los campos del formulario enviado.
        }).always(function () {
            refresh();
        });
    });

    function refresh() {
        t.ajax.reload();
    }
    $("form#formulario").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "funciones/matriculacion/matriculacionControlador.php", // El script a dónde se realizará la petición.
            data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                console.log(JSON.stringify(data));
                swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
            }
        });
    });
});
