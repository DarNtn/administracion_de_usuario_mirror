$(document).ready(function () {

    
    
})

function cambiarContrasena(){
    
    var contrasenaAntigua = document.getElementById("contrasenaAntigua").value
    var contrasenaNueva = document.getElementById("contrasenaNueva").value
    var username = document.getElementById("username").value
    var tipoUsuario = document.getElementById("tipoUsuario").value
    
    var parametros = {
        "opcion": "cambiarContrasena",
        "username": username,
        "tipoUsuario": tipoUsuario,
        "contrasenaAntigua": contrasenaAntigua,
        "contrasenaNueva": contrasenaNueva
    };
    
    $.ajax({
        type: "POST",
        url: "funciones/contrasena/contrasenaControlador.php",
        data: parametros,
        success: function (data)
        {
            swal({
                title: 'Mensaje',
                text: data['data']['mensaje'],
                type: data['data']['estado'],
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
            }).then(function () {
                window.location.href = "usuario_cambio_clave.php";
            });
        }
    });
    
}