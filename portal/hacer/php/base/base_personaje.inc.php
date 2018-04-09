<?php
namespace base_personaje;
	
class personaje{
	private $id_personaje;
	private $personaje_hyzher;
	private $personaje_familia;
	private $personaje_imagen;
	private $personaje_nombre;
	private $personaje_edad;
	private $personaje_sexo;
	private $personaje_relacion;
	private $personaje_personalidad;
	private $personaje_historia;
	private $personaje_metas;
	private $personaje_extras;
	private $personaje_creado;
	private $personaje_modificado;
	private $personaje_intentos;
	private $personaje_estado;

	public function __construct($id, $hyzher, $imagen, $nombre, $familia, $edad, $sexo, $relacion, $personalidad, $historia, $metas, $extras, $creado, $modificado, $intentos, $estado){
		$this -> id_personaje = $id;
		$this -> personaje_hyzher = $hyzher;
		$this -> personaje_imagen = $imagen;
		$this -> personaje_nombre = $nombre;
		$this -> personaje_familia = $familia;
		$this -> personaje_edad = $edad;
		$this -> personaje_sexo = $sexo;
		$this -> personaje_relacion = $relacion;
		$this -> personaje_personalidad = $personalidad;
		$this -> personaje_historia = $historia;
		$this -> personaje_metas = $metas;
		$this -> personaje_extras = $extras;
		$this -> personaje_creado = $creado;
		$this -> personaje_modificado = $modificado;
		$this -> personaje_intentos = $intentos;
		$this -> personaje_estado = $estado;
	}

	public function obtener_ID(){
		return $this -> id_personaje;
	}	
	public function obtener_HYZHER(){
		return $this -> personaje_hyzher;
	}
	public function obtener_IMAGEN(){
		return $this -> personaje_imagen;
	}
	public function obtener_NOMBRE(){
		return $this -> personaje_nombre;
	}
	public function obtener_FAMILIA(){
		return $this -> personaje_familia;
	}
	public function obtener_EDAD(){
		return $this -> personaje_edad;
	}
	public function obtener_SEXO(){
		return $this -> personaje_sexo;
	}
	public function obtener_RELACION(){
		return $this -> personaje_relacion;
	}
	public function obtener_PERSONALIDAD(){
		return $this -> personaje_personalidad;
	}
	public function obtener_HISTORIA(){
		return $this -> personaje_historia;
	}
	public function obtener_METAS(){
		return $this -> personaje_metas;
	}
	public function obtener_EXTRAS(){
		return $this -> personaje_extras;
	}
	public function obtener_CREADO(){
		return $this -> personaje_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> personaje_modificado;
	}
	public function obtener_INTENTOS(){
		return $this -> personaje_intentos;
	}
	public function obtener_ESTADO(){
		return $this -> personaje_estado;
	}
}