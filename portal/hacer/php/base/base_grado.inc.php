<?php
namespace base_grado;

class grado{
	private $id_grado;
	private $grado_tipo;

	public function __construct($id, $tipo){
		$this -> id_grado = $id;
		$this -> grado_tipo = $tipo;
	}

	public function obtener_ID(){
		return $this -> id_grado;
	}
	public function obtener_TIPO(){
		return $this -> grado_tipo;
	}

	public function cambiar_TIPO($tipo){
		return $this -> grado_tipo = $tipo;
	}
}