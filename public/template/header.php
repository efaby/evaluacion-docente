<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="<?php echo PATH_IMAGES; ?>/favicon.png">

    <title>Sistema de Evaluaci&oacute;n Docente</title>

    <!-- Icons -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo PATH_CSS; ?>/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
   

     <link href="<?php echo PATH_CSS; ?>/style.css" rel="stylesheet">


</head>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>   
            <li class="nav-item px-3">
                <h3>Sistema de Evaluaci&oacute;n Docente</h3>
            </li>         
        </ul>

        <ul class="nav navbar-nav ml-auto" style="padding-right: 20px;">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo PATH_IMAGES; ?>/avatars/avatar.png" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none"><?php echo $_SESSION['SESSION_USER']->nombres." ".$_SESSION['SESSION_USER']->apellidos; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="../../Seguridad/cambio_contrasena/"><i class="fa fa-shield"></i> Cambiar Contrase&ntilde;a</a> 
                    <a class="dropdown-item" href="../../Seguridad/cerrarSesion/"><i class="fa fa-lock"></i> Cerrar sesi&oacute;n</a>
                </div>
            </li>
           

        </ul>
    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../Seguridad/inicio/"><i class="icon-speedometer"></i> Inicio </a>
                    </li>
                     <?php if($_SESSION['SESSION_USER']->tipo_usuario_id ==1):?>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Administraci&oacute;n</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Usuario/listar/"><i class="icon-puzzle"></i>Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Seccion/listar/"><i class="icon-puzzle"></i> Secci&oacute;n</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Especialidad/listar/"><i class="icon-puzzle"></i> Especialidad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Curso/listar/"><i class="icon-puzzle"></i> Curso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Materia/listar/"><i class="icon-puzzle"></i> Materia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Periodo/listar/"><i class="icon-puzzle"></i> Per&iacute;odo</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-notebook"></i> Matr&iacute;cula</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../MateriaDocente/listar/"><i class="icon-notebook"></i> Docentes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Matricula/listar/"><i class="icon-notebook "></i> Estudiantes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Matricula/listarAdministrativos/"><i class="icon-notebook "></i> Directivos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-book-open"></i>Evaluaci&oacute;n</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Evaluacion/listar/" target="_top"><i class="icon-book-open"></i>Evaluaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Pregunta/listar/" target="_top"><i class="icon-book-open "></i>Preguntas</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-book-open"></i>Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Reporte/docentes/" target="_top"><i class="icon-book-open"></i>Reporte Estudiantes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Reporte/docentesAdmin/" target="_top"><i class="icon-book-open"></i>Reporte Directivos</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if($_SESSION['SESSION_USER']->tipo_usuario_id ==2):?>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-book-open"></i>Mis Evaluaciones</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Reporte/listar/" target="_top"><i class="icon-book-open"></i>Reporte Estudiantes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tab-link" href="../../Reporte/listarAdminByDocente/" target="_top"><i class="icon-book-open"></i>Reporte Directivos</a>
                            </li>
                        </ul>
                    </li>

                <?php endif; ?>  
                <?php if($_SESSION['SESSION_USER']->tipo_usuario_id ==3):?>
                    <li class="nav-item">
                        <a class="nav-link" href="../../EvaluacionEstudiante/listar/"><i class="icon-calendar"></i> Evaluar </a>
                    </li>
                <?php endif; ?> 
                <?php if($_SESSION['SESSION_USER']->tipo_usuario_id ==4):?>
                    <li class="nav-item">
                        <a class="nav-link" href="../../EvaluacionDocente/listar/"><i class="icon-calendar"></i> Evaluar </a>
                    </li>
                <?php endif; ?>   
                </ul>

            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
        
         <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item"><?php echo $title; ?></li>

                <!-- Breadcrumb Menu-->

            </ol>
			<div class="container-fluid">
        
        
        
        
        