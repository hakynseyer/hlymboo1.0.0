<?php
namespace base_tarea;

class tarea{
	private $id_tarea;
	private $tarea_blog;
	private $tarea_planeacion;
	private $tarea_descripcion;
	private $tarea_programada;
	private $tarea_estado;

	public function __construct($id, $blog, $planeacion, $descripcion, $programada, $estado){
		$this -> id_tarea = $id;
		$this -> tarea_blog = $blog;
		$this -> tarea_planeacion = $planeacion;
		$this -> tarea_descripcion = $descripcion;
		$this -> tarea_programada = $programada;
		$this -> tarea_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_tarea;
	}
	public function obtener_BLOG(){
		return $this -> tarea_blog;
	}
	public function obtener_PLANEACION(){
		return $this -> tarea_planeacion;
	}
	public function obtener_DESCRIPCION(){
		return $this -> tarea_descripcion;
	}
	public function obtener_PROGRAMADA(){
		return $this -> tarea_programada;
	}
	public function obtener_ESTADO(){
		return $this -> tarea_estado;
	}
}