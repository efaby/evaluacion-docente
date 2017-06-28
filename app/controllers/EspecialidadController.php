<?php
require_once (PATH_MODELS . "/EspecialidadModel.php");

class EspecialidadController {
	
	public function listar() {
		$model = new EspecialidadModel();
		$datos = $model->getlistadoEspecialidad();
		$message = "";
		require_once PATH_VIEWS."/Especialidad/view.list.php";
	}
	
	public function editar(){
		$model = new EspecialidadModel();
		$item = $model->getEspecialidad();		
		$secciones = $model->getSecciones();
		$message = "";
		require_once PATH_VIEWS."/Especialidad/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		$item ['seccion_id'] = $_POST ['seccion_id'];
		$item ['descripcion'] = $_POST ['descripcion'];
		
		$model = new EspecialidadModel();
		try {
			$datos = $model->saveEspecialidad( $item );
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new EspecialidadModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delSeccion();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}	
}