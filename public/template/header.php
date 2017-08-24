<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>CoreUI - Open Source Bootstrap Admin Template</title>

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

            
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo PATH_IMAGES; ?>/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>

                    <div class="dropdown-header text-center">
                        <strong>Settings</strong>
                    </div>

                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
           

        </ul>
    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> Dashboard <span class="badge badge-info">NEW</span></a>
                    </li>

                    <li class="nav-title">
                        UI Elements
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> Administraci&oacute;n</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="../../Usuario/listar/"><i class="icon-puzzle"></i>Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Seccion/listar/"><i class="icon-puzzle"></i> Secci&oacute;n</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Especialidad/listar/"><i class="icon-puzzle"></i> Especialidad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Curso/listar/"><i class="icon-puzzle"></i> Curso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Materia/listar/"><i class="icon-puzzle"></i> Materia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Periodo/listar/"><i class="icon-puzzle"></i> Per&iacute;odo</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-notebook"></i> Matr&iacute;cula</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="../../MateriaDocente/listar/"><i class="icon-notebook"></i> Docentes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Matricula/listar/"><i class="icon-notebook "></i> Estudiantes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-book-open"></i>Evaluci&oacute;n</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="../../Evaluacion/listar/" target="_top"><i class="icon-book-open"></i>Evaluaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../Pregunta/listar/" target="_top"><i class="icon-book-open "></i>Preguntas</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!--  
                    <li class="nav-item">
                        <a class="nav-link" href="widgets.html"><i class="icon-calculator"></i> Widgets <span class="badge badge-info">NEW</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="charts.html"><i class="icon-pie-chart"></i> Charts</a>
                    </li>
                    <li class="divider"></li>
                    <li class="nav-title">
                        Extras
                    </li>
                    
					-->
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">
        
         <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>

                <!-- Breadcrumb Menu-->
                <li class="breadcrumb-menu d-md-down-none">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                        <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                        <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                    </div>
                </li>
            </ol>
			<div class="container-fluid">
        
        
        
        
        