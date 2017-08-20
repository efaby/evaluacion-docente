<?php
require_once(PATH_MODELS."/BaseModel.php");

class UsuarioModel {

	private $pattern = "------";
	
	public function getlistadoUsuario(){		
		$model = new BaseModel();	
		$sql = "select u.*, u.usuario_id as id,t.nombre as tipo_usuario_nombre from usuario as u
				inner join tipo_usuario t on u.tipo_usuario_id= t.tipo_usuario_id		
				where u.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getUsuario()
	{
		$usuario = $_GET['id'];
		$model = new BaseModel();		
		if($usuario > 0){
			$sql = "select u.usuario_id as id, u.*, t.nombre as tipo_usuario_nombre from usuario as u
					inner join tipo_usuario t on u.tipo_usuario_id= t.tipo_usuario_id
					where u.usuario_id = ?";
			$result = $model->execSql($sql, array($usuario));
			$result->password = $result->password1 = $this->pattern;
			$result->identificacion = $result->cedula;
		} else {
			$result = (object) array('id'=>0,'password'=>'', 'password1'=>'','identificacion' =>'','nombres'=>'','apellidos'=>'','tipo_usuario_id'=>0,'email'=>'','direccion'=>'','telefono'=>'','celular'=>'');			
		}
		
		return $result;
	}
	
	public function saveUsuario($usuario){
		if((($usuario['id']>0) && ($usuario['password']!=$this->pattern))||($usuario['id']==0)){
			$usuario['password'] =  md5($usuario['password']);
		} else {
			unset($usuario['password']);
		}
		$model = new BaseModel();
		return $model->saveDatos($usuario,'usuario');
	}
	
	public function delUsuario(){
		$usuario = $_GET['id'];
		$sql = "update usuario set estado = 0 where usuario_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($usuario),false,true);
	}

	public function getCatalogo($tabla, $where=null){
		$model = new BaseModel();
		$tipo = $model->getCatalogo($tabla, $where);
		return $tipo;
	}	
	
	public function getUsuarioPorCedula($cedula,$id){
		$model =  new BaseModel();
		$sql = "select *, usuario_id as id from usuario where cedula = ? and usuario_id <> ? and estado = 1";
		return $model->execSql($sql, array($cedula,$id));
	}
}
