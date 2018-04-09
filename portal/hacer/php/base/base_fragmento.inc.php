<?php
namespace base_fragmento;

class fragmento{
	private $id_fragmento;
	private $fragmento_hyzher;
	private $fragmento_titulo;
	private $fragmento_lado1;
	private $fragmento_lado2;
	private $fragmento_creado;
	private $fragmento_modificado;
	private $fragmento_intentos;
	private $fragmento_estado;
// 9 parametros
	public function __construct($id, $hyzher, $titulo, $lado1, $lado2, $creado, $modificado, $intentos, $estado){
		$this -> id_fragmento = $id;
		$this -> fragmento_hyzher = $hyzher;
		$this -> fragmento_titulo = $titulo;
		$this -> fragmento_lado1 = $lado1;
		$this -> fragmento_lado2 = $lado2;
		$this -> fragmento_creado = $creado;
		$this -> fragmento_modificado = $modificado;
		$this -> fragmento_intentos = $intentos;
		$this -> fragmento_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_fragmento;
	}
	public function obtener_HYZHER(){
		return $this -> fragmento_hyzher;
	}
	public function obtener_TITULO(){
		return $this -> fragmento_titulo;
	}
	public function obtener_LADO1(){
		return $this -> fragmento_lado1;
	}
	public function obtener_LADO2(){
		return $this -> fragmento_lado2;
	}
	public function obtener_CREADO(){
		return $this -> fragmento_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> fragmento_modificado;
	}
	public function obtener_INTENTOS(){
		return $this -> fragmento_intentos;
	}
	public function obtener_ESTADO(){
		return $this -> fragmento_estado;
	}

	// public function cambiar_LADO1($lado1){
	// 	return $this -> fragmento_lado1 = $lado1;
	// }
	// public function cambiar_LADO2($lado2){
	// 	return $this -> fragmento_lado2 = $lado2;
	// }
	// public function cambiar_INTENTOS($intentos){
	// 	return $this -> fragmento_intentos = $intentos;
	// }
	// public function cambiar_ESTADO($estado){
	// 	return $this -> fragmento_estado = $estado;
	// }
}