<?php
namespace base_opinion;

class opinion{
	private $id_opinion;
	private $opinion_hyzher;
	private $opinion_blog;
	private $opinion_texto;
	private $opinion_spam;
	private $opinion_hyzh;
	private $opinion_creado;
	private $opinion_estado;

	public function __construct($id, $hyzher, $blog, $texto, $spam, $hyzh, $creado, $estado){
		$this -> id_opinion = $id;
		$this -> opinion_hyzher = $hyzher;
		$this -> opinion_blog = $blog;
		$this -> opinion_texto = $texto;
		$this -> opinion_spam = $spam;
		$this -> opinion_hyzh = $hyzh;
		$this -> opinion_creado = $creado;
		$this -> opinion_estado = $estado;		
	}	

	public function obtener_ID(){
		return $this -> id_opinion;
	}
	public function obtener_HYZHER(){
		return $this -> opinion_hyzher;
	}
	public function obtener_BLOG(){
		return $this -> opinion_blog;
	}
	public function obtener_TEXTO(){
		return $this -> opinion_texto;
	}
	public function obtener_SPAM(){
		return $this -> opinion_spam;
	}
	public function obtener_HYZH(){
		return $this -> opinion_hyzh;
	}
	public function obtener_CREADO(){
		return $this -> opinion_creado;
	}
	public function obtener_ESTADO(){
		return $this -> opinion_estado;
	}
}