<?php 	
	define('HOSTNAME_DATABASE', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '123456');
	define('DATABASE', 'evaluacion'); 	 
	define('URL_BASE', '/evaluacion-docente/');
	define('PATH_MODELS', PATH_ROOT."/app/models");
	define('PATH_CONTROLLERS', PATH_ROOT."/app/controllers");
	define('PATH_VIEWS', PATH_ROOT."/public/views");
	define('PATH_BASE', "/evaluacion-docente");	
	define('PATH_CSS', PATH_BASE."/public/web/css");
	define('PATH_JS', PATH_BASE."/public/web/js");
	define('PATH_IMAGES', PATH_BASE."/public/web/images");
	define('PATH_TEMPLATE', PATH_ROOT."/public/template");
	define('PATH_HELPERS', PATH_ROOT."/lib");
	define('PATH_FILES', PATH_ROOT."/public/web/files/");
	
	
	define('PUBLIC_URLS', serialize(array('Seguridadlogin','Seguridadvalidar','Seguridaderror404','Seguridaderror403','Seguridaderror500')));
	

	
?>