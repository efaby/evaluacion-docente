<?php
require_once (PATH_MODELS . "/EvaluacionEstudianteModel.php");

class EvaluacionEstudianteController {
	
	public function listar() {
		$model = new EvaluacionEstudianteModel();
		$datos = $model->getlistadoEvaluacionesbyEstudiante($_SESSION['SESSION_USER']->usuario_id);
		$message = "";
		require_once PATH_VIEWS."/EvaluacionEstudiante/view.list.php";
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