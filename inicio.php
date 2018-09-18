<?php
    session_start();
    include_once('header.php');
?>
<!-- Inicio del Cabecera-->
<div class="row" style="padding-top: 20px;">
    <div class="col-md-6 col-md-offset-3" align="center">
        <img src="assets/img/logo.png" class="img-responsive" alt="Responsive image">
    </div>
</div>
<div class="row" style="padding-top: 20px;">
    <div class="col-md-6 col-md-offset-6" align="center">
        <div class="row" style="padding-top: 20px;">
            <div class="col-md-6" align="center">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;">1000<?php // echo $t_alumno; ?></div>
                                <!--<div>Alumnos</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Alumnos</div></div>
                    </div>
<!--                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;">1000<?php // echo $t_salones;  ?></div>
                                <!--<div>Cursos</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Cursos</div></div>
                    </div>
<!--                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;">1000<?php // echo $t_profesores;  ?></div>
                                <!--<div>Profesores</div>-->
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Profesores</div></div>
                    </div>
<!--                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="font-size: 40px;line-height: 40px;">1000 <?php // echo $t_pagos;  ?></div>
<!--                                <div>Pagos Pendientes</div>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="font-size: 18px;margin-top: 10px;">Pagos Pendientes</div></div>
                    </div>
<!--                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- Fin del Cabecera-->
<?php
include_once('footer.php');
