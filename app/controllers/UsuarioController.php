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
		$where=	" where id <> 4";
		$tipos = $model->getCatalogo('tipo_usuario', $where);		
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
		
		$model = new UsuarioModel();
		try {
			$datos = $model->saveUsuario( $usuario );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			if($_POST ['id']){
				require_once (PATH_MODELS . "/AuditoriaModel.php");
				// registro Auditoria
				$log = new AuditoriaModel();
				$log->saveAuditoria($_SESSION['SESSION_USER']->nombres." ".$_SESSION['SESSION_USER']->apellidos, $_SESSION['SESSION_USER']->tipo_nombre,'Ingreso de nuevo Usuario"'.$_POST ['identificacion'].'"');
			}
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new UsuarioModel();
		try {
			$usuario = $_GET['id'];
			$id_sesion = $_SESSION['SESSION_USER']->id;
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
