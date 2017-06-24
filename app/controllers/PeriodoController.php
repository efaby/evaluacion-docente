<?php
require_once (PATH_MODELS . "/PeriodoModel.php");

class PeriodoController {
	
	public function listar() {
		$model = new PeriodoModel();
		$datos = $model->getlistadoPeriodo();
		$message = "";
		require_once PATH_VIEWS."/Periodo/view.list.php";
	}
	
	public function editar(){
		$model = new PeriodoModel();
		$item = $model->getPeriodo();			
		$message = "";
		require_once PATH_VIEWS."/Periodo/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		
		$model = new PeriodoModel();
		try {
			$datos = $model->savePeriodo( $item );
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new PeriodoModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delPeriodo();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
