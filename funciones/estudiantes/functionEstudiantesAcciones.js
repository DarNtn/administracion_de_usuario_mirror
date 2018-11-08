var t;

$(document).ready(function () {

    var counter = 1;
    var id = getParameterByName('id');
    var documentosABorrar = [];
    
    var opcion = document.getElementsByName('opcion')[0].value;
    if(opcion === 'Modificar_estudiante2'){
        // Cargar documentos
        var parametros={ "opcion": "cargarDocumentos", "id": id};
        $.ajax({
            type: "POST",
            url: "funciones/estudiantes/estudianteControlador.php",
            data: parametros,
            success: function (data){
                for (var i = 0; i < data['data'].length; i++) {
                    crearLabelDocumentoCargado(data['data'][i].nombre, data['data'][i].link)
                }
            }
        });
    }

    t = $('#example').DataTable({
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 9
            }],
        "order": [[0, 'asc']],
        lengthChange: false,
        "language": {
            "zeroRecords": "No hay resultados - lo sentimos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": ""
        }
    });

    $('#example tbody').on('click', '#delete', function () {
        $('.autorizado'+$(this).parents('tr').children()[0].innerHTML).remove();
        t
                .row($(this).parents('tr'))
                .remove()
                .draw();
    });

    $('#inputFotografia').on("input", function() {
        var reader = new FileReader();
        reader.readAsDataURL(event.srcElement.files[0]);
        reader.onload = function () {
          var fileContent = reader.result;
              console.log(fileContent);
              document.getElementById("imgFotografia").src=fileContent;
        }
    });
    
    $(document).on("input", "#selectorDocumentos #inputDocumento", function() {
        
        var nombreDocumento = this.getAttribute('name');
        var numeroDocumento = parseInt(nombreDocumento.split("-")[1], 10);
        var nombreNuevo = "documento-" + (numeroDocumento + 1);

        // Se elimina el input actual
        this.setAttribute("style", "display: none;");
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            // El elemento seleccionado se añade a la lista de documentos
            crearLabelDocumentoCargado(fileName, "sin direccion");
        });
        
        // Se crea y se muestra un input nuevo
        var input = document.createElement("input");
        input.setAttribute("type", "file");
        input.classList.add('form-control-file');
        input.setAttribute("id", "inputDocumento");
        input.setAttribute("name", nombreNuevo);
        
        var selectorDocumentos = document.getElementById('selectorDocumentos');
        selectorDocumentos.appendChild(input);

    });

    $('#contenedorDocumentos').on("click", "#eliminarDocumento", function() {
        // Si el elemento no posee direccion, es porque no está guardado en la base de datos
        name = $(this).parent().attr("name");
        
        if(name !== 'sin direccion'){
            borrarDocumento(name);
        }
        
        $(this).parent().remove();
        
    });

    //$("form#formularioRepresentante").submit(function (event) {}
    $("#añadirR").click(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($("form#formularioRepresentante")[0]);

        if (validarCedula($("#cedulaR").val())) {
            if (counter <= 1 || validarExistente($("#cedulaR").val(), $('input:radio[name=funcion]:checked').val())){
                $.ajax({                
                    type: "POST",
                    url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
                    data: formData, // Adjuntar los campos del formulario enviado.
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    success: function (data)
                    {
                        if (data['data']['estado'] == "success") {
                            t.row.add([
                                counter,
                                $('#cedulaR').val(),
                                $('#nombresR').val(),
                                $('#apellidosR').val(),
                                $('#tipoC option:selected').text(),
                                $('#parentesco option:selected').text(),
                                $('#direccionR').val(),
                                $('#telefono').val(),
                                $('#mail').val(),
                                $('input:radio[name=funcion]:checked').val(),
                                '<button type="button" id="delete" class="btn btn-danger btn-sm" title="Eliminar">\n\
                                    <i class="glyphicon glyphicon-remove-sign"></i></button>'
                            ]).draw(false);
                            $("#formulario").append('<input type="hidden" name="dato[]" value="' + $('#cedulaR').val()+ '">');
                            $("#formulario").append('<input type="hidden" name="parentesco[]" value="' + $('#parentesco').val() + '">');
                            $("#formulario").append('<input type="hidden" name="funcion[]" value="' + $('input:radio[name=funcion]:checked').val() + '">');
                            counter++;
                            document.getElementById("formularioRepresentante").reset();
                                                 
                            swal('Mensaje', "Registro existoso", "success");
                        } else {
                            swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
                        }
                    }
                });
            } else{
                swal('Mensaje', $('#nombresR').val()+ " " +$('#apellidosR').val()+ " ya consta en el registro con la función de "+$('input:radio[name=funcion]:checked').val(), 'warning');
            }
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

    $("form#formulario").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        
        // Borrar documentos eliminados
        var parametros={ "opcion": "eliminarDocumentos", "documentos": documentosABorrar};
        $.ajax({
            type: "POST",
            url: "funciones/estudiantes/estudianteControlador.php",
            data: parametros,
            success: function (data){
                console.log("Documentos eliminados correctamente")
            }
        });
        
        // Enviar formulario
        var formData = new FormData($(this)[0]);          
        if (validarCedula($("#ced").val())) {
            $.ajax({
                type: "POST",
                url: "funciones/estudiantes/estudianteControlador.php",
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
                        if (data['data']['estado']=="success"){
                            window.location.reload();
                        }                        
                    })                    
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

    function borrarDocumento(nombre){
        documentosABorrar.push(nombre);
        console.log(documentosABorrar);
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    
    if (id != null) {
        datosAlumno(id);
    }

    function datosAlumno(id) {
        var parametros = {"id": id,
            "opcion": "buscarAlumno"};
        buscarRepresentantes(id);
        $.ajax({
            type: "POST",
            url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data){
                $("#ced").val(data['data'][0]['cedula']);
                $("#nombres").val(data['data'][0]['nombres']);
                $("#apellidos").val(data['data'][0]['apellidos']);
                $("#fechaNac").val(data['data'][0]['fecha_nacimiento']);
                $("#direccion").val(data['data'][0]['direccion']);

                $("#tipoI").val(data['data'][0]['instituciones_id']);
                $("#tipo_sangre").val(data['data'][0]['grupo_sanguineo_id']);
                $("#lugar_nacimiento").val(data['data'][0]['lugar_id']);
                $("#tiene_discapacidad").val(data['data'][0]['tiene_discapacidad']);
                calcularEdad(data['data'][0]['fecha_nacimiento'], '#edad');
                $("#genero").val(data['data'][0]['genero_id']);
                $("#pension").val(data['data'][0]['pension']);
                
                if (data['data'][0]['tiene_discapacidad'] == "1") {
                    $('#porcentaje').prop("disabled", false);
                    $('#tipoD').prop("disabled", false);
                    $("#porcentaje").val(data['data'][0]['porcentaje_discapacidad']);
                    $("#tipoD").val(data['data'][0]['tipo_discapacidad']);
                }
                
                $("#observacion").val(data['data'][0]['observacion']);
            }
        });

    }
    
    function buscarRepresentantes(id) {
        var representantesAsignados = {"id": id,
            "opcion": "buscarRepreAsignados"};
        $.ajax({
            type: "POST",
            url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
            data: representantesAsignados, // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
                counter = 1;
                for (var i = 0; i < data['data'].length; i++) {
                    t.row.add([
                        counter,
                        data['data'][i]['cedula'],
                        data['data'][i]['nombre'],
                        data['data'][i]['apellido'],
                        data['data'][i]['descripcion'],
                        data['data'][i]['parentesco'],
                        data['data'][i]['direccion'],
                        data['data'][i]['telefono'],
                        data['data'][i]['correo'],
                        data['data'][i]['tipo'],                        
                        '<button type="button" id="delete" class="btn btn-danger btn-sm" title="Eliminar">\n\
                        <i class="glyphicon glyphicon-remove-sign"></i></button>'
                    ]).draw(false);
                    $("#formulario").append('<input type="hidden" name="dato[]" class="autorizado'+ counter +'" value="' + data['data'][i]['cedula']+ '">');
                    $("#formulario").append('<input type="hidden" name="parentesco[]" class="autorizado'+ counter +'" value="' + data['data'][i]['parentesco'] + '">');
                    $("#formulario").append('<input type="hidden" name="funcion[]" class="autorizado'+ counter +'" value="' + data['data'][i]['tipo'] + '">');                   

                    counter++;
                }
            }
        });
    }
    
    function crearLabelDocumentoCargado(nombreDocumento, dirDocumento){
        
        var a = document.createElement("a");
        a.classList.add('list-group-item');
        a.classList.add('clearfix');
        a.setAttribute("name", dirDocumento)
        a.textContent += nombreDocumento;
        
        var span = document.createElement("span");
        span.classList.add('pull-right');
        span.setAttribute("id", "eliminarDocumento");
        
        var spanChild = document.createElement("span");
        spanChild.classList.add('btn');
        spanChild.classList.add('btn-xs');
        spanChild.classList.add('btn-default');
        spanChild.textContent += "X";
        
        span.appendChild(spanChild);
        a.appendChild(span);
        
        var contenedor = document.getElementById('contenedorDocumentos');
        contenedor.appendChild(a);        
    }
    
    $('#buscarR').autocomplete({
        source: "funciones/estudiantes/filtroRepresentantes.php",
        minLength: 2,
        select: function(event, ui){
            datos(ui.item.value);            
        },
        classes: {
            "ui-autocomplete": "highlight"
        }
    });
                            
});

