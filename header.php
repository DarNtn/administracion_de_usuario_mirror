<?php
    session_start();
    include_once('./funciones/conexion/php_conexion.php');
    $conexion = new php_conexion();

    
    switch($_SESSION['tipo_usu']){
        case 'a':
            $rol = 'ADMINISTRADOR';
            break;
        case 'p':
            $rol = 'PROFESOR';
            break;
    }
    
?>
<html lang="en">
    <head>
        <title>Jardín</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/header.css">
        <!-- Javascript -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/js/vue.js">></script>
        <script src="assets/scripts/klorofil-common.js"></script>
        <script src="assets/js/polyfill.min.js"></script>
        <script src="assets/js/bootstrap-vue.js"></script>
        <script src="assets/js/vee-validate.js"></script>
        <script src="assets/js/axios.min.js"></script>
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap-vue.css"/>
        <link href="Plugins/SweetAlert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
        <script src="Plugins/SweetAlert2/sweetalert2.min.js" type="text/javascript"></script>
    </head>

    
    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <!-- NAVBAR -->
            <nav class="navbar navbar-default navbar-fixed-top">
                
                <div class="container-fluid">
                    <div class="navbar-btn">
                        <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>    
                    </div>
                    <div class="navbar-btn" id="rol">
                        <b><?php echo $rol; ?></b>
                    </div>
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="assets/img/user.png" class="img-circle" alt="Avatar" style="width: 30px; height: 30px">
                                    <span>Hola <?php echo $_SESSION['username']; ?>!</span>
                                    <i class="icon-submenu lnr lnr-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="usuario_cambio_clave.php"><i class="lnr lnr-user"></i> <span>Cambio de Clave</span></a></li>

                                    <li><a href="funciones/conexion/php_cerrar.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- END NAVBAR -->
            
            <!-- LEFT SIDEBAR -->
            <div id="sidebar-nav" class="sidebar">
                <div class="sidebar-scroll">
                    <nav>
                        <?php if($rol === "ADMINISTRADOR") : ?>
                        <ul class="nav">
                            <li>
                                <a href="#subMant" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Inicio</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subMant" class="collapse ">
                                    <ul class="nav">
                                        <li><a href="estudiantes.php"><i class="lnr lnr-code"></i>Estudiantes</a></li>
                                        <li><a href="salones.php"><i class="lnr lnr-chart-bars"></i>Cursos</a></li>
                                        <li><a href="personal.php"><i class="lnr lnr-chart-bars"></i>Materias</a></li>
                                        <li><a href="profesor.php"><i class="lnr lnr-chart-bars"></i>Profesores</a></li>
                                        <li><a href="administradores.php"><i class="lnr lnr-chart-bars"></i>Administradores</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li>
                                <a href="#subAsignacion" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Asignación</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subAsignacion" class="collapse ">
                                    <ul class="nav">
                                        <li><a href=""><i class="lnr lnr-code"></i>Vacio</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li>
                                <a href="#subHorario" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Horario de Clases</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subHorario" class="collapse ">
                                    <ul class="nav">
                                        <li><a href=""><i class="lnr lnr-code"></i>Vacio</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li>
                                <a href="#subNotificacion" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Notificación</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subNotificacion" class="collapse ">
                                    <ul class="nav">
                                        <li><a href=""><i class="lnr lnr-code"></i>Vacio</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li>
                                <a href="#subCartelera" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Cartelera</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="subCartelera" class="collapse ">
                                    <ul class="nav">
                                        <li><a href=""><i class="lnr lnr-code"></i>Vacio</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#comunicados" data-toggle="collapse" class="collapsed"><i class="lnr lnr-home"></i> <span>Comunicados</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                                <div id="comunicados" class="collapse">
                                    <ul class="nav">
                                        <li><a href="comunicados.php"><i class="lnr lnr-code"></i>Nueva Notificación</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Bandeja Entrada</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Bandeja Salida</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Nueva Citación</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Citaciones Agendadas</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Nueva Plantilla</a></li>
                                        <li><a ><i class="lnr lnr-code"></i>Plantillas Ingresadas</a></li>
                                        <li><a href="configuracion_mail.php"><i class="lnr lnr-code"></i>Configuración</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!-- END LEFT SIDEBAR -->
            <!-- MAIN -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div style="height: 90%; min-height: 85vh;">
                            <div class="panel panel-headline">
                                <div class="panel-body">