<?php
require_once(PATH_MODELS."/BaseModel.php");

class MatriculaModel {
	public function getlistadoEstudiantes(){		
		$model = new BaseModel();	
		$sql = "select *, usuario_id as id
				from usuario
				where tipo_usuario_id=3";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateriaEstudiante()
	{
		$item = $_GET['id'];
		$model = new BaseModel();		
		if($item > 0){
			$sql = "select distinct(mp.materia_id) as id,mp.materia_periodo_id,ma.matricula_id,
					m.nombre as materia_nombre, c.nombre as curso_nombre
					from matricula as ma
					inner join  materia_periodo as mp on ma.materia_periodo_id = mp.materia_periodo_id
					inner join materia as m ON m.materia_id = mp.materia_id
					inner join curso as c ON c.curso_id = m.curso_id
					where ma.usuario_id=".$item;
			$result = $model->execSql($sql, array(), true);
		}		
		return $result;
	}
	
	public function saveMateriaEstudiante($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'matricula');
	}
	
	public function delMateriaEstudiante(){
		$itemId = $_GET['id'];
		$sql = "delete from matricula where matricula_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);		
	}
	
	
	public function getEstudianteById(){
		$model = new BaseModel();
		$itemId = isset($_POST['id'])?$_POST['id']:$_GET['id'];
		$sql = "select *, usuario_id as id
				from usuario where tipo_usuario_id=3 and usuario_id=".$itemId;
		return $model->execSql($sql, array(),true)[0];
	}
	
	public function getPeriodoActivo(){
		$model = new BaseModel();
		$sql = "select * from periodo
				where estado=1";
		return $model->execSql($sql, array(),true)[0];
	}
	
	public function getCursos($id){
		$model = new BaseModel();
		$sql = "select *, curso_id as id from curso
				where estado=1 and especialidad_id=".$id;
		return $model->execSql($sql, array(),true);
	}
	
	public function getMateriasByCurso($id){
		$model = new BaseModel();
		$sql = "select distinct(materia_periodo_id) as id, m.nombre,m.materia_id
				from materia_periodo as mp
        		inner join materia m ON m.materia_id = mp.materia_id
				where m.curso_id=".$id;
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateriasValidas($estudiante, $periodo){
		$model = new BaseModel();
		$sql = "select m.materia_periodo_id as id 
				from materia_periodo mp
				inner join matricula m on m.materia_periodo_id=mp.materia_periodo_id
				where periodo_id=".$periodo." and  m.usuario_id=".$estudiante;
		return $model->execSql($sql, array(),true);
	}
}