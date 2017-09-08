<?php
require_once(PATH_MODELS."/BaseModel.php");

class PreguntaModel {

	public function getlistadoPreguntas(){		
		$model = new BaseModel();	
		$sql = "select *, pregunta_id as id from pregunta where estado=1";		
		return $model->execSql($sql, array(),true);
	}	
	
	public function getPregunta()
	{
		$itemId = $_GET['id'];
		$model = new BaseModel();		
		if($itemId > 0){
			$sql = "select *, pregunta_id as id from pregunta where estado=1
					and pregunta_id = ?";
			$result = $model->execSql($sql, array($itemId));
		} else {
			$result = (object) array('id'=>0,'nombre'=>'','descripcion'=>'', 'unica' => 0);			
		}		
		return $result;
	}
	
	public function savePregunta($item){
		$model = new BaseModel();
		if($item['unica'] == 1){
			$sql = "update pregunta set unica = 0 where pregunta_id > 0";
			$model->execSql($sql, array(),false,true);
		}
		return $model->saveDatos($item,'pregunta');
	}
	
	public function delPregunta(){
		$itemId = $_GET['id'];
		$sql = "update pregunta set estado = 0 where pregunta_id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($itemId),false,true);
	}
}