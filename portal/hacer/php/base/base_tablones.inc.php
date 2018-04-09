<?php
namespace base_tablones;

class tablones{
	private $id_tarea;
	private $hyzher_alias;
	private $blog_personaje;
	private $blog_imagen;
	private $categoria_tipo;
	private $clasificacion_tipo;
	private $blog_titulo;
	private $blog_familia;
	private $planeacion_proceso;
	private $planeacion_etapa1;
	private $planeacion_etapa2;
	private $planeacion_etapa3;
	private $planeacion_etapa4;
	private $planeacion_etapa5;
	private $planeacion_etapa6;
	private $tarea_descripcion;
	private $tarea_programada;

	public function __construct($id, $hyzher, $personaje, $imagen, $categoria, $clasificacion, $titulo, $familia, $proceso, $etapa1, $etapa2, $etapa3, $etapa4, $etapa5, $etapa6, $descripcion, $programada){
		$this -> id_tarea = $id;
		$this -> hyzher_alias = $hyzher;
		$this -> blog_personaje = $personaje;
		$this -> blog_imagen = $imagen;
		$this -> categoria_tipo = $categoria;
		$this -> clasificacion_tipo = $clasificacion;
		$this -> blog_titulo = $titulo;
		$this -> blog_familia = $familia;
		$this -> planeacion_proceso = $proceso;
		$this -> planeacion_etapa1 = $etapa1;
		$this -> planeacion_etapa2 = $etapa2;
		$this -> planeacion_etapa3 = $etapa3;
		$this -> planeacion_etapa4 = $etapa4;
		$this -> planeacion_etapa5 = $etapa5;
		$this -> planeacion_etapa6 = $etapa6;
		$this -> tarea_descripcion = $descripcion;
		$this -> tarea_programada = $programada;
	}

	public function obtener_ID(){
		return $this -> id_tarea;
	}
	public function  obtener_ALIAS(){
		return $this -> hyzher_alias;
	}
	public function obtener_PERSONAJE(){
		return $this -> blog_personaje;
	}
	public function obtener_IMAGEN(){
		return $this -> blog_imagen;
	}
	public function obtener_CATEGORIA(){
		return $this -> categoria_tipo;
	}
	public function obtener_CLASIFICACION(){
		return $this -> clasificacion_tipo;
	}
	public function obtener_TITULO(){
		return $this -> blog_titulo;
	}
	public function obtener_FAMILIA(){
		return $this -> blog_familia;
	}
	public function obtener_PROCESO(){
		return $this -> planeacion_proceso;
	}
	public function obtener_ETAPA1(){
		return $this -> planeacion_etapa1;
	}
	public function obtener_ETAPA2(){
		return $this -> planeacion_etapa2;
	}
	public function obtener_ETAPA3(){
		return $this -> planeacion_etapa3;
	}
	public function obtener_ETAPA4(){
		return $this -> planeacion_etapa4;
	}
	public function obtener_ETAPA5(){
		return $this -> planeacion_etapa5;
	}
	public function obtener_ETAPA6(){
		return $this -> planeacion_etapa6;
	}
	public function obtener_DESCRIPCION(){
		return $this -> tarea_descripcion;
	}
	public function obtener_PROGRAMADA(){
		return $this -> tarea_programada;
	}
}