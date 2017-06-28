<?php
require_once (PATH_MODELS . "/SeccionModel.php");

class SeccionController {
	
	public function listar() {
		$model = new SeccionModel();
		$datos = $model->getlistadoSeccion();
		$message = "";
		require_once PATH_VIEWS."/Seccion/view.list.php";
	}
	
	public function editar(){
		$model = new SeccionModel();
		$item = $model->getSeccion();			
		$message = "";
		require_once PATH_VIEWS."/Seccion/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		$item ['descripcion'] = $_POST ['descripcion'];
		
		$model = new SeccionModel();
		try {
			$datos = $model->saveSeccion( $item );
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new SeccionModel();
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