<?php
require_once(PATH_MODELS."/BaseModel.php");

class CursoModel {

	public function getlistadoCurso(){		
		$model = new BaseModel();	
		$sql = "select curso.*, especialidad.nombre as especialidad from curso		
				inner join especialidad on curso.especialidad_id = especialidad.id
				where curso.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getCurso()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select curso.*, especialidad.nombre as especialidad from curso 
					inner join especialidad on curso.especialidad_id = especialidad.id
					where especialidad.id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','especialidad_id'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function getEspecialidades(){
		$model = new BaseModel();
		$sql = "select * from especialidad where estado=1";
		return $model->execSql($sql, array(),true);
	}
	
	public function saveCurso($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'curso');
	}
	
	public function delCurso(){
		$itemId = $_GET['id'];
		$sql = "update curso set estado = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
