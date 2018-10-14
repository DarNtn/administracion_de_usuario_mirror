<?php

header("Content-Type: application/json;charset=utf-8");
require_once('estudianteModelo.php');
# Traer los datos de un usuario
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
    if (empty($_POST['cedula']) || empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['fechaNac']) || empty($_POST['mail']) || empty($_POST['genero']) || empty($_POST['tipoC'])) {
        echo $estudiante->mensajes("warning", "Algunos campos estan vacios");
    } else {
        if (empty($_FILES['certificadoRepresentante']['name'])) {
            $urlnueva = "archivos/certificadoTrabajo/defaul.jpg";
        } else {
            $urlnueva = "archivos/certificadoTrabajo/" . $_POST['cedula'] . ".jpg";
        }
        $resultado = $estudiante->crearRepresentante($_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], $_POST['genero'], $_POST['telefono'], $_POST['fechaNac'], $_POST['mail'], $_SESSION['user'], $_POST['tipoC'], $urlnueva);
        if ($resultado != 0) {
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
                echo $estudiante->mensajes("success", $resultado);
            }
        } else {
            echo $estudiante->mensajes("error", "No se pudo realizar el registro de representante");
        }
    }
}

if ($_POST['opcion'] == "ingresar_estudiante") {
    if (empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['fechaNac']) || empty($_POST['tipo_sangre']) || empty($_POST['lugar_nacimiento']) || empty($_POST['direccion']) || empty($_POST['tiene_discapacidad']) || empty($_POST['genero']) || empty($_POST['tipoI'])) {
        echo $estudiante->mensajes("warning", "Algunos campos estan vacios");
    } else {
        // ESTE IF FUE COMENTADO PORQUE FALTA LA PARTE DE AGREGAR REPRESENTANTES/AUTORIZADOS A RETIRAR/PADRES
        //if (isset($_POST['dato'])) {
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
//            if ($respuesta != 0) {
//                $comentario = "";
//                if (!empty($_FILES["imagen"]['name'])) {
//                    $nameimagen = $_FILES['imagen']['name'];
//                    $tmpimagen = $_FILES['imagen']['tmp_name'];
//                    $extimagen = pathinfo($nameimagen);
//                    $urlnueva = "fotos/" . $respuesta . ".jpg";
//                    if ($extimagen['extension'] == "jpg") {
//                        copy($tmpimagen, $urlnueva);
//                        $estudiante->fotoEstudiante($respuesta, $urlnueva);
//                    } else {
//                        $comentario = ", error al cargar imagen";
//                    }
//                }
//                if (!empty($_FILES["certificado"]['name'])) {
//                    $namecerti = $_FILES['certificado']['name'];
//                    $tmpcerti = $_FILES['certificado']['tmp_name'];
//                    $extcerti = pathinfo($namecerti);
//                    $urlcertificado = "certificados/" . $respuesta . ".jpg";
//                    if ($extcerti['extension'] == "jpg") {
//                        copy($tmpcerti, $urlcertificado);
//                        $estudiante->certificadoEstudiante($respuesta, $urlcertificado);
//                    } else {
//                        $comentario = $comentario . ", error al cargar certificado";
//                    }
//                }

//                Aquí se registran los padres/representantes/autorizados a retirar
//                $dto = $_POST['dato'];
//                $parent = $_POST['parentesco'];
//                $n = count($dto);
//                $i = 0;
//                while ($i < $n) {
//                    $estudiante->asignarRepresentante($respuesta, $dto[$i], '2', $parent[$i]);
//                    $i++;
//                }
//                echo mensajes("success", "Alumno registrado exitosamente" . $comentario);
//            } else {
                //echo mensajes("error", "Alumno ya se encuentra");
//            }
//        } else {
//            echo mensajes("error", "No hay representantes");
//        }
    }
}

if ($_POST['opcion'] == "Modificar_estudiante2") {
    if (empty($_POST['nombres']) || empty($_POST['apellidos']) || empty($_POST['fechaNac']) || empty($_POST['tipo_sangre']) || empty($_POST['lugar_nacimiento']) || empty($_POST['direccion']) || empty($_POST['tiene_discapacidad']) || empty($_POST['genero']) || empty($_POST['tipoI'])) {
        echo $estudiante->mensajes("warning", "Algunos campos estan vaciossssss");
    } else {
        // ESTE IF FUE COMENTADO PORQUE FALTA LA PARTE DE AGREGAR REPRESENTANTES/AUTORIZADOS A RETIRAR/PADRES
        //if (isset($_POST['dato'])) {
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
            echo $estudiante ->mensajes("respuesta", $respuesta);
//            if ($respuesta == "success") {
//                $comentario = "";
//                if (!empty($_FILES["imagen"]['name'])) {
//                    $nameimagen = $_FILES['imagen']['name'];
//                    $tmpimagen = $_FILES['imagen']['tmp_name'];
//                    $extimagen = pathinfo($nameimagen);
//                    $urlnueva = "archivos/fotos/" . $_POST['id'] . ".jpg";
//                    if ($extimagen['extension'] == "jpg") {
//                        copy($tmpimagen, $urlnueva);
//                        $estudiante->fotoEstudiante($respuesta, $urlnueva);
//                    } else {
//                        $comentario = ", error al cargar imagen";
//                    }
//                }
//                if (!empty($_FILES["certificado"]['name'])) {
//                    $namecerti = $_FILES['certificado']['name'];
//                    $tmpcerti = $_FILES['certificado']['tmp_name'];
//                    $extcerti = pathinfo($namecerti);
//                    $urlcertificado = "archivos/certificados/" . $_POST['id'] . ".jpg";
//                    if ($extcerti['extension'] == "jpg") {
//                        copy($tmpcerti, $urlcertificado);
//                        $estudiante->certificadoEstudiante($respuesta, $urlcertificado);
//                    } else {
//                        $comentario = $comentario . ", error al cargar certificado";
//                    }
//                }
//                $estudiante->eliminarRepresentantes($_POST['id']);
//                $dto = $_POST['dato'];
//                $parent = $_POST['parentesco'];
//                $n = count($dto);
//                $i = 0;
//                while ($i < $n) {
//                    $estudiante->asignarRepresentante($_POST['id'], $dto[$i], '2', $parent[$i]);
//                    $i++;
//                }
//                echo $estudiante->mensajes("success", "Alumno modificado exitosamente" . $comentario);
//            } else {
//                echo $estudiante->mensajes("error", $respuesta);
//            }
//        } else {
//            echo $estudiante->mensajes("error", "No hay representantes");
//        }
    }
}

if ($_POST['opcion'] == "buscarAlumno") {
    echo $estudiante->respuestaJson($estudiante->buscarEstudiante($_POST['id']));
}

if ($_POST['opcion'] == "estadoAlumno") {
    $estudiante->estadoAlumno($_POST['id'], $_POST['estado']);
}