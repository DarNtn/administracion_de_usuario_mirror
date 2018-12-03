$(document).ready(function () {
    
    cargarTabla($('example'));
    
    $("form#formulario").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        
        // Obtener los datos del formulario
        var formData = new FormData($(this)[0]);

        // Enviar formulario
        var formData = new FormData($(this)[0]);          
        $.ajax({
            type: "POST",
            url: "funciones/profesor/profesorController.php",
            data: formData, 
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success: function (data){
                swal({
                    title: 'Mensaje',
                    text: data['data']['mensaje'],
                    type: data['data']['estado'],
                    confirmButtonText: "OK"
                }).then( result => {
                    if (data['data']['estado'] === "success"){
                        window.location.href = 'profesor_crear.php';
                    }                        
                });                    
            }
        });
        
    });
});

function cargarTabla(tabla){

    var parametros={ "opcion":"Lista_alumno"};
    var tabla = $('#example').DataTable( {
        "processing": true,
        "ajax": {
            "url": "funciones/estudiantes/estudianteControlador.php",
            "data":parametros,
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "cedula" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "usuario" },
            { "data": "correo" },
            { "data": "estado" },
            { "targets": -1,
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
            "targets": 7
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
        
    });
    
}
