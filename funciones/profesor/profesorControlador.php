<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
require_once('profesorModelo.php');

$profesor = new Profesor();

if ($_POST['opcion'] == "crearProfesor") {
    
    $respuesta = $profesor->crearProfesor(
        $_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['especialidad'], 
        $_POST['telefono'], $_POST['correo'], 0, $_POST['genero'], 
        $_POST['estadoCivil'], $_POST['direccion'], $_POST['fechaNacimiento'], 
        $_POST['fechaInicioLaboral'], $_POST['anosExperiencia'], 
        $_POST['nCargas'], 0, $_POST['usuario'], $_POST['password']);
    
    // Guardar imagen
    if (!empty($_FILES["imagen"]['name'])) {
        
        $nameimagen = $_FILES['imagen']['name'];
        $tmpimagen = $_FILES['imagen']['tmp_name'];
        $extimagen = pathinfo($nameimagen);
        $urlnueva = "archivos/fotos/" . $_POST['cedula'] . ".jpg";
        
        if ($extimagen['extension'] == "jpg") {
            copy($tmpimagen, $urlnueva);
            $profesor->foto($_POST['cedula'], $urlnueva);
        }
        
    }
    
    // Guardar curriculum
    if (!empty($_FILES["curriculum"]['name'])) {
        
        $name = $_FILES['curriculum']['name'];
        $tmp = $_FILES['curriculum']['tmp_name'];
        $ext = pathinfo($name);
        $urlnueva = "archivos/curriculum/" . $_POST['cedula'] . ".pdf";
        
        if ($ext['extension'] == "pdf") {
            copy($tmp, $urlnueva);
            $profesor->curriculum($_POST['cedula'], $urlnueva);
        }
        
    }
   
    if($respuesta == 1 ){
        echo $profesor->mensajes("success", "Profesor registrado exitosamente");
    }else{
        echo $profesor->mensajes("error", "Profesor ya se encuentra registrado");        
    }
    
}

if ($_POST['opcion'] == "ingresarTelefonos") {
    
//    $telefonos = $_POST['telefonos'];
//    $cedula = $_POST['cedula'];
//    
//    echo $profesor->mensajes("success", $telefonos); 
//    
//    for ($i = 0; $i <= count($telefonos); $i++) {
//        echo $i;
//    }
    //echo $profesor->mensajes("success", "Profesor registrado exitosamente");
    return "HOLA";
}

if ($_GET['opcion'] == "obtenerListaProfesores") {
    
    echo $profesor->respuestaJson($profesor->obtenerListaProfesores());

}

if ($_GET['opcion'] == "obtenerProfesorPorCedula") {
    
    echo $profesor->respuestaJson($profesor->obtenerProfesorPorCedula($_GET['cedula']));

}
