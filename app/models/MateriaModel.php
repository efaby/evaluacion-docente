<?php
require_once(PATH_MODELS."/BaseModel.php");

class MateriaModel {

	public function getlistadoMateria(){		
		$model = new BaseModel();	
		$sql = "select materia.*, curso.nombre as curso from materia		
				inner join curso on materia.curso_id = curso.id
				where materia.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateria()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select materia.*, curso.nombre as curso from materia 
					inner join curso on materia.curso_id = curso.id
					where materia.id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','curso_id'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function getCursos(){
		$model = new BaseModel();
		$sql = "select * from curso where estado=1";
		return $model->execSql($sql, array(),true);
	}
	
	public function saveMateria($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'materia');
	}
	
	public function delMateria(){
		$itemId = $_GET['id'];
		$sql = "update materia set estado = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}