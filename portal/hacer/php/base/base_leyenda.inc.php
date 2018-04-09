<?php
namespace base_leyenda;

class leyenda{
	private $id_leyenda;
	private $leyenda_hyzher;
	private $leyenda_personaje;
	private $leyenda_escrito;

	public function __construct($id, $hyzher, $personaje, $escrito){
		$this -> id_leyenda = $id;
		$this -> leyenda_hyzher = $hyzher;
		$this -> leyenda_personaje = $personaje;
		$this -> leyenda_escrito = $escrito;
	}

	public function obtener_ID(){
		return $this -> id_leyenda;
	}
	public function obtener_HYZHER(){
		return $this -> leyenda_hyzher;
	}
	public function obtener_PERSONAJE(){
		return $this -> leyenda_personaje;
	}
	public function obtener_ESCRITO(){
		return $this -> leyenda_escrito;
	}
}