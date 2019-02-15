<?php
    include_once('header.php');
?>
<!-- Inicio del Cabecera-->
<div class="row" style="padding-top: 20px;">
    <div class="col-md-6 col-md-offset-3" align="center">
        <img src="assets/img/logo.png" class="img-responsive" alt="Responsive image">
    </div>
</div>
<div class="row" style="padding-top: 20px;">
    <div class="col-md-7 col-md-offset-6" align="center">
        <div class="row" style="padding-top: 20px;">
            <div class="col-md-6" align="center">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;"><?php $t_alumno=$conexion->realizarConsulta("select count(cedula) as cant from alumno"); echo $t_alumno[0]['cant'] ?></div>
                                <!--<div>Alumnos</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Alumnos</div></div>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="">
                                <i class="fa fa-tasks fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;"><?php $t_salones=$conexion->realizarConsulta("select count(curso_id) as cant from cursos"); echo $t_salones[0]['cant']  ?></div>
                                <!--<div>Cursos</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Cursos</div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;"><?php $t_profesores=$conexion->realizarConsulta("select count(personal_id) as cant from personal"); echo $t_profesores[0]['cant'] ?></div>
                                <!--<div>Profesores</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Profesores</div></div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
