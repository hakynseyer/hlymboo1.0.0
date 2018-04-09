<?php
namespace base_spam;

class spam{
	private $id_spam;
	private $spam_tipo;

	public function __construct($id, $tipo){
		$this -> id_spam = $id;
		$this -> spam_tipo = $tipo;
	}

	public function obtener_ID(){
		return $this -> id_spam;
	}
	public function obtener_TIPO(){
		return $this -> spam_tipo;
	}
}