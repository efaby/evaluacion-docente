<?php
define("PATH_ROOT", __DIR__);

require_once(PATH_ROOT . "/app/config/config.inc");

session_start();
if(isset($_GET['action'])){
	$redirect = ($_GET['action']!='')?$_GET['action']:"listar";
}

if(!isset($app)){
	$app = 'Seguridad';
	$redirect = "login";
}


$urls = unserialize(PUBLIC_URLS);
if (!isset($_SESSION['SESSION_USER'])){	
	if(!in_array($app.$redirect, $urls)){
		header("location: ".URL_BASE);
		exit();
	}	
} /* else {	
	$urls = unserialize(PRIVATE_URLS);
	if((!in_array($app, $urls[$_SESSION['SESSION_USER']->clave]))&&(!in_array($app.$redirect, $urls[$_SESSION['SESSION_USER']->clave]))){
		$app = 'Seguridad';
		$redirect = "error403";
	}
}
	*/

require_once(PATH_CONTROLLERS."/".$app."Controller.php");
$controllerName = $app."Controller";
$controller = new $controllerName();
if(!method_exists ( $controller , $redirect )){
	$controller = new SeguridadController();
	$redirect = "error404";
} 
$controller->$redirect();
?>