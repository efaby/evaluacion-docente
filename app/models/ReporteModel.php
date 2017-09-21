<?php
require_once(PATH_MODELS."/BaseModel.php");

class ReporteModel {

	public function getlistadoMateriaPeriodo($id){
		$model = new BaseModel();
		$sql = "SELECT mp.materia_periodo_id as id, m.nombre, concat(u.nombres,' ',u.apellidos) as docente, p.nombre as periodo
				FROM materia_periodo mp 
				INNER JOIN periodo p on p.periodo_id = mp.periodo_id
				INNER JOIN materia m on m.materia_id = mp.materia_id
				INNER JOIN usuario u on u.usuario_id = mp.docente_id
				WHERE docente_id=?";
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
		$sql="SELECT * FROM respuesta where estado =1 and respuesta_id <5";
		return $model->execSql($sql, array(),true);
	}
	
	public function getPreguntas($id){
		$model = new BaseModel();
		$sql ="SELECT p.pregunta_id,p.nombre as pregunta_nombre, respuesta_id, count(respuesta_id) as respuesta,
				null as res1, null as res2,null as res3, null as res4, p.unica, DATE_FORMAT(me.fecha_evaluacion, '%d-%m-%Y') as fecha_evaluacion
				FROM 
					matricula m
		        INNER JOIN
		   			matricula_evaluacion me ON me.matricula_id = m.matricula_id
		        INNER JOIN
		   			respuesta_evaluacion re ON re.matricula_evaluacion_id = me.matricula_evaluacion_id
		        INNER JOIN
		   			evaluacion_pregunta ep ON ep.evaluacion_pregunta_id = re.evaluacion_pregunta_id
		        INNER JOIN
		   			pregunta p ON ep.pregunta_id = p.pregunta_id
				WHERE m.materia_periodo_id =? 
				GROUP BY respuesta_id, p.pregunta_id 
				ORDER BY p.pregunta_id";
		return $model->execSql($sql, array($id),true);		
	}
	
	// Administrativo
	public function getlistadoAdminByDocente($id){
		$model = new BaseModel();
		$sql ="SELECT distinct(administrativo_id) as id, nombres,apellidos, p.nombre as periodo
				FROM docente_evaluacion de
				INNER JOIN usuario u ON administrativo_id = u.usuario_id
				inner join periodo as p on p.periodo_id = de.periodo_id
				WHERE docente_id=?";
		return $model->execSql($sql, array($id),true);
	}
	
	public function getRespuestasAdmin(){
		$model = new BaseModel();
		$sql="SELECT * FROM respuesta where estado =1 and respuesta_id >4";
		return $model->execSql($sql, array(),true);
	}
	
	public function getDatosCabeceraAdmin($id){
		$model = new BaseModel();
		$sql ="SELECT p.nombre as periodo_nombre, d.nombres as docente_nombre, d.apellidos as docente_apellido,
				e.nombre as espe_nombre,fecha_evaluacion
				FROM docente_evaluacion de
				INNER JOIN periodo p on p.periodo_id = de.periodo_id
				INNER JOIN usuario d on d.usuario_id = de.docente_id
				INNER JOIN especialidad e on e.especialidad_id = d.especialidad_id
				WHERE administrativo_id=?";
		return $model->execSql($sql, array($id),true);
	}
	
	public function getPreguntasAdmin($id){
		$model = new BaseModel();
		$sql ="SELECT p.pregunta_id,  p.nombre as pregunta_nombre, respuesta_id,
			    count(respuesta_id) as respuesta, null as res1, null as res2,    
			    DATE_FORMAT(de.fecha_evaluacion, '%d-%m-%Y') as fecha_evaluacion
				FROM docente_evaluacion de
			    INNER JOIN respuesta_evaluacion re ON re.docente_evaluacion_id = de.docente_evaluacion_id
			    INNER JOIN evaluacion_pregunta ep ON ep.evaluacion_pregunta_id = re.evaluacion_pregunta_id
			    INNER JOIN pregunta p ON ep.pregunta_id = p.pregunta_id
			WHERE de.administrativo_id = ?
			GROUP BY respuesta_id , p.pregunta_id
			ORDER BY p.pregunta_id";
		return $model->execSql($sql, array($id),true);
	}

	public function getUsuario($id) {
		$model = new BaseModel();
		$sql = "select * from usuario where usuario_id=?";
		return $model->execSql($sql, array($id),true);
	}
}