<?php
require_once(PATH_MODELS."/BaseModel.php");

class ReporteModel {

	public function getlistadoMateriaPeriodo($id){
		$model = new BaseModel();
		$sql = "SELECT mp.materia_periodo_id as id, m.nombre
				FROM materia_periodo mp 
				INNER JOIN periodo p on p.periodo_id = mp.periodo_id
				INNER JOIN materia m on m.materia_id = mp.materia_id
				WHERE p.estado=1 and docente_id=?";
		return $model->execSql($sql, array($id),true);
	}	
	
	public function getDatosCabecera($id){
		$model = new BaseModel();
		$sql ="SELECT p.nombre as periodo_nombre, m.nombre as materia_nombre,
				d.nombres as docente_nombre, d.apellidos as docente_apellido, c.nombre as curso_nombre,
				e.nombre as espe_nombre, s.nombre as seccion_nombre
				FROM materia_periodo mp 
				INNER JOIN periodo p on p.periodo_id = mp.periodo_id
				INNER JOIN materia m on m.materia_id = mp.materia_id
				INNER JOIN curso c on c.curso_id = m.curso_id
				INNER JOIN especialidad e on e.especialidad_id = c.especialidad_id
				INNER JOIN seccion s on s.seccion_id = e.seccion_id
				INNER JOIN usuario d on d.usuario_id = mp.docente_id
				WHERE materia_periodo_id=?";
		return $model->execSql($sql, array($id),true);
	}
	
	public function getRespuestas(){
		$model = new BaseModel();
		$sql="SELECT * FROM respuesta where estado =1";
		return $model->execSql($sql, array(),true);
	}
	
	public function getPreguntas($id){
		$model = new BaseModel();
		//	and re.matricula_evaluacion_id = me.matricula_evaluacion_id
		$sql ="SELECT p.pregunta_id,p.nombre as pregunta_nombre, respuesta_id, count(respuesta_id) as respuesta,
				null as res1, null as res2,null as res3, null as res4
				FROM matricula m
				INNER JOIN matricula_evaluacion me on me.matricula_id = m.matricula_id
				INNER JOIN evaluacion e on e.evaluacion_id = me.evaluacion_id 
				INNER JOIN evaluacion_pregunta ep on ep.evaluacion_id = e.evaluacion_id 
				INNER JOIN pregunta p on ep.pregunta_id = p.pregunta_id
				INNER JOIN respuesta_evaluacion re on ep.evaluacion_pregunta_id = re.evaluacion_pregunta_id 
				and re.matricula_evaluacion_id = me.matricula_evaluacion_id
				WHERE m.materia_periodo_id =? 
				GROUP BY respuesta_id,p.pregunta_id 
				ORDER BY p.pregunta_id";
		return $model->execSql($sql, array($id),true);		
	}
}