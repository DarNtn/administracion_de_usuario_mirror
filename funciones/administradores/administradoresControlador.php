<?php
header("Content-Type: application/json;charset=utf-8");

require_once('administradoresModelo.php');

$usuario = new Usuario();

// GET ALL
if ($_POST['opcion'] == "listaAdministradores") {
  echo ($usuario->respuestaJson($usuario->get()));
}

// GET ONE
if ($_POST['opcion'] == "idUsuario") {
  $idUsuario=$_POST['id'];
  echo ($usuario->respuestaJson($usuario->getId($idUsuario)));
}

// CREATE
if($_POST['opcion']=="Guardar_administrador"){
    
    echo $usuario->set( $_POST['usuario'], $_POST['clave'], $_POST['estado_id'], $_POST['nombre'],
                        $_POST['apellido'], $_POST['correo'], $_POST['cedula'], $_POST['fotoRaw'] );
}

if($_POST['opcion']=="cambiarEstado"){
    
    echo $usuario->cambiarEstado($_POST['usuarioId'], $_POST['estadoId']);
    
}

// UPDATE
if($_POST['opcion']=="Editar_usuarios"){
  if( empty($_POST['usuario']) || // tabla usuario
      empty($_POST['clave'])  ||
      // tipo se guarda automaticamente en la db, como es adminstrador
      empty($_POST['estado_id']) ||
      // tabla administrador
      empty($_POST['nombre']) || 
      empty($_POST['apellido']) ||
      empty($_POST['correo']) ||
      // empty($_POST['foto']) ||
      empty($_POST['cedula']) ||
      empty($_POST['usuario_id']) ||
      empty($_POST['admin_id'])
      // empty($_POST['cedula_copy1']) // why?
    ) 
  {
    echo $usuario->mensajes("error","Algunos campos estan vacios");
  } else {
    echo $usuario->edit(
      $_POST['usuario'],
      $_POST['clave'],
      $_POST['estado_id'],
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['correo'],
      $_POST['cedula'],
      $_POST['usuario_id'],
      $_POST['admin_id']
      // $_POST['fotoRaw']
    );
  }
}

if ($_POST['opcion'] == "cedulaUsuario") {
  $cedula=$_POST['cedula'];
  echo ($usuario->respuestaJson($usuario->getCedula($cedula)));
}