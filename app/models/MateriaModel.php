<?php
require_once(PATH_MODELS."/BaseModel.php");

class MateriaModel {

	public function getlistadoMateria(){		
		$model = new BaseModel();	
		$sql = "select materia.*, materia.materia_id as id, curso.nombre as curso from materia		
				inner join curso on materia.curso_id = curso.curso_id
				where materia.estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateria()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select materia.*, materia.materia_id as id, curso.nombre as curso,
					especialidad.especialidad_id,seccion.seccion_id
					from materia 
					inner join curso on materia.curso_id = curso.curso_id
					inner join especialidad on curso.especialidad_id = especialidad.especialidad_id
					inner join seccion on especialidad.seccion_id = seccion.seccion_id
					where materia.materia_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','curso_id'=>'','descripcion'=>'','especialidad_id'=>'','seccion_id'=>'');			
		}		
		return $result;
	}
	
	public function getCursos($id){
		$model = new BaseModel();
		$sql = "select *,curso_id as id from curso where estado=1 and especialidad_id=".$id;
		return $model->execSql($sql, array(),true);
	}
	
	public function saveMateria($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'materia');
	}
	
	public function delMateria(){
		$itemId = $_GET['id'];
		$sql = "update materia set estado = 0 where materia_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
