<?php
namespace base_categoria;

class categoria{
	private $id_categoria;
	private $categoria_tipo;

	public function __construct($id, $tipo){
		$this -> id_categoria = $id;
		$this -> categoria_tipo = $tipo;
	}

	public function obtener_ID(){
		return $this -> id_categoria;
	}
	public function obtener_TIPO(){
		return $this -> categoria_tipo;
	}
}