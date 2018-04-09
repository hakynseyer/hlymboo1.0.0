<?php
namespace base_perfil;

class perfil{
	private $id_perfil;
	private $perfil_hyzher;
	private $perfil_imagen;
	private $perfil_fragmento;
	private $perfil_nacimiento;
	private $perfil_lugar;
	private $perfil_soy;
	private $perfil_social1;
	private $perfil_social2;
	private $perfil_social3;
	private $perfil_social4;
	private $perfil_etiqueta;
	private $perfil_estado;	
	//12 Parametros
	public function __construct($id, $hyzher, $imagen, $fragmento, $nacimiento, $lugar, $soy, $social1, $social2, $social3, $social4, $etiqueta, $estado){
		$this -> id_perfil = $id;
		$this -> perfil_hyzher = $hyzher;
		$this -> perfil_imagen = $imagen;
		$this -> perfil_fragmento = $fragmento;
		$this -> perfil_nacimiento = $nacimiento;
		$this -> perfil_lugar = $lugar;
		$this -> perfil_soy = $soy;
		$this -> perfil_social1 = $social1;
		$this -> perfil_social2 = $social2;
		$this -> perfil_social3 = $social3;
		$this -> perfil_social4 = $social4;
		$this -> perfil_etiqueta = $etiqueta;
		$this -> perfil_estado = $estado;		
	}

	public function obtener_ID(){
		return $this -> id_perfil;
	}
	public function obtener_HYZHER(){
		return $this -> perfil_hyzher;
	}
	public function obtener_IMAGEN(){
		return $this -> perfil_imagen;
	}
	public function obtener_FRAGMENTO(){
		return $this -> perfil_fragmento;
	}
	public function obtener_NACIMIENTO(){
		return $this -> perfil_nacimiento;
	}
	public function obtener_LUGAR(){
		return $this -> perfil_lugar;
	}
	public function obtener_SOY(){
		return $this -> perfil_soy;
	}
	public function obtener_SOCIAL1(){
		return $this -> perfil_social1;
	}
	public function obtener_SOCIAL2(){
		return $this -> perfil_social2;
	}
	public function obtener_SOCIAL3(){
		return $this -> perfil_social3;
	}
	public function obtener_SOCIAL4(){
		return $this -> perfil_social4;
	}
	public function obtener_ETIQUETA(){
		return $this -> perfil_etiqueta;
	}
	public function obtener_ESTADO(){
		return $this -> perfil_estado;
	}
}