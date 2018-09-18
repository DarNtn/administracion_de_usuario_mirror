var tblRepresentantes, tblRepresentados;
$(document).ready(function () {
    // Inicio primera tabla Representantes
    var column = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }
        , {
            "orderable": false,
            "targets": 6,
            "bVisible": false,
            "bSearchable": false
        }
    ];//opciones que tendran las columnas en la tabla
    tblRepresentantes = inicializartablesencilla('#tblRepresentantes', column, 1);

    tblRepresentantes.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblRepresentantes.on('order.dt search.dt', function () {
        tblRepresentantes.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblRepresentantes.cell(cell).invalidate('dom');
        });
    }).draw();
    //Fin primera tabla Representantes
    // Inicio segunda tabla Representados
    var column2 = [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            className: 'mdl-data-table__cell--non-numeric'
        }
//        , {
//            "orderable": false,
//            "targets": 6,
//            "bVisible": false,
//            "bSearchable": false
//        }
    ];//opciones que tendran las columnas en la tabla
    tblRepresentados = inicializartablesencilla('#tblRepresentados', column2, 1);

    tblRepresentados.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblRepresentados.on('order.dt search.dt', function () {
        tblRepresentados.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblRepresentados.cell(cell).invalidate('dom');
        });
    }).draw();
    //Fin segunda tabla Representados
    // Inicio tercera tabla Representados
    tblResulOrdenes = inicializartablesencilla('#tblResulOrdenes', column2, 1);

    tblResulOrdenes.buttons().container()
            .appendTo('#example_wrapper .col-sm-6:eq(0)');

    tblResulOrdenes.on('order.dt search.dt', function () {
        tblResulOrdenes.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            tblResulOrdenes.cell(cell).invalidate('dom');
        });
    }).draw();
    //Fin tercera tabla Representados
    $("#formBuscarRepresentantes").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        // Elementos de tabla.
        if ($('#bus').val() != '') {
            $('#representantes').modal('show');

            $.ajax({
                type: "POST",
                url: "funciones/pagos/pagoControlador.php", // El script a dónde se realizará la petición.
                data: $("#formBuscarRepresentantes").serialize(), // Adjuntar los campos del formulario enviado.
//            beforeSend: function () {
//                $('body').append("<div class='loading'></div>");
//            },
                success: function (data)
                {
//                $(".loading").remove();
//                    console.log(JSON.stringify(data));
                    tblRepresentantes.clear().draw();
                    for (var i = 0; i < data['data'].length; i++) {
                        tblRepresentantes.row.add([
                            '',
                            data['data'][i]['cedula'],
                            data['data'][i]['nombres'],
                            data['data'][i]['apellidos'],
                            data['data'][i]['direccion'],
                            data['data'][i]['telefono'],
                            data['data'][i]['representante_id']
                        ]).draw(false);
                    }
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

    $('#tblRepresentantes tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblRepresentantes.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').click(function () {
        if (tblRepresentantes.row('.selected').data() == null) {
            $('#representantes').modal('hide');
            document.getElementById("vistaRepresentante").reset();
        } else {
            $('#cedulaR').val(tblRepresentantes.row('.selected').data()[1]);
            $('#nombresR').val(tblRepresentantes.row('.selected').data()[2]);
            $('#apellidosR').val(tblRepresentantes.row('.selected').data()[3]);
            $('#direccionR').val(tblRepresentantes.row('.selected').data()[4]);
            $('#telefonoR').val(tblRepresentantes.row('.selected').data()[5]);
            $('#representantes').modal('hide');
            buscarRepresentados(tblRepresentantes.row('.selected').data()[6]);
        }

    });

    function buscarRepresentados(idRepresentado) {
        var parametros = {"opcion": "BuscarListaRepresentados", "idR": idRepresentado};

        if (idRepresentado !== '' && idRepresentado !== null) {
            $.ajax({
                type: "POST",
                url: "funciones/pagos/pagoControlador.php", // El script a dónde se realizará la petición.
                data: parametros, // Adjuntar los campos del formulario enviado.
//            beforeSend: function () {
//                $('body').append("<div class='loading'></div>");
//            },
                success: function (data)
                {
//                $(".loading").remove();
//                    console.log(JSON.stringify(data));
                    tblRepresentados.clear().draw();
                    for (var i = 0; i < data['data'].length; i++) {
                        tblRepresentados.row.add([
                            '',
                            data['data'][i]['cedula'],
                            data['data'][i]['nombres'],
                            data['data'][i]['apellidos'],
                            data['data'][i]['genero_id'],
                            data['data'][i]['direccion'],
                            '<button type="button" id="btnOrdenes" class="btn btn-warning btn-sm" title="Ordenes"><i class="glyphicon glyphicon-edit"></i></button>',
                            data['data'][i]['alumno_id']
                        ]).draw(false);
                    }
                }
            });
        }
    }

    $('#tblRepresentados tbody').on('click', '#btnOrdenes', function () {
        $('#ordenes').modal('show');
        var data = tblRepresentados.row($(this).parents('tr')).data();
        var parametros = {"opcion": "BuscarListaOrdenes", "idE": data[7]};
        $.ajax({
            type: "POST",
            url: "funciones/pagos/pagoControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
//            beforeSend: function () {
//                $('body').append("<div class='loading'></div>");
//            },
            success: function (data)
            {
//                $(".loading").remove();
//                    console.log(JSON.stringify(data));
                tblResulOrdenes.clear().draw();
                for (var i = 0; i < data['data'].length; i++) {
                    tblResulOrdenes.row.add([
                        '',
                        data['data'][i]['nombre'],
                        data['data'][i]['electivo'],
                        data['data'][i]['mes'],
                        data['data'][i]['fecha_vencimiento_pago'],
                        data['data'][i]['valor_servicio']
                    ]).draw(false);
                }
            }
        });
    });


    $('#tblResulOrdenes tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
        var valor = 0;
        var numero = tblResulOrdenes.rows('.selected').data().length;
        for (var i = 0; i < numero; i++) {
            valor = valor + Number(tblResulOrdenes.rows('.selected').data()[i][5]);
        }
        $('#valorOrdenes').html('<strong id="valorOrdenes">' + valor + '</strong>');
    });



    function eliminateDuplicates(arr) {
        var i, len = arr.length, out = [], obj = {};
        for (i = 0; i < len; i++) {
            obj[arr[i]] = 0;
        }
        for (i in obj) {
            out.push(i);
        }
        return out;
    }

    $('#valorO').click(function () {
        $(this).toggleClass('selected');
        var nOrden = tblResulOrdenes.rows('.selected').data().length;
        var arrayMes = [];
        var meses = [];
        var string = '';
        var valor = 0;
        for (var i = 0; i < nOrden; i++) {
            arrayMes.push(tblResulOrdenes.rows('.selected').data()[i][2] + ':' + tblResulOrdenes.rows('.selected').data()[i][3]);
        }
        meses = eliminateDuplicates(arrayMes);
        for (var i = 0; i < meses.length; i++) {
            var valortemp = 0;
            string = string + '<div class="col-md-6" style="box-sizing: border-box;padding: 20px 20px;border-radius: 15px;border:2px solid blueviolet;;height: 320px">\n\
            <div class="row"><div class="col-md-6"><h6><label class="label label-info">Fecha de Pago ' + meses[i] + '</label></h6>\n\
            <input style="display:none" type="text" name="mes[]"></div><div class="col-md-6">\n\
            </div></div><input class="facturaN form-control" style="display:none;" type="text" name="nfactura[]" placeholder="Numero de factura"><div class="items"><table><tr><th>Concepto de pago</th><th></th><th>Valor</th></tr>';
            for (var j = 0; j < nOrden; j++) {
                if (meses[i].split(':')[0] == tblResulOrdenes.rows('.selected').data()[j][2] && meses[i].split(':')[1] == tblResulOrdenes.rows('.selected').data()[j][3]) {
                    string = string + '<tr><td><input class="item" type="hidden" name="item[]" value="' + tblResulOrdenes.rows('.selected').data()[j][0] + '"><label>' + tblResulOrdenes.rows('.selected').data()[j][1] + '</label></td><td></td><td style="text-align: right;"><label>' + tblResulOrdenes.rows('.selected').data()[j][5] + '</label></td></tr>';
                    valor += Number(tblResulOrdenes.rows('.selected').data()[j][5]);
                    valortemp += Number(tblResulOrdenes.rows('.selected').data()[j][5]);
                }
            }
            string = string + '<tr><td><label>Total del Mes</label></td><td style="text-align: right;"><label>' + valortemp + '<label></td></tr></table></div></div>';
        }
        $('#valorFacturado').html('Valor a Pagar: <strong>' + valor + '</strong>');
        $('#facturas').html(string);
//        console.log(eliminateDuplicates(arrayMes));
        $('#ordenes').modal('hide');
    });


    $("#cFactura").on("click", function () {
        if (document.getElementById('cFactura').checked) {
            $("#facturaU").attr("style", "display:block;margin-top: 19px;");
            $(".facturaN").attr("style", "display:none");
            $(".facturaN").val(null);
        } else {
            $("#facturaU").attr("style", "display:none");
            $(".facturaN").attr("style", "display:block");
            $("#facturaU").val(null);
        }
    });

    $("#facturaU").on("change", function () {
        $(".facturaN").each(function (i, el) {
            $(el).val($("#facturaU").val());
        });
    });


    $("form#pagosF").submit(function (event) {
        event.preventDefault();//disable the default form submission
        var json = '{"metodo":"facturas","fpago":"' + $('#fpago').val() + '","parametros":[';
        $('input.facturaN').each(function (i, el) {
            if (i == 0) {
            } else {
                json += ',';
            }
            json += '{"Nfact":"' + $(el).val() + '","Concepto":[';
            $(el).next('div.items').find('input.item').each(function (i, el) {
                if (i == 0) {
                } else {
                    json += ',';
                }
                json += '{"' + i + '":"' + $(el).val() + '"}';
            });
            json += ']}';
        });
        json += ']}';
        console.log(json);

        $.ajax({
            url: 'funciones/pagos/GuardarP.php',
            data: json,
            method: 'POST', //en este caso
            contentType: 'application/json',
            success: function (data) {
                if (data['data']['estado'] == "error") {
                    swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
                } else {
                    for (var i = 0; i < data['data'].length; i++) {
                        window.open("funciones/pagos/reciboMatricula.php?alumno=" + data['data'][i], "_blank");
                    }
                }
            }
        });

        return false; // Evitar ejecutar el submit del formulario.
    });

});

