<?php
require_once (PATH_MODELS . "/PreguntaModel.php");

class PreguntaController {
	
	public function listar() {
		$model = new PreguntaModel();
		$datos = $model->getlistadoPreguntas();
		$message = "";
		require_once PATH_VIEWS."/Pregunta/view.list.php";
	}
	
	public function editar(){
		$model = new PreguntaModel();
		$item = $model->getPregunta();
		$message = "";
		require_once PATH_VIEWS."/Pregunta/view.form.php";
	}
	
	public function guardar() {
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];
		$item ['descripcion'] = $_POST ['descripcion'];
		$item ['unica'] = $_POST ['unica'] ? $_POST ['unica'] : 0;	
		$model = new PreguntaModel();
		try {
			$datos = $model->savePregunta($item);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new PreguntaModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delPregunta();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
}