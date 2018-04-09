<?php
namespace base_nucleo;

class nucleo{
	private $id_nucleo;
	private $nucleo_hyzher;
	private $nucleo_familia;
	private $nucleo_cerradura;
	private $nucleo_creado;

	public function __construct($id, $hyzher, $familia, $cerradura, $creado){
		$this -> id_nucleo = $id;
		$this -> nucleo_hyzher = $hyzher;
		$this -> nucleo_familia = $familia;
		$this -> nucleo_cerradura = $cerradura;
		$this -> nucleo_creado = $creado;
	}

	public function obtener_ID(){
		return $this -> id_nucleo;
	}

	public function obtener_HYZHER(){
		return $this -> nucleo_hyzher;
	}

	public function obtener_FAMILIA(){
		return $this -> nucleo_familia;
	}

	public function obtener_CERRADURA(){
		return $this -> nucleo_cerradura;
	}

	public function obtener_CREADO(){
		return $this -> nucleo_creado;
	}
}
