<?php
namespace base_imagen;

class imagen{
	private $id_imagen;
	private $imagen_hyzher;
	private $imagen_titulo;
	private $imagen_familia;
	private $imagen_ruta;
	private $imagen_fuente;
	private $imagen_notas;
	private $imagen_creado;
	private $imagen_modificado;
	private $imagen_intentos;
	private $imagen_estado;

	public function __construct($id, $hyzher, $titulo, $familia, $ruta, $fuente, $notas, $creado, $modificado, $intentos, $estado){
		$this -> id_imagen = $id;
		$this -> imagen_hyzher = $hyzher;
		$this -> imagen_titulo = $titulo;
		$this -> imagen_familia = $familia;
		$this -> imagen_ruta = $ruta;
		$this -> imagen_fuente = $fuente;
		$this -> imagen_notas = $notas;
		$this -> imagen_creado = $creado;
		$this -> imagen_modificado = $modificado;
		$this -> imagen_intentos = $intentos;
		$this -> imagen_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_imagen;
	}
	public function obtener_HYZHER(){
		return $this -> imagen_hyzher;
	}
	public function obtener_TITULO(){
		return $this -> imagen_titulo;
	}
	public function obtener_FAMILIA(){
		return $this -> imagen_familia;
	}
	public function obtener_RUTA(){
		return $this -> imagen_ruta;
	}
	public function obtener_FUENTE(){
		return $this -> imagen_fuente;
	}
	public function obtener_NOTAS(){
		return $this -> imagen_notas;
	}
	public function obtener_CREADO(){
		return $this -> imagen_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> imagen_modificado;
	}
	public function obtener_INTENTOS(){
		return $this -> imagen_intentos;
	}
	public function obtener_ESTADO(){
		return $this -> imagen_estado;
	}

}