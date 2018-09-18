var t;
$(document).ready(function () {
    t = $('#example').DataTable({
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 9
            }],
        "order": [[1, 'asc']],
        lengthChange: false,
        "language": {
            "zeroRecords": "No hay resultados - lo sentimos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": ""
        }
    });
    var counter = 1;

    $('#example tbody').on('click', '#delete', function () {
        t
                .row($(this).parents('tr'))
                .remove()
                .draw();
    });

    $("form#formularioRepresentante").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        if (validarCedula($("#cedulaR").val())) {
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
                        console.log(JSON.stringify(data));

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
                            '<input type="hidden" name="dato[]" value="' + data['data']['mensaje'] + '"><input type="hidden" name="parentesco[]" value="' + $('#parentesco').val() + '"><button type="button" id="delete" class="btn btn-danger btn-sm" title="Eliminar"><i class="glyphicon glyphicon-remove-sign"></i></button>'
                        ]).draw(false);

                        counter++;
                        document.getElementById("formularioRepresentante").reset();
                        $('#nuevo').modal('hide');
                    } else {
                        swal('Mensaje', data['data']['mensaje'], data['data']['estado']);
                    }
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });


    $("form#formulario").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        if (validarCedula($("#ced").val())) {
            $.ajax({
                type: "POST",
                url: "funciones/estudiantes/estudianteControlador.php", // El script a dónde se realizará la petición.
                data: formData, // Adjuntar los campos del formulario enviado.
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: function (data)
                {
                    swal({
                        title: 'Mensaje',
                        text: data['data']['mensaje'],
                        type: data['data']['estado'],
                        confirmButtonText: "OK"
                    },
                            function () {
                                if (data['data']['estado'] == "success") {
                                    window.location.href = 'crear_alumno.php';
                                }
                            });
                }
            });
        }
        return false; // Evitar ejecutar el submit del formulario.
    });

//
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    var id = getParameterByName('id');
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
            success: function (data)
            {
                console.log(JSON.stringify(data));
                $("#id").val(data['data'][0]['alumno_id']);
                if (data['data'][0]['1'] != "No posee Cédula") {
                    $("#ced").val(data['data'][0]['cedula']);
                }
                $("#nombres").val(data['data'][0]['nombres']);
                $("#apellidos").val(data['data'][0]['apellidos']);
                $("#fechaNac").val(data['data'][0]['fecha_nacimiento']);
                $("#direccion").val(data['data'][0]['direccion']);

                $("#tipoI").val(data['data'][0]['instituciones_id']);
                $("#tipo_sangre").val(data['data'][0]['grupo_sangrineo_id']);
                $("#lugar_nacimiento").val(data['data'][0]['lugar_id']);
                $("#tiene_discapacidad").val(data['data'][0]['tiene_discapacidad']);
                calcularEdad(data['data'][0]['fecha_nacimiento'], '#edad');
                $("#genero").val(data['data'][0]['genero_id']);
                if (data['data'][0]['6'] == "SI") {
                    $('#porcentaje').prop("disabled", false);
                    $('#tipoD').prop("disabled", false);
                    $("#porcentaje").val(data['data'][0]['porcentaje_discapacidad']);
                    $("#tipoD").val(data['data'][0]['tipo_de_discapacidad']);
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
                        data['data'][i]['nombres'],
                        data['data'][i]['apellidos'],
                        data['data'][i]['descripcion'],
                        data['data'][i]['parntesco'],
                        data['data'][i]['direccion'],
                        data['data'][i]['telefono'],
                        data['data'][i]['email'],
                        '<input type="hidden" name="dato[]" value="' + data['data'][i]['id'] + '"><input type="hidden" name="parentesco[]" value="' + data['data'][i]['parentesco_id'] + '"><button type="button" id="delete" class="btn btn-danger btn-sm" title="Eliminar"><i class="glyphicon glyphicon-remove-sign"></i></button>'
                    ]).draw(false);
                    counter++;
                }
            }
        });
    }
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
            console.log(JSON.stringify(data));
            if (data['data'] == null) {
                $('#gender-maleR').prop("checked", true);
                $('#gender-femaleR').prop("checked", false);
            } else {


                $("#idR").val(data['data'][0]['representante_id']);
                $("#nombresR").val(data['data'][0]['nombres']);
                $("#apellidosR").val(data['data'][0]['apellidos']);
                $("#tipoC").val(data['data'][0]['estado_civil_id']);
                $("#fechaN").val(data['data'][0]['fecha_nacimiento']);
                $("#direccionR").val(data['data'][0]['direccion']);
                $("#telefono").val(data['data'][0]['telefono']);
                $("#mail").val(data['data'][0]['email']);
                $("#cedulaR").val(data['data'][0]['cedula']);
                $("#parentesco").val(data['data'][0]['parentesco_id']);
                calcularEdad(data['data'][0]['fecha_nacimiento'], '#edad2');
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