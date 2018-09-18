function inicializartable(tabla,column,ordenColumn,grupo,pieTotal){
return $(tabla).DataTable({
            columnDefs: column,
            "drawCallback": function (settings) {
                if(grupo!=null){
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(grupo[0], {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                    '<tr style="height:30px !important;"><td colspan="'+grupo[1]+'" style="text-align: left;height:30px !important;padding: 6px 9px !important;background-color: #50BFE6 !important;color: white;">' + group + '</td></tr>'
                                    );
                            last = group;
                        }
                        
                    });}
                },
                "footerCallback": function (row, data, start, end, display) {
                    if(pieTotal!=null){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };
                // Total over all pages
                total = api
                        .column(pieTotal)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                // Update footer
                $(api.column(pieTotal).footer()).html('Total de todas las pensiones vencidas ( $' + total + ' )');}
            },
            "order": [[ordenColumn, 'asc']],
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {columns: "thead th:not(.noExport)"}},
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa  fa-file-pdf-o"></i>',
                    exportOptions: {columns: "thead th:not(.noExport)"}},
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i>',
//                    title: '<h4>Nombre de Institución</h4>',
//                    message: '<h5>Reporte de pagina</h5>',
                    exportOptions: {columns: "thead th:not(.noExport)"},
                    footer: true,
                    customize: function (win) {
                        $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                        '<img src="http://localhost/Jardin/assets/img/pdf.png" style="position:absolute; left: 50%;top: 50%;transform: translate(-50%, -50%);-webkit-transform: translate(-50%, -50%);" />'
                                        );

                        $(win.document.body).find('table')
//                                .addClass('')
                                .css('width', '100%');
                        var footer = $('#footer');
                        if (footer.length > 0) {
                            var exportFooter = $(win.document.body).find('tfoot');
                            exportFooter.after(footer.clone());
                            exportFooter.remove();
                        }
                    }
                }
//                ,
//                {
//                    extend: 'colvis',
//                    className: 'btn btn-default',
//                    text: '<i class="fa fa-columns"></i> <i class="fa fa-plus"></i>',
//                    columns: ':visible :not(:last-child)'
//                }
            ]
        });

}



function inicializartablesencilla(tabla,column,ordenColumn){
return $(tabla).DataTable({
            columnDefs: column,
            "order": [[ordenColumn, 'asc']],
            lengthChange: false,
            bFilter:false
        });

}