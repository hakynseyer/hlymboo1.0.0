<?php
namespace base_archivo;

class archivo{
	private $id_archivo;
	private $archivo_hyzher;
	private $archivo_titulo;
	private $archivo_familia;
	private $archivo_ruta;
	private $archivo_derechos;
	private $archivo_notas;
	private $archivo_creado;
	private $archivo_modificado;
	private $archivo_intentos;
	private $archivo_estado;
// 11 parametros
	public function __construct($id, $hyzher, $titulo, $familia, $ruta, $derechos, $notas, $creado, $modificado, $intentos, $estado){
		$this -> id_archivo = $id;
		$this -> archivo_hyzher = $hyzher;
		$this -> archivo_titulo = $titulo;
		$this -> archivo_familia = $familia;
		$this -> archivo_ruta = $ruta;
		$this -> archivo_derechos = $derechos;
		$this -> archivo_notas = $notas;
		$this -> archivo_creado = $creado;
		$this -> archivo_modificado = $modificado;
		$this -> archivo_intentos = $intentos;
		$this -> archivo_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_archivo;
	}
	public function obtener_HYZHER(){
		return $this -> archivo_hyzher;
	}
	public function obtener_TITULO(){
		return $this -> archivo_titulo;
	}
	public function obtener_FAMILIA(){
		return $this -> archivo_familia;
	}
	public function obtener_RUTA(){
		return $this -> archivo_ruta;
	}
	public function obtener_DERECHOS(){
		return $this -> archivo_derechos;
	}
	public function obtener_NOTAS(){
		return $this -> archivo_notas;
	}
	public function obtener_CREADO(){
		return $this -> archivo_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> archivo_modificado;
	}
	public function obtener_INTENTOS(){
		return $this -> archivo_intentos;
	}
	public function obtener_ESTADO(){
		return $this -> archivo_estado;
	}
}