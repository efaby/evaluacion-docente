<?php
require_once (PATH_MODELS . "/ReporteModel.php");

class ReporteController {
	
	public function docente() {
		$model = new EvaluacionEstudianteModel();
		$datos = $model->getlistadoEvaluacionesbyEstudiante($_SESSION['SESSION_USER']->usuario_id);
		$message = "";
		require_once PATH_VIEWS."/EvaluacionEstudiante/view.list.php";
	}
	///////////////////////////////

	public function evaluar() {
		$itemId = $_GET['id'];	
		$model = new EvaluacionEstudianteModel();
		$preguntas = $model->getlistadoPreguntasEvaluacion($itemId);
		$evaluacion = $model->getEvaluacion($itemId)[0];
		$respuestas = $model->getRespuestas();
		$message = "";
		require_once PATH_VIEWS."/EvaluacionEstudiante/view.evaluar.php";
	}

	public function guardarEvaluacion() {	
		$model = new EvaluacionEstudianteModel();
		$matricula_evaluacion_id = $_POST ['matricula_evaluacion_id'];

		$preguntas = $model->getlistadoPreguntasEvaluacion($matricula_evaluacion_id);
		$resultado = array();
		foreach ($preguntas as $item) {
			$respuesta = $_POST ['respuesta'.$item->evaluacion_pregunta_id];
			$resp = explode("-", $respuesta);
			$datos['id'] = 0;
			$datos['respuesta_id'] = $resp[0];
			$datos['valor'] = $resp[1];
			$datos['evaluacion_pregunta_id'] = $item->evaluacion_pregunta_id;
			$datos['matricula_evaluacion_id'] = $matricula_evaluacion_id;

			$resultado[] = $datos;
		}

		
		try {
			$model->saveEvaluacion($resultado);
			$model->updateMatriculaEvaluacion($matricula_evaluacion_id);
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}