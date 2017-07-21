<?php
require_once(PATH_MODELS."/BaseModel.php");

class CursoModel {

	public function getlistadoCurso(){		
		$model = new BaseModel();	
		$sql = "select curso.*, curso.curso_id as id,especialidad.nombre as especialidad from curso		
				inner join especialidad on curso.especialidad_id = especialidad.especialidad_id
				where curso.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getCurso()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select curso.*, curso_id as id,especialidad.nombre as especialidad from curso 
					inner join especialidad on curso.especialidad_id = especialidad.especialidad_id
					where curso.curso_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','especialidad_id'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function getEspecialidades(){
		$model = new BaseModel();
		$sql = "select *, especialidad_id as id from especialidad where estado=1";
		return $model->execSql($sql, array(),true);
	}
	
	public function saveCurso($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'curso');
	}
	
	public function delCurso(){
		$itemId = $_GET['id'];
		$sql = "update curso set estado = 0 where curso_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
