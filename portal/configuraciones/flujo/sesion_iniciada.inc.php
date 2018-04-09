<?php
class control_sesion{
//CREAR
	public static function iniciar_sesion($id, $alias, $email){
		if (session_id()== "") {
			session_start();
		}
		$_SESSION['id_usuario']=$id;
		$_SESSION['alias_usuario']=$alias;
		$_SESSION['email_usuario']=$email;
		$_SESSION['estado_Hllave']='NegadOHlymboO';
	}

	public static function estado_Hllave($estado){
		$_SESSION['estado_Hllave']=$estado;
	}
	public static function email_usuario($email){
		$_SESSION['email_usuario']=$email;
	}

//CERRAR
	public static function cerrar_sesion(){
		if (session_id()== "") {
			session_start();
		}
		if (isset($_SESSION['id_usuario'])) {
			unset($_SESSION['id_usuario']);
		}
		if (isset($_SESSION['alias_usuario'])) {
			unset($_SESSION['alias_usuario']);
		}
		if (isset($_SESSION['email_usuario'])) {
			unset($_SESSION['email_usuario']);
		}
		if (isset($_SESSION['estado_Hllave'])) {
			unset($_SESSION['estado_Hllave']);
		}
		session_destroy();
	}

//FLUJO
	public static function sesion_iniciada(){
		if (session_id()== "") {
			session_start();
		}
		if (isset($_SESSION['id_usuario']) && isset($_SESSION['alias_usuario']) && isset($_SESSION['email_usuario'])) {
			return true;
		}else{
			return false;
		}
	}

	public static function sesion_email(){
		if (session_id()== "") {
			session_start();
		}
		if (isset($_SESSION['email_usuario'])) {
			return true;
		}else{
			return false;
		}
	}

//DATOS
	public function mi_acceso(){
		if (session_id()== "") {
			session_start();
		}
		return $_SESSION['estado_Hllave'];
	}

	public function mi_id(){
		if (session_id()== "") {
			session_start();
		}
		return $_SESSION['id_usuario'];
	}

	public function mi_usuario(){
		if (session_id()== "") {
			session_start();
		}
		return $_SESSION['alias_usuario'];
	}

	public function mi_email(){
		if (session_id()== "") {
			session_start();
		}
		return $_SESSION['email_usuario'];
	}
}