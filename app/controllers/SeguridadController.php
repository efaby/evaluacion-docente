<?php
require_once(PATH_MODELS."/SeguridadModel.php");
require_once (PATH_HELPERS. "/Email.php");

/**
 * Controlador de Usuarios
 *
 */
class SeguridadController {
	
	public function login(){
		$model = new SeguridadModel();
		$tipos = $model->getTipos();
		require_once PATH_VIEWS."/Seguridad/view.login.php";
	}
	
	public function validar(){

		$model = new SeguridadModel();
		$login = $this->cleanVariables($_POST['username']);
		$password = $this->cleanVariables($_POST['password']);
		$login = $this->cleanVariables($_POST['username']);
		$tipo = $this->cleanVariables($_POST['tipousuario']);
		
		$result= $model->validarUsuario($login, $password,$tipo);
		$response['band'] = 0;
		if($result)
		{
			session_regenerate_id();	
			$acceso = $model->getAcceso($result->tipo);
			$resultArray = array();		
			
			foreach ($acceso as $item){
				$resultArray[] = $item->accion;
			}			
			$result->urls = $resultArray;
			$result->links = $acceso;
			$_SESSION['SESSION_USER'] = $result;		
			session_write_close();
			$url = $_SERVER["REQUEST_URI"];			
			$response['data'] = (strpos($url, '/Seguridad/mostrar/'))?'../':'Seguridad/'.'inicio/';
			if($result->tipo == 2){				
				$this->validarMantenimiento();
			}			
				
		} else {
			$response['data'] = 'Credenciales Inválidas.';
			$response['band'] = 1;
		}
		echo json_encode($response);
		exit();
	}
	
	private function cleanVariables($str){
		$str = @trim($str);
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return addslashes($str);
	}
	
	public function inicio(){
		require_once PATH_VIEWS."/Seguridad/view.home.php";
	}
	
	public function cerrarSesion(){
		session_start();
		unset($_SESSION["SESSION_USER"]);
		session_destroy();
		header("Location: ../../");
	}
	
	public function cambiarContrasena(){
		require_once PATH_VIEWS."/Seguridad/view.form.php";
	}
	
	public function guardarContrasena(){
		
		$passwd["p2"] = $_POST['password'];
		$passwd["p3"] = $_POST['password1'];
		$user = $_SESSION['SESSION_USER']->id;		
		
		try {
			$model = new SeguridadModel();
			$model->cambiarContrasena($passwd["p2"],$user);
			$_SESSION['message'] = "Su contraseña ha sido cambiada exitosamente.";
		} catch (Exception $e){
			$_SESSION['message'] = $e->getMessage();
		}		
	
		header("Location: ../cambiarContrasena/");
	}
	
	public function error404(){
		require_once PATH_VIEWS."/Seguridad/view.error404.php";
	}
	
	public function error403(){
		require_once PATH_VIEWS."/Seguridad/view.error403.php";
	}
	
	public function error500(){
		require_once PATH_VIEWS."/Seguridad/view.error500.php";
	}
	
	private function validarMantenimiento(){
		$model = new SeguridadModel();
		$planes = $model->getPlanes();
	
		foreach ($planes as $item){
			$numero = $item->frecuencia_numero;
			if($item->frecuencia_id==3){
				$numero = $item->frecuencia_numero * 12;
			}
			$tope = strtotime ( '+'.$numero.' month' , strtotime ( $item->fecha_inicio ) ) ;
			$hoy = strtotime ( date('Y-m-d'));

			if($tope <= $hoy){
				$orden = $model->getOrdenPlan( $item->id );
				if(!is_object($orden)){
					$orden['id'] = 0;
					$orden['activo_plan_id'] = $item->id;
					$orden['fecha_emision'] = date('Y-m-d');
					$orden['tecnico_asignado'] = $item->usuario_id;
					$model->saveOrden($orden);
				}
				if(SENDEMAIL){
					$email = new Email();
					$email->sendNotificacionOrden($item->nombres ." ".$item->apellidos, $item->email, $item->tarea, $item->maquina ,"http://" . $_SERVER['HTTP_HOST'] . PATH_BASE);
				}
			} else {
				$tope = strtotime ( '-'.$item->alerta_numero.' day' , $tope);
				if($tope <= $hoy){
					if(SENDEMAIL){
						$email = new Email();
						$email->sendNotificacionOrdenAlerta($item->nombres ." ".$item->apellidos, $item->email, $item->tarea, $item->maquina );
					}
				}
			}
		}
	
	}	

}