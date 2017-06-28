<?php
require_once (PATH_MODELS . "/MateriaModel.php");

class MateriaController {
	
	public function listar() {
		$model = new MateriaModel();
		$datos = $model->getlistadoMateria();
		$message = "";
		require_once PATH_VIEWS."/Materia/view.list.php";
	}
	
	public function editar(){
		$model = new MateriaModel();
		$item = $model->getMateria();		
		$cursos = $model->getCursos();
		$message = "";
		require_once PATH_VIEWS."/Materia/view.form.php";
	}
	
	public function guardar() {		
		$item ['id'] = $_POST ['id'];
		$item ['nombre'] = $_POST ['nombre'];	
		$item ['curso_id'] = $_POST ['curso_id'];
		$item ['descripcion'] = $_POST ['descripcion'];
		
		$model = new MateriaModel();
		try {
			$datos = $model->saveMateria( $item );
			$_SESSION ['message'] = "Datos almacenados correctamente.";		
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new MateriaModel();
		try {
			$item = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
			$datos = $model->delMateria();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}	
}