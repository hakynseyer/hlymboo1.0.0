<?php
	namespace base_ingreso;

class ingreso{

	private $id_ingreso;
	private $ingreso_user;
	private $ingreso_pass;
	private $ingreso_email;
	private $ingreso_estado;

	public function __construct($id, $user, $pass, $email, $estado){
		$this -> id_ingreso = $id;
		$this -> ingreso_user = $user;
		$this -> ingreso_pass = $pass;
		$this -> ingreso_email = $email;
		$this -> ingreso_estado = $estado;
	}

	public function obtener_ID(){
		return $this -> id_ingreso;
	}

	public function obtener_USER(){
		return $this -> ingreso_user;
	}

	public function obtener_PASS(){
		return $this -> ingreso_pass;
	}

	public function obtener_EMAIL(){
		return $this -> ingreso_email;
	}

	public function obtener_ESTADO(){
		return $this -> ingreso_estado;
	}

}