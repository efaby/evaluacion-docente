<?php
require_once (PATH_MODELS . "/EvaluacionEstudianteModel.php");

class EvaluacionEstudianteController {
	
	public function listar() {
		$model = new EvaluacionEstudianteModel();
		$datos = $model->getlistadoEvaluacionesbyEstudiante($_SESSION['SESSION_USER']->usuario_id);
		$message = "";
		require_once PATH_VIEWS."/EvaluacionEstudiante/view.list.php";
	}

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

	///////////////////////
	
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
	
	public function listarEvalPreg(){
		$model = new EvaluacionModel();
		$evaluacion = $model->getEvaluacion();
		$items = $model->getlistaEvalPreguntas();
		$message = "";
		require_once PATH_VIEWS."/Evaluacion/view.listeval.php";
	}
	
	public function listarPreguntas(){
		$eval_id= $_GET['id'];
		$model = new PreguntaModel();
		$preguntas = $model->getlistadoPreguntas();
		$message = "";
		require_once PATH_VIEWS."/Evaluacion/view.listpreguntas.php";
	}
	
	public function guardareval() {
		$item ['evaluacion_id'] = $_POST ['eval_id'];
		$preguntas_id  = $_POST ['pregunta_id'];
		$model = new EvaluacionModel();
		$preguntas_eval = $this->validarPreguntas($item ['evaluacion_id'], $preguntas_id);
		try {
			foreach ($preguntas_eval as $preg){
				$item ['pregunta_id'] = $preg;
				$datos = $model->saveEvaluacionPreg($item);
			}
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listarEvalPreg/".$item ['evaluacion_id']);
	}
	
	public function validarPreguntas($evaluacion, $preguntas){
		$model = new EvaluacionModel();
		$preguntas_evaluacion = [];
		$array = $model->getPreguntasVal($evaluacion);		
		foreach ($array as $preg){
			$preguntas_evaluacion[] = $preg->id;
		}
		$preguntas_evaluacion = array_diff($preguntas, $preguntas_evaluacion);
		return $preguntas_evaluacion;
	}
	
	public function eliminarPreguntaEval() {
		$model = new EvaluacionModel();
		$item = $_GET['id'];
		$arrayval = explode('-', $item);		
		try {
			$datos = $model->delPreguntaEvaluacion($arrayval[0]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] =  "Existen datos relacionados.";
			//$e->getMessage ();
		}
		header ( "Location: ../listarEvalPreg/".$arrayval[1] );
	}
	
}