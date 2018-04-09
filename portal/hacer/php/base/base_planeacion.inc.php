<?php
namespace base_planeacion;

class planeacion{
	private $id_planeacion;
	private $planeacion_blog;
	private $planeacion_proceso;
	private $planeacion_etapa1;
	private $planeacion_etapa2;
	private $planeacion_etapa3;
	private $planeacion_etapa4;
	private $planeacion_etapa5;
	private $planeacion_etapa6;

	public function __construct($id, $blog, $proceso, $etapa1, $etapa2, $etapa3, $etapa4, $etapa5, $etapa6){
		$this -> id_planeacion = $id;
		$this -> planeacion_blog = $blog;
		$this -> planeacion_proceso = $proceso;
		$this -> planeacion_etapa1 = $etapa1;
		$this -> planeacion_etapa2 = $etapa2;
		$this -> planeacion_etapa3 = $etapa3;
		$this -> planeacion_etapa4 = $etapa4;
		$this -> planeacion_etapa5 = $etapa5;
		$this -> planeacion_etapa6 = $etapa6;		
	}

	public function obtener_ID(){
		return $this -> id_planeacion;
	}
	public function obtener_BLOG(){
		return $this -> planeacion_blog;
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
}