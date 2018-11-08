<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
require_once('estudianteModelo.php');
$estudiante = new Estudiante();

if ($_POST['opcion'] == "Lista_alumno") {
    echo $estudiante->respuestaJson($estudiante->lista_alumno());
}

if ($_POST['opcion'] == "buscarR") {
    echo $estudiante->respuestaJson($estudiante->buscarRepresentante($_POST['id']));
}

if ($_POST['opcion'] == "buscarRepreAsignados") {
    echo $estudiante->respuestaJson($estudiante->listaRepresenAsigna($_POST['id']));
}

if ($_POST['opcion'] == "Guardar_representante") {    
    if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['mail']) || empty($_POST['genero']) || empty($_POST['tipoC']) || empty($_POST['funcion']) || empty($_POST['parentesco'])) {
        echo $estudiante->mensajes("warning", "Algunos campos estan vacios");
    } else {
        /*
        if (empty($_FILES['certificadoRepresentante']['name'])) {
            $urlnueva = "archivos/certificadoTrabajo/defaul.jpg";
        } else {
            $urlnueva = "archivos/certificadoTrabajo/" . $_POST['cedula'] . ".jpg";
        }
         */        
        
        if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
            $cuenta = array($_POST['usuario'],$_POST['password']);
        } else{
            $cuenta = null;
        }
        
        $resultado = $estudiante->crearRepresentante($_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], $_POST['genero'], $_POST['telefono'], $_POST['mail'], $_POST['tipoC'], $cuenta);
        if ($resultado != null) {
            /*
            if (!empty($_FILES["certificadoRepresentante"]['name'])) {
                $nameimagen = $_FILES['certificadoRepresentante']['name'];
                $tmpimagen = $_FILES['certificadoRepresentante']['tmp_name'];
                $extimagen = pathinfo($nameimagen);
                if ($extimagen['extension'] == "jpg") {
                    copy($tmpimagen, $urlnueva);
                    echo $estudiante->mensajes("success", $resultado);
                } else {
                    echo $estudiante->mensajes("warning", $resultado);
                }
            } else {             
             */
         
            echo $estudiante->mensajes("success", "Autorizado agregado");
            //}
        } else {
            echo $estudiante->mensajes("error", "No se pudo realizar el registro de representante");
        }
    }
}

if ($_POST['opcion'] == "ingresar_estudiante") {
    
    if (empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['fechaNac']) || empty($_POST['tipo_sangre']) || empty($_POST['lugar_nacimiento']) || empty($_POST['direccion']) || empty($_POST['tiene_discapacidad']) || empty($_POST['genero']) || empty($_POST['tipoI'])) {
        
        echo $estudiante->mensajes("warning", "Algunos campos estan vacios");
        
    } else {
        
        if (isset($_POST['dato'])) {
            if (empty($_POST['porcentaje_discapacidad'])) {
                $porcentaje = 0;
            } else {
                $porcentaje = $_POST['porcentaje_discapacidad'];
            }
            if (empty($_POST['tipo'])) {
                $tipoDiscapacidad = '';
            } else {
                $tipoDiscapacidad = $_POST['tipo'];
            }
            $respuesta = $estudiante->crearEstudiante($_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['genero'], $_POST['direccion'], $_POST['tiene_discapacidad'], $porcentaje, $_POST['fechaNac'], $_POST['lugar_nacimiento'], $_POST['tipo_sangre'], $_SESSION['user'], $_POST['tipoI'], $tipoDiscapacidad, $_POST['observacion'], $_POST['pension']);
            if ($respuesta == 1) {
                $comentario = "";
                // Guardar foto de alumno
                if (!empty($_FILES["imagen"]['name'])) {
                    $nameimagen = $_FILES['imagen']['name'];
                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                    $extimagen = pathinfo($nameimagen);
                    $urlnueva = "archivos/fotos/" . $_POST['cedula'] . ".jpg";
                    if ($extimagen['extension'] == "jpg" || $extimagen['extension'] == "jpeg") {
                        copy($tmpimagen, $urlnueva);
                        $estudiante->fotoEstudiante($_POST['cedula'], $urlnueva);
                    } else {
                        $comentario = ". Error al cargar foto, tipo de dato no soportado.";
                    }
                }
                // Guardar documentos de alumno
                $nombre = "documento-1";
                while (!empty($_FILES[$nombre]['name'])) {
                    $namecerti = $_FILES[$nombre]['name'];
                    $tmpcerti = $_FILES[$nombre]['tmp_name'];
                    $urlcertificado = "archivos/certificados/" . $_POST['cedula'] . "-" . $namecerti;
                    copy($tmpcerti, $urlcertificado);
                    $estudiante->documentoEstudiante($_POST['cedula'], $namecerti, $urlcertificado);
                    $numero = (int) explode("-", $nombre)[1];
                    $nombre = "documento-" . ($numero + 1);
                }
                
                //Aquí se registran los padres/representantes/autorizados a retirar
                try{
                    $dto = $_POST['dato'];
                    $parent = $_POST['parentesco'];
                    $funcion = $_POST['funcion'];
                    $n = count($dto);
                    $i = 0;
                    
                    while ($i < $n) {                        
                        $estudiante->asignarRepresentante($_POST['cedula'], $dto[$i], $parent[$i], $funcion[$i]);
                        $i++;
                    }
                                        
                    echo $estudiante->mensajes("success", "Alumno registrado exitosamente");
                } catch (Exception $e){
                    echo $estudiante->mensajes("error", $e->getMessage());
                }
            } else {
                echo $estudiante->mensajes("error", "Alumno ya se encuentra registrado");
            }
        } else {
            echo $estudiante->mensajes("error", "No hay representantes.");
        }
    }
}

