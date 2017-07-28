<?php
require_once(PATH_MODELS."/BaseModel.php");

class MateriaDocenteModel {
	public function getlistadoDocentes(){		
		$model = new BaseModel();	
		$sql = "select *, usuario_id as id
				from usuario
				where tipo_usuario_id=2";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateriaDocente($periodo)
	{
		$item = $_GET['id'];
		$model = new BaseModel();		
		if($item > 0){
			$sql = "select distinct(mp.materia_id) as id,mp.materia_periodo_id,m.nombre as materia_nombre, c.nombre as curso_nombre
					from materia_periodo as mp
        			inner join materia as m ON m.materia_id = mp.materia_id
        			inner join curso as c ON c.curso_id = m.curso_id
					where mp.estado=1 and mp.docente_id=".$item." and mp.periodo_id=".$periodo;
			$result = $model->execSql($sql, array(), true);
		}		
		return $result;
	}
	
	public function saveMateria($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'materia_periodo');
	}
	
	public function delMateriaDocente(){
		$itemId = $_GET['id'];
		$sql = "update materia_periodo set estado = 0 where materia_periodo_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
	
	
	public function getDocenteById(){
		$model = new BaseModel();
		$itemId = isset($_POST['id'])?$_POST['id']:$_GET['id'];
		$sql = "select *, usuario_id as id
				from usuario where tipo_usuario_id=2 and usuario_id=".$itemId;
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
		$sql = "select * from materia where estado=1 and curso_id=".$id;
		return $model->execSql($sql, array(),true);
	}	
	
	public function getMateriasValidas($docente, $periodo){
		$model = new BaseModel();
		$sql = "select materia_id as id from materia_periodo where estado=1 and periodo_id=".$periodo." and  docente_id=".$docente;
		return $model->execSql($sql, array(),true);
	}
}