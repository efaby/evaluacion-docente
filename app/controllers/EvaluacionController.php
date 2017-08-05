<?php
require_once (PATH_MODELS . "/EvaluacionModel.php");

class EvaluacionController {
	
	public function listar() {
		$model = new EvaluacionModel();
		$datos = $model->getlistadoEvaluaciones();
		$message = "";
		require_once PATH_VIEWS."/Evaluacion/view.list.php";
	}
	
	public function editar(){
		$model = new EvaluacionModel();
		$item = $model->getEvaluacion();
		$message = "";
		require_once PATH_VIEWS."/Evaluacion/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		$item ['descripcion'] = $_POST ['descripcion'];
		
		$model = new EvaluacionModel();
		try {
			$datos = $model->saveEvaluacion($item);
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new EvaluacionModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delEvaluacion();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
}