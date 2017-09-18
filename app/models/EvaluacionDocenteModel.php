<?php
require_once(PATH_MODELS."/BaseModel.php");

class EvaluacionDocenteModel {

	public function getlistadoDocentesAEvaluar($adminId){		
		$model = new BaseModel();	
		$sql = "select de.docente_evaluacion_id, u.nombres, u.apellidos, e.nombre as area, de.fecha_evaluacion from usuario as u 
				inner join docente_evaluacion as de on de.docente_id = u.usuario_id 
				inner join especialidad as e on e.especialidad_id = u.especialidad_id
				where de.administrativo_id= ".$adminId;		
		return $model->execSql($sql, array(),true);
	}	

	public function getlistadoPreguntasEvaluacion($itemId){	

		$model = new BaseModel();	
		$sql = "SELECT  p.*, ep.evaluacion_pregunta_id FROM docente_evaluacion as de 
				inner join evaluacion_pregunta as ep on ep.evaluacion_id = de.evaluacion_id
				inner join pregunta as p on p.pregunta_id = ep.pregunta_id
				where de.docente_evaluacion_id = ".$itemId;		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getRespuestas(){
		$model = new BaseModel();
		$sql = "select * FROM respuesta where respuesta_id > 4";
		return $model->execSql($sql, array(),true);
	}

	public function getEvaluacion($itemId){
		$model = new BaseModel();
		$sql = "select de.docente_evaluacion_id, u.nombres, u.apellidos, e.nombre as especialidad, de.fecha_evaluacion, ev.nombre as evaluacion
				from usuario as u 
				inner join docente_evaluacion as de on de.docente_id = u.usuario_id 
				inner join especialidad as e on e.especialidad_id = u.especialidad_id
				inner join evaluacion as ev on ev.evaluacion_id = de.evaluacion_id 
				where de.docente_evaluacion_id = ".$itemId;
		return $model->execSql($sql, array(),true);
	}

	public function saveEvaluacion($items){
		$model = new BaseModel();
		foreach ($items as $item) {
			$model->saveDatos($item,'respuesta_evaluacion');
		}
	}

	public function updateDocenteEvaluacion($itemId){
		$sql = "update docente_evaluacion set fecha_evaluacion = now() where docente_evaluacion_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}

	
}