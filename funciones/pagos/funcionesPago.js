var tblPagosVencidos;
$(document).ready(function () {
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }
        , {
            "orderable": false,
            "targets": 8,
            "bVisible": false,
            "bSearchable": true
        }, {
            "orderable": false,
            "targets": 9,
            "bVisible": false,
            "bSearchable": true
        }, {
            "orderable": false,
            "targets": 10,
            "bVisible": false,
            "bSearchable": true
        }
    ];//opciones que tendran las columnas en la tabla
    tblPagosVencidos = inicializartable('#tblPagosVencidos', column, 5, null, 6);

    tblPagosVencidos.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblPagosVencidos.on('order.dt search.dt', function () {
        tblPagosVencidos.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblPagosVencidos.cell(cell).invalidate('dom');
        });
    }).draw();

    $("#formBusqueda").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "funciones/pagos/pagoControlador.php", // El script a dónde se realizará la petición.
            data: $("#formBusqueda").serialize(), // Adjuntar los campos del formulario enviado.
//            beforeSend: function () {
//                $('body').append("<div class='loading'></div>");
//            },
            success: function (data)
            {
//                $(".loading").remove();
//                    console.log(JSON.stringify(data));
                tblPagosVencidos.clear().draw();
                for (var i = 0; i < data['data'].length; i++) {
                    tblPagosVencidos.row.add([
                        '',
                        data['data'][i]['nombres'],
                        data['data'][i]['nombre'],
                        data['data'][i]['electivo'],
                        data['data'][i]['mes'],
                        data['data'][i]['fecha_vencimiento_pago'],
                        '$' + data['data'][i]['valor_servicio'],
                        data['data'][i]['nombreR'],
                        data['data'][i]['representante_id'],
                        data['data'][i]['alumno_id'],
                        data['data'][i]['email']
                    ]).draw(false);
                }
            }
        });
        return false; // Evitar ejecutar el submit del formulario.
    });

});




