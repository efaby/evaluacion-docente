<?php
require_once(PATH_MODELS."/BaseModel.php");

class SeccionModel {

	public function getlistadoSeccion(){		
		$model = new BaseModel();	
		$sql = "select *, seccion_id as id from seccion		
				where estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getSeccion()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select *,seccion_id as id from seccion where seccion_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'');			
		}		
		return $result;
	}
	
	public function saveSeccion($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'seccion');
	}
	
	public function delSeccion(){
		$itemId = $_GET['id'];
		$sql = "update seccion set estado = 0 where seccion_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
