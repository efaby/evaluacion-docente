<?php
require_once(PATH_MODELS."/BaseModel.php");

class EspecialidadModel {

	public function getlistadoEspecialidad(){		
		$model = new BaseModel();	
		$sql = "select especialidad.*, especialidad.especialidad_id as id,seccion.nombre as seccion 
				from especialidad		
				inner join seccion on especialidad.seccion_id = seccion.seccion_id
				where especialidad.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getEspecialidad()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select especialidad.*,especialidad.especialidad_id as id, seccion.seccion_id from especialidad 
					inner join seccion on especialidad.seccion_id = seccion.seccion_id
					where especialidad.especialidad_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','seccion_id'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function getSecciones(){
		$model = new BaseModel();
		$sql = "select *, seccion_id as id from seccion where estado=1";
		return $model->execSql($sql, array(),true);
	}
	
	public function saveEspecialidad($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'especialidad');
	}
	
	public function delEspecialidad(){
		$itemId = $_GET['id'];
		$sql = "update especialidad set estado = 0 where especialidad_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
