<?php
require_once(PATH_MODELS."/BaseModel.php");

class PeriodoModel {

	public function getlistadoPeriodo(){		
		$model = new BaseModel();	
		$sql = "select * from periodo		
				where estado = 1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getPeriodo()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select * from periodo where id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'');			
		}		
		return $result;
	}
	
	public function savePeriodo($item){
		$model = new BaseModel();
		return $model->saveDatos($item,'periodo');
	}
	
	public function delPeriodo(){
		$itemId = $_GET['id'];
		$sql = "update periodo set estado = 0 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}
