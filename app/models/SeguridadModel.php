<?php
require_once(PATH_MODELS."/BaseModel.php");

/**
 * Modelo para modulo de Usuarios
 * 
 *
 */
class SeguridadModel {

	public function validarUsuario($login, $password){
		$model = new BaseModel();
		$sql = "select u.usuario_id, u.nombres, u.apellidos, u.email, u.tipo_usuario_id
				from usuario as u
				where u.cedula= '".$login."' and u.password = '".md5($password)."' and u.estado = 1 ";
	
		return $model->execSql($sql, array($login,$password));
	}
	
	public function cambiarContrasena($passwd,$user){
		$sql = "update usuario set password = md5('".$passwd."') where id = ".$user;
		$model =  new BaseModel();
		return $model->execSql($sql, array($passwd,$user),false,true);
	}
	
	
}
