<?php
require_once (PATH_MODELS . "/EvaluacionDocenteModel.php");

class EvaluacionDocenteController {
	
	public function listar() {
		$model = new EvaluacionDocenteModel();
		$datos = $model->getlistadoDocentesAEvaluar($_SESSION['SESSION_USER']->usuario_id);
		$message = "";
		require_once PATH_VIEWS."/EvaluacionDocente/view.list.php";
	}

	public function evaluar() {
		$itemId = $_GET['id'];	
		$model = new EvaluacionDocenteModel();
		$preguntas = $model->getlistadoPreguntasEvaluacion($itemId);
		$evaluacion = $model->getEvaluacion($itemId)[0];
		$respuestas = $model->getRespuestas();
		$message = "";
		require_once PATH_VIEWS."/EvaluacionDocente/view.evaluar.php";
	}

	public function guardarEvaluacion() {	
		$model = new EvaluacionDocenteModel();
		$docente_evaluacion_id = $_POST ['docente_evaluacion_id'];

		$preguntas = $model->getlistadoPreguntasEvaluacion($docente_evaluacion_id);
		$resultado = array();
		foreach ($preguntas as $item) {
			$respuesta = $_POST ['respuesta'.$item->evaluacion_pregunta_id];
			$resp = explode("-", $respuesta);
			$datos['id'] = 0;
			$datos['respuesta_id'] = $resp[0];
			$datos['valor'] = $resp[1];
			$datos['evaluacion_pregunta_id'] = $item->evaluacion_pregunta_id;
			$datos['docente_evaluacion_id'] = $docente_evaluacion_id;

			$resultado[] = $datos;
		}

		
		try {
			$model->saveEvaluacion($resultado);
			$model->updateDocenteEvaluacion($docente_evaluacion_id);
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}