<?php
namespace base_clasificacion;

class clasificacion{
	private $id_clasificacion;
	private $clasificacion_tipo;

	public function __construct($id, $tipo){
		$this -> id_clasificacion = $id;
		$this -> clasificacion_tipo = $tipo;
	}

	public function obtener_ID(){
		return $this -> id_clasificacion;
	}
	public function obtener_TIPO(){
		return $this -> clasificacion_tipo;
	}
}