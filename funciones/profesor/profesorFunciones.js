$(document).ready(function () {
    
    mostrarProfesores();
    registrarProfesor();
    modificarProfesor();
    mostrarFotografia();
    
});

function mostrarProfesores(){

    var parametros={ "opcion":"obtenerListaProfesores"};
    
    var tabla = $('#example').DataTable( {
        "processing": true,
        "ajax": {
            "url": "funciones/profesor/profesorControlador.php",
            "data":parametros,
            "type": "GET"
        },
        "columns": [
            {
            "defaultContent": ""
            },
            { "data": "cedula" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "usuario" },
            { "data": "correo" },
            { "data": "estado" },
            {
            "targets": -1,
            "data": null,
            "defaultContent": '<button type="button" id="editarBtn" class="btn btn-warning btn-xs" title="Modificar"><i class="glyphicon glyphicon-edit"></i></button>\n\
                               <button type="button" id="deshabilitarBtn" class="btn btn-xs" title="Cambiar Estado Usuario"><i class="glyphicon glyphicon-off"></i></button>'
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
        buttons: [
            {   extend:'excel',
                className: 'btn btn-success',
                exportOptions: 
                    {columns: "thead th:not(.noExport)"}},
                    {extend:'pdf',className: 'btn btn-primary',
                        exportOptions: {columns: "thead th:not(.noExport)"}
                    },
            {
                extend: 'print',
                className: 'btn btn-warning',
                title: 'Prueba de Escuelita InnovaSystem',
                message: 'Lista de Profesores',
                exportOptions: 
                        {columns: "thead th:not(.noExport)"},
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
    
    // Enumerar registros
    tabla.on( 'order.dt search.dt', function () {
        tabla.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    
    clickEditarProfesor(tabla);
    clickDeshabilitarProfesor(tabla);
    
}

function registrarProfesor(){
    
    $("form#formulario").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        
        // Obtener los datos del formulario
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "funciones/profesor/profesorControlador.php",
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
    
}

function clickEditarProfesor(tabla){
    
    $('#example tbody').on('click', '#editarBtn', function () {
        var data = tabla.row( $(this).parents('tr') ).data();
        window.location.href = 'profesor_crear.php?id=' + data['cedula'];
    } );
    
}

function clickDeshabilitarProfesor(tabla){

    $('#example tbody').on('click', '#deshabilitarBtn', function () {
        var data = tabla.row( $(this).parents('tr') ).data();
//        var parametros={"opcion":"estadoAlumno","id":data['alumno_id'],"estado":data['estado_id']};
//        $.ajax({
//           type: "POST",
//           url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
//           data: parametros// Adjuntar los campos del formulario enviado.
//         }).always(function() {
//            refresh();
//            });
        console.log("asafasffsaafaffs");
    });
    
}

function modificarProfesor(){
    
    var opcion = $('#opcion').val();
    
    // Se obtiene la cédula del profesor
    var cedula = $('#id').val();
    
    if(opcion === "editarProfesor"){
        
        var parametros = {"cedula": cedula, "opcion": "obtenerProfesorPorCedula"};
        
        $.ajax({
            type: "GET",
            url: "funciones/profesor/profesorControlador.php", 
            data: parametros, 
            success: function (data){
                
                // Llenar formulario para editar profesor
                $("#cedula").val(data['data'][0]['cedula']);
                $("#nombres").val(data['data'][0]['nombres']);
                $("#apellidos").val(data['data'][0]['apellidos']);
                $("#estadoCivil").val(data['data'][0]['estado_civil_id']);
                $("#fechaNacimiento").val(data['data'][0]['fechaNac']);
                $("#correo").val(data['data'][0]['mail']);
                $("#anosExperiencia").val(data['data'][0]['aniosExperiencia']);
                $("#fechaInicioLaboral").val(data['data'][0]['fechaLaboral']);
                $("#nCargas").val(data['data'][0]['cargas']);
                $("#direccion").val(data['data'][0]['direccion']);
                $("#telefono").val(data['data'][0]['telefono']);
                $("#especialidad").val(data['data'][0]['especialidad_id']);
                $("#genero").val(data['data'][0]['genero_id']);
                $("#usuario").val(data['data'][0]['usuario']);
                $("#password").val(data['data'][0]['clave']);
                calcularEdad(data['data'][0]['fechaNac'], '#edad');

            }
        });
    }
    
}

function mostrarFotografia(){
    
    $('#inputFotografia').on("input", function() {
        var reader = new FileReader();
        reader.readAsDataURL(event.srcElement.files[0]);
        reader.onload = function () {
            var fileContent = reader.result;
            document.getElementById("imgFotografia").src=fileContent;
        }
    });
    
}