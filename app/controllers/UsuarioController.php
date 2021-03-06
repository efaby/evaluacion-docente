<?php
require_once (PATH_MODELS . "/UsuarioModel.php");



class UsuarioController {
	
	public function listar() {
		$model = new UsuarioModel();
		$datos = $model->getlistadoUsuario();
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.list.php";
	}
	
	public function editar(){
		$model = new UsuarioModel();
		$item = $model->getUsuario();	
		$tipos = $model->getCatalogo('tipo_usuario');	
		$especialidades = $model->getCatalogo('area', ' where estado = 1');	
		$disabled = "display: none;";
		if($item->tipo_usuario_id == 2) {
			$disabled = "";
		}
		$message = "";
		require_once PATH_VIEWS."/Usuario/view.form.php";
	}
	
	public function guardar() {		
		$usuario ['id'] = $_POST ['id'];
		$usuario ['tipo_usuario_id'] = $_POST ['tipo_usuario_id'];
		$usuario ['cedula'] = $_POST ['identificacion'];		
		$usuario ['nombres'] = $_POST ['nombres'];
		$usuario ['apellidos'] = $_POST ['apellidos'];
		$usuario ['password'] = $_POST ['password'];		
		$usuario ['email'] = $_POST ['email'];	
		$usuario ['direccion'] = $_POST ['direccion'];
		$usuario ['telefono'] = $_POST ['telefono'];
		$usuario ['celular'] = $_POST ['celular'];

		if($usuario ['tipo_usuario_id'] == 2) {
			$usuario ['especialidad_id'] = $_POST ['especialidad_id'];
		}
		
		$model = new UsuarioModel();
		try {
			$datos = $model->saveUsuario( $usuario );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new UsuarioModel();
		try {
			$usuario = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->usuario_id;
			if($usuario <> $id_sesion){
				$datos = $model->delUsuario();
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			}
			else{
				$_SESSION ['message'] = "Usuario activo, no se puede eliminar.";
			}
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function getUsuarioByIde() {
		$cedula = $_POST['identificacion'];
		$id = $_POST['id'];
		$model = new UsuarioModel();
		$persona = $model->getusuarioPorCedula($cedula,$id);
		if(isset($persona) && $persona != null){
			$isAvailable = false;
		}
		else{
			$isAvailable = true;
		}
		
		echo json_encode(array(
				'valid' => $isAvailable,));		
	}
	
}
