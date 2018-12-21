$(document).ready(function () {
    
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

