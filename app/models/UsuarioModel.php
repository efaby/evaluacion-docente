<?php
require_once(PATH_MODELS."/BaseModel.php");

class UsuarioModel {

	private $pattern = "------";
	
	public function getlistadoUsuario(){		
		$model = new BaseModel();	
		$sql = "select u.*, t.nombre as tipo_usuario_nombre from usuario as u
				inner join tipo_usuario t on u.tipo_usuario_id= t.id		
				where u.eliminado = 0 and tipo_usuario_id !=4";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getUsuario()
	{
		$usuario = $_GET['id'];
		$model = new BaseModel();		
		if($usuario > 0){
			$sql = "select u.*, t.nombre as tipo_usuario_nombre from usuario as u
					inner join tipo_usuario t on u.tipo_usuario_id= t.id
					where u.id = ?";
			$result = $model->execSql($sql, array($usuario));
			$result->password = $result->password1 = $this->pattern;
			$result->identificacion = $result->cedula;
		} else {
			$result = (object) array('id'=>0,'password'=>'', 'password1'=>'','identificacion' =>'','nombres'=>'','apellidos'=>'','tipo_usuario_id'=>0,'email'=>'');			
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
		$sql = "update usuario set eliminado = 1 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($usuario),false,true);
	}

	public function getCatalogo($tabla, $where=null){
		$model = new BaseModel();	
		return $model->getCatalogo($tabla, $where);
	}	
	
	public function getUsuarioPorCedula($cedula,$id){
		$model =  new BaseModel();
		$sql = "select * from usuario where cedula = ? and id <> ? and eliminado=0";
		return $model->execSql($sql, array($cedula,$id));
	}
}
