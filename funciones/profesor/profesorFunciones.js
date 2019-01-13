$(document).ready(function () {

    var tabla = mostrarProfesores();
    registrarProfesor();
    modificarProfesor();
    mostrarFotografia();
    deshabilitarProfesor(tabla)
    
});

function mostrarProfesores(){

    var parametros={ "opcion":"obtenerListaProfesores"};
    
    var tabla = $('#example').DataTable( {
        "processing": true,
        "ajax": {
            "url": "funciones/profesor/profesorControlador.php",
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
    
    return tabla;
}

function registrarProfesor(){
    
    $("form#formulario").submit(function (event) {

        event.preventDefault();

        // Registrar numeros telefonicos
        // registrarTelefonos();
        
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

function registrarTelefonos(){
    
    var contenedorTelefonos = $(".telefono");
    var nTelefonos = contenedorTelefonos.length;
    var telefonos = []
    
    for(var i=0; i<nTelefonos; i++){
        telefonos.push(contenedorTelefonos[i].value)
    }
    
    var parametros = {"cedula": "1301234488", "opcion": "ingresarTelefonos"};
    console.log(telefonos);
    
    $.ajax({
        type: "POST",
        url: "funciones/profesor/profesorControlador.php",
        data: parametros, 
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
    
}

function clickEditarProfesor(tabla){
    
    $('#example tbody').on('click', '#editarBtn', function () {
        var data = tabla.row( $(this).parents('tr') ).data();
        window.location.href = 'profesor_crear.php?id=' + data['cedula'];
    } );
    
}

function modificarProfesor(){
    
    var opcion = $('#opcion').val();
    
    // Se obtiene la cédula del profesor
    var cedula = $('#id').val();
    
    if(opcion === "editarProfesor"){
        
        var parametros = {"cedula": cedula, "opcion": "obtenerProfesorPorCedula"};
        
        $.ajax({
            type: "POST",
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

function añadirTextFieldTelefono(){

    var div = document.createElement("div");
    div.classList.add('col-lg-3');
    div.setAttribute("style", "margin-top: 15px");
    
    var div2 = document.createElement("div");
    div2.classList.add('input-group');

    var span = document.createElement("span");
    span.classList.add('input-group-addon');
    
    var i = document.createElement("i");
    i.classList.add('fa');
    i.classList.add('fa-mobile');
    i.classList.add('fa-fw');
    
    var input = document.createElement("input");
    input.classList.add('form-control');
    input.classList.add('telefono');
    input.setAttribute("type", "text");
    input.setAttribute("id", "telefono");
    input.setAttribute("name", "telefono");
    input.setAttribute("placeholder", "telefono");

    span.appendChild(i);
    div2.appendChild(span);
    div2.appendChild(input);
    div.appendChild(div2);

    var contenedor = document.getElementById('contenedorTelefonos');
    contenedor.appendChild(div);        
    
}

function deshabilitarProfesor(tabla){
    
    $('#example tbody').on( 'click', '#deshabilitarBtn', function () {
        var data = tabla.row( $(this).parents('tr') ).data();
        var parametros={ "opcion":"deshabilitarProfesor", "cedula":data['cedula'], "estado":data['estado'] };
        $.ajax({
           type: "POST",
           url: "funciones/profesor/profesorControlador.php",
           data: parametros
        }).always(function() {
            window.location.href = 'profesor.php';
        });
    });
    
}