<?php
require_once(PATH_MODELS."/BaseModel.php");

class EvaluacionEstudianteModel {

	public function getlistadoEvaluacionesbyEstudiante($estudianteId){		
		$model = new BaseModel();	
		$sql = "SELECT mt.*, me.fecha_evaluacion, me.matricula_evaluacion_id, c.nombre as curso, e.nombre as especialidad, p.nombre as periodo 
				FROM matricula  as m
				inner join matricula_evaluacion as me on me.matricula_id = m.matricula_id
				inner join materia_periodo as mp on mp.materia_periodo_id = m.materia_periodo_id
				inner join periodo as p on p.periodo_id =  mp.periodo_id
				inner join materia as mt on mt.materia_id = mp.materia_id
				inner join curso as c on c.curso_id = mt.curso_id
				inner join especialidad as e on e.especialidad_id = c.especialidad_id
				where p.estado=1 and m.usuario_id = ".$estudianteId ." 
				order by m.matricula_id desc";		
		return $model->execSql($sql, array(),true);
	}	

	public function getlistadoPreguntasEvaluacion($itemId){	

		$model = new BaseModel();	
		$sql = "SELECT  p.*, ep.evaluacion_pregunta_id FROM matricula_evaluacion as me 
				inner join evaluacion_pregunta as ep on ep.evaluacion_id = me.evaluacion_id
				inner join pregunta as p on p.pregunta_id = ep.pregunta_id
				where me.matricula_evaluacion_id = ".$itemId;		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getRespuestas(){
		$model = new BaseModel();
		$sql = "select * FROM respuesta where respuesta_id <= 4";
		return $model->execSql($sql, array(),true);
	}

	public function getEvaluacion($itemId){
		$model = new BaseModel();
		$sql = "select ev.nombre as evaluacion, c.nombre as curso, e.nombre as especialidad, mt.nombre as materia, u.nombres, u.apellidos
				FROM matricula_evaluacion as me 
				inner join evaluacion as ev on ev.evaluacion_id =  me.evaluacion_id
				inner join matricula as m on m.matricula_id = me.matricula_id
				inner join materia_periodo as mp on mp.materia_periodo_id = m.materia_periodo_id
				inner join periodo as p on p.periodo_id =  mp.periodo_id
				inner join materia as mt on mt.materia_id = mp.materia_id
				inner join curso as c on c.curso_id = mt.curso_id
				inner join usuario as u on u.usuario_id = mp.docente_id
				inner join especialidad as e on e.especialidad_id = c.especialidad_id
				where p.estado=1 and me.matricula_evaluacion_id = ".$itemId;
		return $model->execSql($sql, array(),true);
	}

	public function saveEvaluacion($items){
		$model = new BaseModel();
		foreach ($items as $item) {
			$model->saveDatos($item,'respuesta_evaluacion');
		}
	}

	public function updateMatriculaEvaluacion($itemId){
		$sql = "update matricula_evaluacion set fecha_evaluacion = now() where matricula_evaluacion_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}

	
}