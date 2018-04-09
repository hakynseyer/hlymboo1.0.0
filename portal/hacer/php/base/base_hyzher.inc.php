<?php
namespace base_hyzher;

class hyzher{
	private $id_hyzher;
	private $hyzher_nombre;
	private $hyzher_alias;
	private $hyzher_email;
	private $hyzher_grado;
	private $hyzher_llave;
	private $hyzher_pregunta1;
	private $hyzher_respuesta1;
	private $hyzher_pregunta2;
	private $hyzher_respuesta2;
	private $hyzher_creado;
	private $hyzher_modificado;
	private $hyzher_estado;

	public function __construct($id, $nombre, $alias, $email, $grado, $llave, $pregunta1, $respuesta1, $pregunta2, $respuesta2, $creado, $modificado, $estado){
		$this -> id_hyzher = $id;
		$this -> hyzher_nombre = $nombre;
		$this -> hyzher_alias = $alias;
		$this -> hyzher_email = $email;
		$this -> hyzher_grado = $grado;
		$this -> hyzher_llave = $llave;
		$this -> hyzher_pregunta1 = $pregunta1;
		$this -> hyzher_respuesta1 = $respuesta1;
		$this -> hyzher_pregunta2 = $pregunta2;
		$this -> hyzher_respuesta2 = $respuesta2;
		$this -> hyzher_creado = $creado;
		$this -> hyzher_modificado = $modificado;
		$this -> hyzher_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_hyzher;
	}
	public function obtener_NOMBRE(){
		return $this -> hyzher_nombre;
	}
	public function obtener_ALIAS(){
		return $this -> hyzher_alias;
	}
	public function obtener_EMAIL(){
		return $this -> hyzher_email;
	}
	public function obtener_GRADO(){
		return $this -> hyzher_grado;
	}
	public function obtener_LLAVE(){
		return $this -> hyzher_llave;
	}
	public function obtener_PREGUNTA1(){
		return $this -> hyzher_pregunta1;
	}
	public function obtener_RESPUESTA1(){
		return $this -> hyzher_respuesta1;
	}
	public function obtener_PREGUNTA2(){
		return $this -> hyzher_pregunta2;
	}
	public function obtener_RESPUESTA2(){
		return $this -> hyzher_respuesta2;
	}
	public function obtener_CREADO(){
		return $this -> hyzher_creado;
	}
	public function obtener_MODIFICADO(){
		return $this -> hyzher_modificado;
	}
	public function obtener_ESTADO(){
		return $this -> hyzher_estado;
	}

	public function cambiar_NOMBRE($nombre){
		return $this -> hyzher_nombre = $nombre;
	}
	public function cambiar_EMAIL($email){
		return $this -> hyzher_email = $email;
	}
	public function cambiar_GRADO($grado){
		return $this -> hyzher_grado = $grado;
	}
	public function cambiar_LLAVE($llave){
		return $this -> hyzher_llave = $llave;
	}
	public function cambiar_PREGUNTA1($pregunta1){
		return $this -> hyzher_pregunta1 = $pregunta1;
	}
	public function cambiar_RESPUESTA1($respuesta1){
		return $this -> hyzher_respuesta1 = $respuesta1;
	}
	public function cambiar_PREGUNTA2($pregunta2){
		return $this -> hyzher_pregunta2 = $pregunta2;
	}
	public function cambiar_RESPUESTA2($respuesta2){
		return $this -> hyzher_respuesta2 = $respuesta2;
	}
	public function cambiaar_ESTADO($estado){
		return $this -> hyzher_estado = $estado;
	}
}