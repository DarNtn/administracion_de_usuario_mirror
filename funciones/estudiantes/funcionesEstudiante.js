$(document).ready(function() {
    
    var parametros={ "opcion":"Lista_alumno"};
    // Elementos de tabla.
    var t = $('#example').DataTable( {
        "processing": true,
        "ajax": {
            "url": "funciones/estudiantes/estudianteControlador.php",
            "data":parametros,
            "type": "POST"
        },
        "columns": [
            {
            "defaultContent": ""
            },
            { "data": "cedula" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "sexo" },
            { "data": "direccion" },
            { "data": "curso" },
            { "data": "estado" },
            {
            "targets": -1,
            "data": null,
            "defaultContent": '<button type="button" id="modifica" class="btn btn-warning btn-xs" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>\n\
                               <button type="button" id="matri" class="btn btn-primary btn-xs" title="Matricular"><i class="glyphicon glyphicon glyphicon-floppy-open"></i></button>\n\
                               <button type="button" id="boton" class="btn btn-xs" title="Cambiar Estado Usuario"><i class="glyphicon glyphicon-off"></i></button>'
            }  
        ],
        
        "createdRow": function ( row, data, index ) {
            if ( data['estado']!=1 ) {
                $(row).addClass('danger');
            }
        },
        
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        },{
            "orderable": false,
            "targets": 9
        }],
        "order": [[ 1, 'asc' ]],

        lengthChange: true,
        dom: 'Bfrtip',
        buttons: [{extend:'excel',className: 'btn btn-success',exportOptions: {columns: "thead th:not(.noExport)"}},{extend:'pdf',className: 'btn btn-primary',exportOptions: {columns: "thead th:not(.noExport)"}},
            {
                extend: 'print',
                className: 'btn btn-warning',
                title: 'Prueba de Escuelita InnovaSystem',
                message: 'Lista de Profesores',
                exportOptions: {columns: "thead th:not(.noExport)"},
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://localhost/escuela_innova_final/img/pdf.png" style="position:absolute; left: 50%;top: 50%;transform: translate(-50%, -50%);-webkit-transform: translate(-50%, -50%);" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ],
        "language": {
            "zeroRecords": "No hay resultados - lo sentimos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": ""
        }
        
    } );
    // Elementos de tabla.

    $('#example tbody').on( 'click', '#modifica', function () {
        var data = t.row( $(this).parents('tr') ).data();
        DoPost(data['cedula']);
    } );
    
    $('#example tbody').on( 'click', '#matri', function () {
        var data = t.row( $(this).parents('tr') ).data();
        window.location.href = 'matriculacion.php?id='+data['alumno_id'];
    } );
    
    $('#example tbody').on( 'click', '#boton', function () {
        var data = t.row( $(this).parents('tr') ).data();
        var parametros={"opcion":"estadoAlumno","id":data['alumno_id'],"estado":data['estado_id']};
        $.ajax({
           type: "POST",
           url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
           data: parametros// Adjuntar los campos del formulario enviado.
         }).always(function() {
            refresh();
            });
    } );
    
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    });

    $('#col4_filter').change(function () {
        var col=4;
        filterColumn(col,$(this)[0]);
    });
    
    $('#col3_filter').change(function () {
        var col=9;
        filterColumn(col,$(this)[0]);
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            t.cell(cell).invalidate('dom');
        } );
    } ).draw();

    t.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    
    function refresh() {
        t.ajax.reload(); 
    }
    
} );

function filterGlobal () {
    $('#example').DataTable().search(
        $('#global_filter').val()
    ).draw();
}

function filterColumn (col,lugar) {
    $('#example').DataTable().column(col).search(
        $(lugar).val()
    ).draw();
}

function DoPost(dato1){
    window.location.href = 'crear_estudiante.php?id='+dato1;
}