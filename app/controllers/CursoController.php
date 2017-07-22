<?php
require_once (PATH_MODELS . "/CursoModel.php");

class CursoController {
	
	public function listar() {
		$model = new CursoModel();
		$datos = $model->getlistadoCurso();
		$message = "";
		require_once PATH_VIEWS."/Curso/view.list.php";
	}
	
	public function editar(){
		$model = new CursoModel();
		$item = $model->getCurso();
		$secciones = $model->getSecciones();
		if($item->especialidad_id != null){
			$especialidades = $model->getEspecialidades($item->especialidad_id);
		}
		$message = "";
		require_once PATH_VIEWS."/Curso/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		$item ['especialidad_id'] = $_POST ['especialidad_id'];
		$item ['descripcion'] = $_POST ['descripcion'];
		
		$model = new CursoModel();
		try {
			$datos = $model->saveCurso($item);
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new CursoModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delCurso();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function getEspecialidadesSelect(){
		$model = new CursoModel();
		$id = $_POST['id'];
		$opciones = $model->getEspecialidades($id);
		echo '<option value="0">Seleccionar</option>';
		foreach ($opciones as $opcion) {
			echo '<option value="'.$opcion->id.'">'.$opcion->nombre.'</option>';
		}		
	}
}