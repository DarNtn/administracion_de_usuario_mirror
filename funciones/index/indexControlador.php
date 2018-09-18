<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
require_once('indexModelo.php');
# Traer los datos de un usuario
$index = new Index();
if($_POST['opcion']=="iniciar"){
$index->iniciarSession($_POST['usuario'],$_POST['contra']);
}
