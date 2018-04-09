<?php
namespace realiza_fragmento;

	require_once 'validaciones_generales.inc.php';

class fragmento extends \v_generales{
	protected $usar = 'crud_fragmento';

	private $titulo;
		private $e_titulo;
	private $frontal;
		private $e_frontal;
	private $posterior;
		private $e_posterior;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct($titulo, $frontal, $posterior, $estado, $id, $hyzher){
		$this -> titulo = $this -> a_inyeccion($titulo);
		$this -> frontal = $this -> a_inyeccion($frontal);
		$this -> posterior = $this -> a_inyeccion($posterior);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_titulo = $this -> v_titulo($this -> titulo);
		$this -> e_frontal = $this -> v_frontal($this -> frontal);
		$this -> e_posterior = $this -> v_posterior($this -> posterior);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_titulo($titulo){
		$similar = $this -> v_similar($titulo, 7, 40, 'Titulo');
		if ($similar !== '') {
			return $similar;
		}
		$buscar = $this -> v_busqueda($titulo, 'titulo');
		if ($buscar === false) {
			return 'Existe otro fragmento con el mismo titulo que el tuyo... Cambia el titulo de tu fragmento y vuelvelo a intentar';
		}
		return '';
	}
	private function v_frontal($frontal){
		$similar = $this -> v_similar($frontal, 10, -1, 'Contenido Frontal');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_posterior($posterior){
		$similar = $this -> v_similar($posterior, 10, -1, 'Contenido Posterior');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_estado($estado){
		if (!isset($estado) || ($estado < 0 && $estado > 1)) {
			return 'Ha ocurrido un error con el estado del fragmento, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del fragmento, no se ha capturado la solicitud de la dirección';
		}
		$paramentros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($paramentros, 'frag_hyzher');
		if ($buscar == true) {
			return 'La dirección del fragmento no concuerda con el dueño del fragmento... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_titulo === '' && $this -> e_frontal === '' && $this -> e_posterior === '') {
			return true;
		}
		return false;
	}
	public function v_cambiar(){
		if ($this -> e_frontal === '' && $this -> e_posterior === '' && $this -> e_estado === '' && $this -> e_id === '') {
			return true;
		}
		return false;
	}
	public function v_eliminar(){
		if ($this -> e_id === '') {
			return true;
		}
		return false;
	}

	// AREA DE ACCIONES
	public function tabla_fragmentos($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($n_titulo) || !empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_fragmentos', true);
		}
		return $tabla;
	}
	public function ajax_fragmentos($dato, $buscar, $hyzher, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if ((!empty($n_dato) || !empty($hyzher)) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_dato, 1 => $hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'fragmento_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function detalles_fragmento($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'detalles_fragmento', false);
		return $respuesta;
	}
	public function fragmentos_contados($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'fragmentos_contados', false);
		return $respuesta;
	}

	// AREA DE PASAR DATOS
	public function pasar_titulo(){
		return $this -> titulo;
	}
	public function pasar_frontal(){
		return $this -> frontal;
	}
	public function pasar_posterior(){
		return $this -> posterior;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_id(){
		return $this -> id;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Etitulo(){
		if ($this -> e_titulo !== '') {
			echo $this -> E_inicio.$this -> e_titulo.$this -> E_fin;
		}
	}
	public function m_Efrontal(){
		if ($this -> e_frontal !== '') {
			echo $this -> E_inicio.$this -> e_frontal.$this -> E_fin;
		}
	}
	public function m_Eposterior(){
		if ($this -> e_posterior !== '') {
			echo $this -> E_inicio.$this -> e_posterior.$this -> E_fin;
		}
	}
	public function m_Eestado(){
		if ($this -> e_estado !== '') {
			echo $this -> E_inicio.$this -> e_estado.$this -> E_fin;
		}
	}
	public function m_Eid(){
		if ($this -> e_id !== '') {
			echo $this -> E_inicio.$this -> e_id.$this -> E_fin;
		}
	}

	// AREA DE REGRESAR DATOS
	public function r_titulo(){
		if (!empty($this -> titulo)) {
			echo 'value = "'.$this -> titulo.'"';
		}
	}
	public function r_frontal(){
		if (!empty($this -> frontal)) {
			echo $this -> frontal;
		}
	}
	public function r_posterior(){
		if (!empty($this -> posterior)) {
			echo $this -> posterior;
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}