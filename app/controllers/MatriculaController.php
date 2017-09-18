<?php
require_once (PATH_MODELS . "/MatriculaModel.php");
require_once (PATH_MODELS . "/CursoModel.php");
require_once (PATH_MODELS . "/EvaluacionModel.php");

class MatriculaController {
	
	public function listar() {
		$model = new MatriculaModel();
		$datos = $model->getlistadoEstudiantes();
		$message = "";
		require_once PATH_VIEWS."/Matricula/view.list.php";
	}
	
	public function listarMaterias(){
		$model = new MatriculaModel();
		$estudiante = $model->getEstudianteById();
		$periodo = $model->getPeriodoActivo();
		$items = $model->getMateriaEstudiante();
		$message = "";
		require_once PATH_VIEWS."/Matricula/view.listmat.php";
	}
	
	public function editar(){
		$model = new MatriculaModel();
		$estudiante = $model->getEstudianteById();
		$modelCurso = new CursoModel();
		$secciones = $modelCurso->getSecciones();
		$modelEvaluacion = new EvaluacionModel();
		$evaluaciones = $modelEvaluacion->getlistadoEvaluaciones();
		$message = "";
		require_once PATH_VIEWS."/Matricula/view.form.php";
	}
	
	public function guardar() {		
		$model = new MatriculaModel();
		$materias_periodo = $_POST ['materia_id'];
		$item ['usuario_id'] = $_POST ['estudiante_id'];		
		$item['fecha_registro'] = date("Y-m-d");
		$periodo_id = $model->getPeriodoActivo()->periodo_id;
		
		$matricula['evaluacion_id'] = $_POST ['evaluacion_id'];
		
		$model = new MatriculaModel();
		$materias_periodo = $this->validarMaterias($item ['usuario_id'], $periodo_id,$materias_periodo);
		try {
			foreach ($materias_periodo as $mp){
				$item ['materia_periodo_id'] = $mp;
				$datos[] = $model->saveMateriaEstudiante($item);				
			}
			foreach ($datos as $dato){
				$matricula['matricula_id'] = $dato;				
				$model->saveMatriculaEvaluacion($matricula);
			}
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listarMaterias/".$item ['usuario_id']);
	}
	
	public function validarMaterias($estudiante, $periodo,$mat_matricula){
		$model = new MatriculaModel();
		$materias_matricula = [];
		$array = $model->getMateriasValidas($estudiante, $periodo);
		foreach ($array as $mat){
			$materias_matricula[] = $mat->id;
		}
		$mat_matricula = array_diff($mat_matricula, $materias_matricula );
		return $mat_matricula;	
	}
	
	public function eliminar() {
		$model = new MatriculaModel();
		try {
			$item = $_GET['id'];
			$arrayval = explode('-', $item);
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delMateriaEstudiante($arrayval[0]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] =  "Existen datos relacionados."; 
			//$e->getMessage ();
		}
		header ( "Location: ../listarMaterias/".$arrayval[1] );
	}	
	
	public function obtenerEspecialidades(){
		$model = new CursoModel();
		$id = $_POST['id'];
		$opciones = $model->getEspecialidades($id);
		echo '<option value="0">Seleccionar</option>';
		foreach ($opciones as $opcion) {
			echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
		}
	}
	
	public function obtenerCursos(){
		$model = new MatriculaModel();
		$id = $_POST['id'];
		$opciones = $model->getCursos($id);
		echo '<option value="0">Seleccionar</option>';
		foreach ($opciones as $opcion) {
			echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
		}
	}
	
	
	public function obtenerMaterias(){
		$model = new MatriculaModel();
		$id = $_POST['id'];
		$items = $model->getMateriasByCurso($id);
		if(count($items) >0){
			echo"<table class='table table-striped'>";
			echo"Materias";
			$count = 0;
			foreach ($items as $val){
				if($count == 0){
					echo"<tr>";
				}
				echo"<td><input type='checkbox' name='materia_id[]' value='".$val->id."'> ".$val->nombre."</td>";
				if($count == 2){
					echo"</tr>";
				}
				$count++;
			}			
		}
		else{
			echo "<tr><td colspan=3 align=center>No existe materias en este curso</td></tr>";
		}
		echo"<table>";		
	}

	// Admimnistrativos

	public function listarAdministrativos() {
		$model = new MatriculaModel();
		$datos = $model->getlistadoAdministrativos();
		$message = "";
		require_once PATH_VIEWS."/Matricula/view.listAdministrativos.php";
	}

	public function listarDocentes(){
		$model = new MatriculaModel();
		$administrativo = $model->getAdministrativoById();
		$periodo = $model->getPeriodoActivo();
		$items = $model->getDocentes();
		$message = "";
		require_once PATH_VIEWS."/Matricula/view.listDocentes.php";
	}
}