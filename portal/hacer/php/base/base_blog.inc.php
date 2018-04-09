<?php
namespace base_blog;

class blog{
	private $id_blog;
	private $blog_hyzher;
	private $blog_personaje;
	private $blog_fragmento;
	private $blog_imagen;
	private $blog_categoria;
	private $blog_clasificacion;
	private $blog_titulo;
	private $blog_familia;
	private $blog_url;
	private $blog_texto;
	private $blog_archivo;
	private $blog_archivoactivo;
	private $blog_derechos;
	private $blog_creado;
	private $blog_modificado;
	private $blog_intentos;
	private $blog_estado;	
// 18 parametros
	public function __construct($id, $hyzher, $personaje, $fragmento, $imagen, $categoria, $clasificacion, $titulo, $familia, $url, $texto, $archivo, $archivoactivo, $derechos, $creado, $modificado, $intentos, $estado){
		$this -> id_blog = $id;
		$this -> blog_hyzher = $hyzher;
		$this -> blog_personaje = $personaje;
		$this -> blog_fragmento = $fragmento;
		$this -> blog_imagen = $imagen;
		$this -> blog_categoria = $categoria;
		$this -> blog_clasificacion = $clasificacion;
		$this -> blog_titulo = $titulo;
		$this -> blog_familia = $familia;
		$this -> blog_url = $url;
		$this -> blog_texto = $texto;
		$this -> blog_archivo = $archivo;
		$this -> blog_archivoactivo = $archivoactivo;
		$this -> blog_derechos = $derechos;
		$this -> blog_creado = $creado;
		$this -> blog_modificado = $modificado;
		$this -> blog_intentos = $intentos;
		$this -> blog_estado = $estado;	
	}

	public function obtener_ID(){
		return $this -> id_blog;
	}
	public function obtener_HYZHER(){
		return $this -> blog_hyzher;
	}
	public function obtener_PERSONAJE(){
		return $this -> blog_personaje;
	}
	public function obtener_FRAGMENTO(){
		return $this -> blog_fragmento;
	}
	public function obtener_IMAGEN(){
		return $this -> blog_imagen;
	}
	public function obtener_CATEGORIA(){
		return $this -> blog_categoria;
	}
	public function obtener_CLASIFICACION(){
		return $this -> blog_clasificacion;
	}
	public function obtener_TITULO(){
		return $this -> blog_titulo;
	}
	public function obtener_FAMILIA(){
		return $this -> blog_familia;
	}
	public function obtener_URL(){
		return $this -> blog_url;
	}
	public function obtener_TEXTO(){
		return $this -> blog_texto;
	}
	public function obtener_ARCHIVO(){
		return $this -> blog_archivo;
	}
	public function obtener_ARCHIVOACTIVO(){
		return $this -> blog_archivoactivo;
	}
	public function obtener_DERECHOS(){
		return $this -> blog_derechos;
	}
	public function obtener_CREADO(){
		return $this -> blog_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> blog_modificado;
	}
	public function obtener_INTENTOS(){
		return $this -> blog_intentos;
	}
	public function obtener_ESTADO(){
		return $this -> blog_estado;
	}
}