function datos(cedula) {
    var parametros = {"id": cedula,
        "opcion": "buscarR"};
    
    $.ajax({
        type: "POST",
        url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
        data: parametros, // Adjuntar los campos del formulario enviado.
        success: function (data)
        {            
            if (data['data'][0]['cedula'] == null) {
                $('#gender-m').prop("checked", true);
                $('#gender-fem').prop("checked", false);
            } else {                                
                $("#nombresR").val(data['data'][0]['nombre']);
                $("#apellidosR").val(data['data'][0]['apellido']);
                $("#tipoC").val(data['data'][0]['estado_civil_id']);
                //$("#fechaN").val(data['data'][0]['fecha_nacimiento']);
                $("#direccionR").val(data['data'][0]['direccion']);
                $("#telefono").val(data['data'][0]['telefono']);
                $("#mail").val(data['data'][0]['correo']);
                $("#cedulaR").val(data['data'][0]['cedula']);
                $("#parentesco").val(data['data'][0]['parentesco_id']);
                //calcularEdad(data['data'][0]['fecha_nacimiento'], '#edad2');
                if (data['data'][0]['genero_id'] == 1) {
                    $('#gender-m').prop("checked", true);
                    $('#gender-fem').prop("checked", false);
                } else {
                    $('#gender-fem').prop("checked", true);
                    $('#gender-m').prop("checked", false);
                }
            }
        }
    });

}

function validarExistente(cedulaR, funcion){
    var filas = $("#example").children()[1].children;
    for (var i=0; i<filas.length; i++){        
        if (filas[i].children[1].innerHTML==cedulaR && filas[i].children[9].innerHTML==funcion){
            return false;
        }
    }
    return true;
}