<?php
require_once(PATH_MODELS."/BaseModel.php");

class EvaluacionModel {

	public function getlistadoEvaluaciones(){		
		$model = new BaseModel();	
		$sql = "select *, evaluacion_id as id from evaluacion where estado=1";		
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
}