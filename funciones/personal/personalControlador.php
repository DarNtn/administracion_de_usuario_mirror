<?php

header("Content-Type: application/json;charset=utf-8");
require_once('personalModelo.php');
# Traer los datos de un usuario
$personal = new Personal();

if ($_POST['opcion'] == "idPersonal") {
    $idPersonal = $_POST['id'];
    echo ($personal->respuestaJson($personal->getId($idPersonal)));
}

if ($_POST['opcion'] == "cedulaPersonal") {
    $cedula = $_POST['cedula'];
    echo ($personal->respuestaJson($personal->getCedula($cedula)));
}

if ($_POST['opcion'] == "listaPersonal") {
    echo ($personal->respuestaJson($personal->get()));
}

if ($_POST['opcion'] == "comboCategoria") {
    echo ($personal->respuestaJson($personal->getEspecialidades($_POST['id'])));
}

if ($_POST['opcion'] == "Guardar_personal") {
    if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['especialidad']) || empty($_POST['telefono']) || empty($_POST['mail']) || empty($_POST['genero']) || empty($_POST['tipoC']) || empty($_POST['direccion']) || empty($_POST['fechaNac']) || empty($_POST['estado'])) {
        echo $personal->mensajes("error", "Algunos campos estan vacios");
    } else {
        $idPersonal = $personal->set($_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['especialidad'], $_POST['telefono'], $_POST['mail'], $_POST['genero'], $_POST['tipoC'], $_POST['direccion'], $_POST['fechaNac'], $_POST['fechaLab'], $_POST['aniosE'], $_POST['cargas'], $_POST['estado']);
        if (empty($_FILES["archivo"]['name'])) {
            $personal->mensajes('success', 'El regitro se hizo Exitosamente');
        } else {
            $namearchivo = $_FILES['archivo']['name'];
            $exparchivo = pathinfo($namearchivo);
            $urlarchivo = "archivos/curriculum/".$idPersonal.".".$exparchivo['extension'];
            $tmparchivo = $_FILES['archivo']['tmp_name'];
            if ($exparchivo['extension'] == "xlsx" || $exparchivo['extension'] == "doc" || $exparchivo['extension'] == "xls" || $exparchivo['extension'] == "docx" || $exparchivo['extension'] == "pdf") {
                $personal->setImage($idPersonal,$urlarchivo);
                copy($tmparchivo, $urlarchivo);
                $personal->mensajes("success", "Postulante registrado con exito");
            } else {
                $personal->mensajes("info", "El registro se hizo Exitosamente; pero hubo un problema cargando el curriculum");
            }
        }
    }
}

if ($_POST['opcion'] == "Editar_personal") {
    if (empty($_POST['id']) || empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['especialidad']) || empty($_POST['telefono']) || empty($_POST['mail']) || empty($_POST['genero']) || empty($_POST['tipoC']) || empty($_POST['direccion']) || empty($_POST['fechaNac']) || empty($_POST['estado'])) {
        echo $personal->mensajes("error", "Algunos campos estan vacios");
    } else {
         if (!empty($_FILES["archivo"]['name'])) {
            $namearchivo = $_FILES['archivo']['name'];
            $exparchivo = pathinfo($namearchivo);
            $urlarchivo = "archivos/curriculum/".$_POST['id'].".".$exparchivo['extension'];
            $tmparchivo = $_FILES['archivo']['tmp_name'];
            if ($exparchivo['extension'] == "xlsx" || $exparchivo['extension'] == "doc" || $exparchivo['extension'] == "xls" || $exparchivo['extension'] == "docx" || $exparchivo['extension'] == "pdf") {
                $personal->realizarIngreso("UPDATE personal SET curriculum_direccion='' WHERE `personal_id`='".$_POST['id']."';");
                copy($tmparchivo, $urlarchivo);
            }
        }else{$urlarchivo = ""; }
        $idPersonal = $personal->edit($_POST['id'],$_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['especialidad'], $_POST['telefono'], $_POST['mail'], $_POST['genero'], $_POST['tipoC'], $_POST['direccion'], $_POST['fechaNac'], $_POST['fechaLab'], $_POST['aniosE'], $_POST['cargas'], $_POST['estado'],$urlarchivo);
    }
}