if ($_POST['opcion'] == "Modificar_estudiante2") {
    
    if (empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['fechaNac']) || empty($_POST['tipo_sangre']) || empty($_POST['lugar_nacimiento']) || empty($_POST['direccion']) || empty($_POST['tiene_discapacidad']) || empty($_POST['genero']) || empty($_POST['tipoI'])) {
        echo $estudiante->mensajes("warning", "Algunos campos estan vaciossssss");
    } else {
        
        if (isset($_POST['dato'])) {
            if (empty($_POST['porcentaje_discapacidad'])) {
                $porcentaje = 0;
            } else {
                $porcentaje = $_POST['porcentaje_discapacidad'];
            }
            if (empty($_POST['tipo'])) {
                $tipoDiscapacidad = '';
            } else {
                $tipoDiscapacidad = $_POST['tipo'];
            }
            $respuesta = $estudiante->modificarEstudiante($_POST['id'], $_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['genero'], $_POST['direccion'], $_POST['tiene_discapacidad'], $porcentaje, $_POST['fechaNac'], $_POST['lugar_nacimiento'], $_POST['tipo_sangre'], $_SESSION['user'], $_POST['tipoI'], $tipoDiscapacidad, $_POST['observacion']);            
            
            if ($respuesta) {    
                $comentario = "";
                // Guardar foto de alumno
                if (!empty($_FILES["imagen"]['name'])) {
                    $nameimagen = $_FILES['imagen']['name'];
                    $tmpimagen = $_FILES['imagen']['tmp_name'];
                    $extimagen = pathinfo($nameimagen);
                    $urlnueva = "archivos/fotos/" . $_POST['id'] . ".jpg";
                    if ($extimagen['extension'] == "jpg" || $extimagen['extension'] == "jpeg") {
                        copy($tmpimagen, $urlnueva);
                        $estudiante->fotoEstudiante($_POST['id'], $urlnueva);
                    } else {
                        $comentario = ". Error al cargar foto, tipo de dato no soportado.";
                    }
                }
                
                // Guardar documentos de alumno
                $nombre = "documento-1";
                while (!empty($_FILES[$nombre]['name'])) {
                    $namecerti = $_FILES[$nombre]['name'];
                    $tmpcerti = $_FILES[$nombre]['tmp_name'];
                    $urlcertificado = "archivos/certificados/" . $_POST['id'] . "-" . $namecerti;
                    copy($tmpcerti, $urlcertificado);
                    $estudiante->documentoEstudiante($_POST['id'], $namecerti, $urlcertificado);
                    $numero = (int) explode("-", $nombre)[1];
                    $nombre = "documento-" . ($numero + 1);

                }
                try {
                    $estudiante->eliminarRepresentantes($_POST['id']);
                    $dto = $_POST['dato'];
                    $parent = $_POST['parentesco'];
                    $funcion = $_POST['funcion'];
                    $n = count($dto);
                    $i = 0;
                    while ($i < $n) {
                        $estudiante->asignarRepresentante($_POST['id'], $dto[$i], $parent[$i], $funcion[$i]);
                        $i++;
                    }
                    echo $estudiante->mensajes("success", "Alumno modificado exitosamente" . $comentario);
                } catch(Exception $e){
                    echo $estudiante->mensajes("error", $e->getMessage());
                }

            } else {
                echo $estudiante->mensajes("error", $respuesta);
            }
        }
    }
}

if ($_POST['opcion'] == "buscarAlumno") {
    echo $estudiante->respuestaJson($estudiante->buscarEstudiante($_POST['id']));
}

if ($_POST['opcion'] == "estadoAlumno") {
    $estudiante->estadoAlumno($_POST['id'], $_POST['estado']);
}

if ($_POST['opcion'] == "cargarDocumentos"){
    echo $estudiante->respuestaJson($estudiante->cargarDocumentos($_POST['id']));
} 

if ($_POST['opcion'] == "eliminarDocumentos"){
    for ($i = 0; $i < count($_POST['documentos']); $i++) {
        $estudiante->eliminarDocumento($_POST['documentos'][$i]);
        unlink($_POST['documentos'][$i]);
    }
}
