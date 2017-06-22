<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES.'/favicon.ico'?>" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SAM-W&L</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo PATH_CSS; ?>/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo PATH_CSS; ?>/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo PATH_CSS; ?>/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo PATH_CSS; ?>/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo PATH_CSS; ?>/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    body,html{
		height:100%; /*Siempre es necesario cuando trabajamos con alturas*/
	}
	 #inferior{
				
		position:absolute; 
		left:0px; 
		right:0px; 
		bottom:10px; 
		width: 250px;
		z-index:0;
	 }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">SAM-W&L</a>
            <div id="logo"><img src="<?php echo PATH_IMAGES; ?>/logo1.png" height="50px"></div>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
       

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['SESSION_USER']->nombres; ?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                   
                    <li><a href="../../Seguridad/cambiarContrasena/"><i class="fa fa-gear fa-fw"></i> Contraseña</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../../Seguridad/cerrarSesion/"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
				<?php $url = $_SERVER["REQUEST_URI"];?>
				
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            
                        </div>
                    </li>
                   
                    <li>
                        <a href="../../Seguridad/inicio/" class="<?php echo (strpos($url, 'Seguridad/inicio/'))?'active':'';?>"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
                    </li>
                    <?php foreach ($_SESSION['SESSION_USER']->links as $item1):?>
                    <?php if($item1->menu >= 1):?>
	                    <li>
	                        <a href="../../<?php echo $item1->accion;?>" class="<?php echo (strpos($url, $item1->accion))?'active':'';?>"><i class="fa <?php echo $item1->icono;?> fa-fw"></i><?php echo $item1->titulo;?></a>
	                    </li>  
	                    <?php if($item1->menu == 2):?>
			                     </ul>
		                    </li>
	                     <?php endif;?>  
	                <?php else:?>
	                <li>
	                	<a href="#" class="<?php echo (strpos($url, $item1->accion))?'active':'';?>"><i class="fa <?php echo $item1->icono;?> fa-fw"></i> <?php echo $item1->titulo;?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">                                   
	                <?php endif;?>                  
                    <?php endforeach;?>
                    
                </ul>

            </div>
        </div>
    </nav>

	<?php if($_SESSION['SESSION_USER']->tipo < 3): ?>
	<div id="inferior">
		<ul class="nav" id="side-menu">
			<?php if($_SESSION['SESSION_USER']->tipo == 1): ?>
			<li >
                <a href="../../Respaldo/crear/" style="background: #eee"><i class="fa fa-database fa-fw"></i>Respaldar Datos</a>
            </li>
            <?php else:?>
            <li >
                <a href="../../Novedades/ingreso/" style="background: #eee"><i class="fa fa-pencil fa-fw"></i>Ingreso Novedad</a>
            </li>
            <?php endif;?>
		</ul>
	</div>
	<?php endif;?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">


