<?php
namespace realiza_detalles;

	require_once 'validaciones_generales.inc.php';

class detalles extends \v_generales{
	protected $usar = 'crud_detalles';

	private $fragmento;
		private $e_fragmento;
	private $personaje;
		private $e_personaje;
	private $tarea;
		private $e_tarea;
	private $leyenda;
		private $e_leyenda;	
	private $id;
		private $e_id;

	private $hyzher;
	private $prestigio;

	private $E_inicio;
	private $E_fin;

	public function __construct($fragmento, $personaje, $tarea, $leyenda, $id, $hyzher, $prestigio){
		$this -> fragmento = $this -> a_inyeccion($fragmento);
		$this -> personaje = $this -> a_inyeccion($personaje);
		$this -> tarea = $this -> a_inyeccion($tarea);
		$this -> leyenda = $this -> a_inyeccion($leyenda);
		$this -> id = $this -> a_inyeccion($id);
		$this -> hyzher = $this -> a_inyeccion($hyzher);
		$this -> prestigio = $this -> a_inyeccion($prestigio);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_fragmento = $this -> v_numeros($this -> fragmento, 3, 'Número Fragmentos');
		$this -> e_personaje = $this -> v_numeros($this -> personaje, 2, 'Número Personajes');
		$this -> e_tarea = $this -> v_numeros($this -> tarea, 3, 'Número Tareas');
		$this -> e_leyenda = $this -> v_numeros($this -> leyenda, 3, 'Número Leyendas');
		$this -> e_id = $this -> v_id($this -> id);
	}

	//AREA DE VALIDACIONES
	private function v_numeros($actual, $minimo, $titulo){
		if($this -> v_vacio($actual) == false){
			return 'El campo "'.$titulo. '" se encuentra vacio, este campo no puede estar vacio';
		}
		if(($actual < $minimo) || ($actual <= 0)){
			return 'Error en el campo "'.$titulo. '". No se permiten números menores a '.$minimo;
		}
		return '';
	}
	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del detalle, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($id, 'detalles_hyzher');
		if ($buscar == true) {
			return 'La dirección del detalle no concuerda con el dueño del detalle... Error de legitimidad';
		}
		return '';
	}

	//AREA DE RESULTADOS DE VALIDACIONES
	public function v_cambiar_detalles(){
		if($this -> e_fragmento === '' && $this -> e_personaje === '' && $this -> e_tarea === '' && $this -> e_leyenda === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	//AREA DE ACCIONES
	public function tabla_detalles($hyzher, $ordenar){
		$tabla = [];
		$n_tipo = $this -> a_inyeccion($hyzher);
		$tabla = $this -> a_conseguir('%'.$n_tipo.'%', $ordenar, 'tabla_detalles', true);
		return $tabla;
	}
	public function ajax_detalles($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'detalles_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function detalles_contados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'detalles_contados', false);
		return $respuesta;
	}

	//AREA DE PASAR DATOS
	public function pasar_fragmento(){
		return $this -> fragmento;
	}
	public function pasar_personaje(){
		return $this -> personaje;
	}
	public function pasar_tarea(){
		return $this -> tarea;
	}
	public function pasar_leyenda(){
		return $this -> leyenda;
	}
	public function pasar_id(){
		return $this -> id;
	}

	//AREA MOSTRAR ERRORES
	public function m_Efragmento(){
		if ($this -> e_fragmento !== '') {
			echo $this -> E_inicio.$this -> e_fragmento.$this -> E_fin;
		}
	}
	public function m_Epersonaje(){
		if ($this -> e_personaje !== '') {
			echo $this -> E_inicio.$this -> e_personaje.$this -> E_fin;
		}
	}
	public function m_Etarea(){
		if ($this -> e_tarea !== '') {
			echo $this -> E_inicio.$this -> e_tarea.$this -> E_fin;
		}
	}
	public function m_Eleyenda(){
		if ($this -> e_leyenda !== '') {
			echo $this -> E_inicio.$this -> e_leyenda.$this -> E_fin;
		}
	}
	public function m_Eid(){
		if ($this -> e_id !== '') {
			echo $this -> E_inicio.$this -> e_id.$this -> E_fin;
		}
	}

	//AREA REGRESAR DATOS
	public function r_fragmento(){
		if (!empty($this -> fragmento)) {
			echo 'value = "'.$this -> fragmento.'"';
		}
	}
	public function r_personaje(){
		if (!empty($this -> personaje)) {
			echo 'value = "'.$this -> personaje.'"';
		}
	}
	public function r_tarea(){
		if (!empty($this -> tarea)) {
			echo 'value = "'.$this -> tarea.'"';
		}
	}
	public function r_leyenda(){
		if (!empty($this -> leyenda)) {
			echo 'value = "'.$this -> leyenda.'"';
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}