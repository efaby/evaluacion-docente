<?php 	
	define('HOSTNAME_DATABASE', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '123456');
	define('DATABASE', 'jwebldco_mantenimiento'); 	 
	define('URL_BASE', '/mantenimiento/');
	define('PATH_MODELS', PATH_ROOT."/app/models");
	define('PATH_CONTROLLERS', PATH_ROOT."/app/controllers");
	define('PATH_VIEWS', PATH_ROOT."/public/views");
	define('PATH_BASE', "/mantenimiento");	
	define('PATH_CSS', PATH_BASE."/public/web/css");
	define('PATH_JS', PATH_BASE."/public/web/js");
	define('PATH_IMAGES', PATH_BASE."/public/web/images");
	define('PATH_TEMPLATE', PATH_ROOT."/public/template");
	define('PATH_HELPERS', PATH_ROOT."/lib");
	define('PATH_FILES', PATH_ROOT."/public/web/files/");
	define('PATH_DUMP', 'D:\\xampp\\mysql\\bin\\mysqldump.exe ');
	define('PATH_DUMP_L', 'mysqldump');
	
	define('GUSER', 'sysmantauto@gmail.com'); // GMail username
	define('GPWD', 'sysmantauto2016'); // GMail password
	define('SENDEMAIL',1);
	
	define('PUBLIC_URLS', serialize(array('Seguridadlogin','Seguridadvalidar','Seguridaderror404','Seguridaderror403','Seguridaderror500')));
	
	define('PRIVATE_URLS', serialize(
			array(
			'ADMIN_URLS' => array('Seguridad','Parametro','Grado','Unidad','Tipo','Usuario','TipoNovedad'),
			'SUPER_URLS' => array('Seguridad','Persona','Confronta'),
			'RANCH_URLS' => array('Seguridad','ExtraConfronta'),
			'AMANA_URLS' => array('Seguridad','Persona','Confronta','Novedad','Unidadconfigurar','UnidadguardarConfiguracion','Consumo')
			)));	
	
?>