<?php
require_once (PATH_MODELS . "/MateriaDocenteModel.php");
require_once (PATH_MODELS . "/CursoModel.php");

class MateriaDocenteController {
	
	public function listar() {
		$model = new MateriaDocenteModel();
		$datos = $model->getlistadoDocentes();
		$message = "";
		require_once PATH_VIEWS."/MateriaDocente/view.list.php";
	}
	
	public function listarMaterias(){
		$model = new MateriaDocenteModel();
		$docente = $model->getDocenteById();
		$periodo = $model->getPeriodoActivo();
		$items = $model->getMateriaDocente($periodo->periodo_id);
		$message = "";
		require_once PATH_VIEWS."/MateriaDocente/view.listmat.php";
	}
	
	public function editar(){
		$model = new MateriaDocenteModel();
		$docente = $model->getDocenteById();
		$modelCurso = new CursoModel();
		$secciones = $modelCurso->getSecciones();
		$message = "";
		require_once PATH_VIEWS."/MateriaDocente/view.form.php";
	}
	
	public function guardar() {		
		$model = new MateriaDocenteModel();
		$materias = $_POST ['materia_id'];
		$item ['docente_id'] = $_POST ['docente_id'];		
		$item['fecha_registro'] = date("Y-m-d");
		$item['periodo_id'] = $model->getPeriodoActivo()->periodo_id;
		
		$model = new MateriaDocenteModel();
		$materias = $this->validarMaterias($item ['docente_id'], $item['periodo_id'],$materias);
		
		try {
			foreach ($materias as $materia){
				$item ['materia_id'] = $materia;
				$datos = $model->saveMateria( $item );
			}			
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listarMaterias/".$item ['docente_id']);
	}
	
	public function validarMaterias($docente, $periodo, $materias){
		$model = new MateriaDocenteModel();
		$materias_validas = [];
		$materias_periodo = [];
		$array = $model->getMateriasValidas($docente, $periodo);
		foreach ($array as $mat){
			$materias_periodo[] = $mat->id;
		}
		$materias = array_diff($materias, $materias_periodo);
		return $materias;
	}
	
	public function eliminar() {
		$model = new MateriaDocenteModel();
		try {
			$item = $_GET['id'];
			$arrayval = explode('-', $item);
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delMateriaDocente($arrayval[0]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
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
		$model = new MateriaDocenteModel();
		$id = $_POST['id'];
		$opciones = $model->getCursos($id);
		echo '<option value="0">Seleccionar</option>';
		foreach ($opciones as $opcion) {
			echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
		}
	}
	
	
	public function obtenerMaterias(){
		$model = new MateriaDocenteModel();
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
				echo"<td><input type='checkbox' name='materia_id[]' value='".$val->materia_id."'> ".$val->nombre."</td>";
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
}