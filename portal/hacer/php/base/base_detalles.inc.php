<?php
namespace base_detalles;

class detalles{
	private $id_detalles;
	private $detalles_hyzher;	
	private $detalles_fragmentos;
	private $detalles_personajes;
	private $detalles_tareas;
	private $detalles_leyendas;
	private $detalles_prestigio;

	public function __construct($id, $hyzher, $fragmentos, $personajes, $tareas, $leyendas, $prestigio){
		$this -> id_detalles = $id;
		$this -> detalles_hyzher = $hyzher; 
		$this -> detalles_fragmentos = $fragmentos; 
		$this -> detalles_personajes = $personajes; 
		$this -> detalles_tareas = $tareas; 
		$this -> detalles_leyendas = $leyendas; 
		$this -> detalles_prestigio = $prestigio; 		
	}

	public function obtener_ID(){
		return $this -> id_detalles;
	}
	public function obtener_HYZHER(){
		return $this -> detalles_hyzher;
	}
	public function obtener_FRAGMENTOS(){
		return $this -> detalles_fragmentos;
	}
	public function obtener_PERSONAJES(){
		return $this -> detalles_personajes;
	}
	public function obtener_TAREAS(){
		return $this -> detalles_tareas;
	}
	public function obtener_LEYENDAS(){
		return $this -> detalles_leyendas;
	}
	public function obtener_PRESTIGIO(){
		return $this -> detalles_prestigio;
	}
}