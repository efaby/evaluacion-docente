<?php
require_once(PATH_MODELS."/BaseModel.php");

class EvaluacionEstudianteModel {

	public function getlistadoEvaluacionesbyEstudiante($estudianteId){		
		$model = new BaseModel();	
		$sql = "SELECT mt.*, me.fecha_evaluacion, me.matricula_evaluacion_id, c.nombre as curso, e.nombre as especialidad FROM evaluacion.matricula  as m
				inner join matricula_evaluacion as me on me.matricula_id = m.matricula_id
				inner join materia_periodo as mp on mp.materia_periodo_id = m.materia_periodo_id
				inner join periodo as p on p.periodo_id =  mp.periodo_id
				inner join materia as mt on mt.materia_id = mp.materia_id
				inner join curso as c on c.curso_id = mt.curso_id
				inner join especialidad as e on e.especialidad_id = c.especialidad_id
				where p.estado = 1 and m.usuario_id = ".$estudianteId;		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getEvaluacion()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select *, evaluacion_id as id from evaluacion where estado=1
					and evaluacion_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function saveEvaluacion($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'evaluacion');
	}
	
	public function delEvaluacion(){
		$itemId = $_GET['id'];
		$sql = "update evaluacion set estado = 0 where evaluacion_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
	
	public function getlistaEvalPreguntas(){
		$itemId = $_GET['id'];
		$model = new BaseModel();
		$sql ="SELECT evaluacion_pregunta_id as id,evaluacion_id,p.pregunta_id, nombre as pregunta_nombre FROM evaluacion_pregunta ep
			   INNER JOIN pregunta p on ep.pregunta_id = p.pregunta_id 
			   WHERE evaluacion_id=?";
		return $model->execSql($sql, array($itemId),true);		
	}
	
	public function saveEvaluacionPreg($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'evaluacion_pregunta');
	}
	
	public function getPreguntasVal($evaluacion){
		$model = new BaseModel();
		$sql = "select e.pregunta_id as id FROM evaluacion_pregunta e WHERE evaluacion_id=".$evaluacion;
		return $model->execSql($sql, array(),true);
	}
	
	public function delPreguntaEvaluacion($itemId){
		$sql = "delete from evaluacion_pregunta where evaluacion_pregunta_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}