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
        $_POST['nCargas'], 0, 0, $_POST['usuario'], $_POST['password']);
   
    if($respuesta == 1 ){
        echo $profesor->mensajes("success", "Profesor registrado exitosamente");
    }else{
        echo $profesor->mensajes("error", "Profesor ya se encuentra registrado");        
    }
    
}

