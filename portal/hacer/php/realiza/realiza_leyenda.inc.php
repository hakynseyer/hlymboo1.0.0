<?php
namespace realiza_leyenda;

	require_once 'validaciones_generales.inc.php';

class leyenda extends \v_generales{
	protected $usar = 'crud_leyenda';

	private $personaje;
		private $e_personaje;
	private $escrito;
		private $e_escrito;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct($personaje, $escrito, $id, $hyzher){
		$this -> personaje = $this -> a_inyeccion($personaje);
		$this -> escrito = $this -> a_inyeccion($escrito);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_personaje = $this -> v_personaje($this -> personaje, $hyzher);
		$this -> e_escrito = $this -> v_escrito($this -> escrito);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_personaje($personaje, $hyzher){
		$similar = $this -> v_similar($personaje, -1, -1, 'Personaje');
		if ($similar !== '') {
			return $similar;
		}
		$parametros = array(0 => $personaje, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'personaje');
		if ($buscar === true) {
			return 'La dirección del personaje no concuerda con el dueño del personaje... Error de legitimidad';
		}
		return '';
	}
	private function v_escrito($escrito){
		$similar = $this -> v_similar($escrito, 7, 80, 'Escrito');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección de la leyenda, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'ley_hyzher');
		if ($buscar === true) {
			return 'La dirección de la leyenda no concuerda con el dueño de la leyenda... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_personaje === '' && $this -> e_escrito === '') {
			return true;
		}
		return false;
	}
	public function v_borrar(){
		if ($this -> e_id === '') {
			return true;
		}
		return false;
	}

	// AREA DE ACCIONES
	public function tabla_leyendas($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($n_titulo) || !empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_leyendas', true);
		}
		return $tabla;
	}
	public function ajax_leyendas($dato, $buscar, $hyzher, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if ((!empty($n_dato) || !empty($hyzher)) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_dato, 1 => $hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'leyenda_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function lista_personajes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'lista_personajes', true);
		}
		return $respuesta;
	}
	public function detalles_leyendas($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'detalles_leyendas', false);
		return $respuesta;
	}
	public function leyendas_contados($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'leyendas_contados', false);
		return $respuesta;
	}

	// AREA PASAR DATOS
	public function pasar_personaje(){
		return $this -> personaje;
	}
	public function pasar_escrito(){
		return $this -> escrito;
	}
	public function pasar_id(){
		return $this -> id;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Epersonaje(){
		if ($this -> e_personaje !== '') {
			echo $this -> E_inicio.$this -> e_personaje.$this -> E_fin;
		}
	}
	public function m_Eescrito(){
		if ($this -> e_escrito !== '') {
			echo $this -> E_inicio.$this -> e_escrito.$this -> E_fin;
		}
	}
	public function m_Eid(){
		if ($this -> e_id !== '') {
			echo $this -> E_inicio.$this -> e_id.$this -> E_fin;
		}
	}

	// AREA DE REGRESAR DATOS
	public function r_personaje(){
		if (!empty($this -> personaje)) {
			echo 'value = "'.$this -> personaje.'"';
		}
	}
	public function r_escrito(){
		if (!empty($this -> escrito)) {
			echo $this -> escrito;
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}