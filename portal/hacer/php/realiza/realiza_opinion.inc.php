<?php
namespace realiza_opinion;
	
	require_once 'validaciones_generales.inc.php';

class opinion extends \v_generales{
	protected $usar = 'crud_opinion';

	private $blog;
		private $e_blog;
	private $texto;
		private $e_texto;
	private $spam;
		private $e_spam;
	private $hyzh;
		private $e_hyzh;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct($blog, $texto, $spam, $hyzh, $estado, $id, $hyzher){
		$this -> blog = $this -> a_inyeccion($blog);
		$this -> texto = $this -> a_inyeccion($texto);
		$this -> spam = $this -> a_inyeccion($spam);
		$this -> hyzh = $this -> a_inyeccion($hyzh);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_blog = $this -> v_blog($this -> blog);
		$this -> e_texto = $this -> v_texto($this -> texto);
		$this -> e_spam = $this -> v_spam($this -> spam);
		$this -> e_hyzh = $this -> v_hyzh($this -> hyzh);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id);
	}

	//AREA DE VALIDACIONES
	private function v_blog($blog){
		if ($this -> v_vacio($blog) == false) {
			return 'Ha ocurrido un error con la dirección del blog, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($blog, 'blog');
		if ($buscar === true) {
			return 'No se encuentra la entrada a comentar... Error de buscador';
		}
		return '';
	}
	private function v_texto($texto){
		$similar = $this -> v_similar($texto, 4, -1, 'Texto');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}
	private function v_spam($spam){
		if ($this -> v_vacio($spam) == false) {
			return 'Ha ocurrido un error con la dirección del spam, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($spam, 'spam');
		if ($buscar === true) {
			return 'No se encuentra el tipo de opinion... Error de buscador';
		}
		return '';
	}
	private function v_hyzh($hyzh){
		if ($this -> v_vacio($hyzh) == false) {
			$this -> hyzh = null;
			return '';
		}
		$buscar = $this -> v_busqueda($hyzh, 'hyzh');
		if ($buscar === true) {
			return 'No se encuentra la opinion a comentar... Error de buscador';
		}
		return '';
	}
	private function v_estado($estado){ //NO LO OCUPO
		if (!isset($estado) || ($estado < 0 && $estado > 1)) {
			return 'Ha ocurrido un error con el estado de la opinion, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección de la opinion, no se ha capturado la solicitud de la dirección';
		}
		// $parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($id, 'opinion');
		if ($buscar === true) {
			return 'No se encuentra la opinion a borrar... Error de buscador';
		}
		return '';
	}

	//AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if($this -> e_blog === '' && $this -> e_texto === '' && $this -> e_spam === '' && $this -> e_hyzh === ''){
			return true;
		}
		return false;
	}
	public function v_ids(){
		if($this -> e_id === ''){
			return true;
		}
		return false;
	}

	//AREA DE ACCIONES
	public function tabla_opiniones($titulo, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		$tabla = $this -> a_conseguir($n_titulo, $ordenar, 'tabla_opiniones', true);
		return $tabla;
	}
	public function ajax_opiniones($dato, $buscar, $ordenar){ //ME PARECE QUE NO LO USO
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'opinion_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function opiniones_contados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'opiniones_contados', false);
		return $respuesta;
	}
	public function blogs_opinados($hyzher, $ordenar){
		$seleccion = [];
		$seleccion = $this -> a_conseguir($hyzher, $ordenar, 'blogs_opinados', true);
		return $seleccion;
	}
	public function obtener_respuesta($id){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($id, '', 'la_respuesta', false);
		return $respuesta;
	}
	public function obtener_hyzher($id){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($id, '', 'el_hyzher', false);
		return $respuesta;
	}

	//AREA PASAR DATOS
	public function pasar_blog(){
		return $this -> blog;
	}
	public function pasar_texto(){
		return $this -> texto;
	}
	public function pasar_spam(){
		return $this -> spam;
	}
	public function pasar_hyzh(){
		return $this -> hyzh;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_id(){
		return $this -> id;
	}

	//AREA MOSTRAR ERRORES
	public function m_Eblog(){
		if ($this -> e_blog !== '') {
			echo $this -> E_inicio.$this -> e_blog.$this -> E_fin;
		}
	}
	public function m_Etexto(){
		if ($this -> e_texto !== '') {
			echo $this -> E_inicio.$this -> e_texto.$this -> E_fin;
		}
	}
	public function m_Espam(){
		if ($this -> e_spam !== '') {
			echo $this -> E_inicio.$this -> e_spam.$this -> E_fin;
		}
	}
	public function m_Ehyzh(){
		if ($this -> e_hyzh !== '') {
			echo $this -> E_inicio.$this -> e_hyzh.$this -> E_fin;
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

	//AREA REGRESAR DATOS
	public function r_blog(){
		if (!empty($this -> blog)) {
			echo 'value = "'.$this -> blog.'"';
		}
	}
	public function r_texto(){
		if (!empty($this -> texto)) {
			echo $this -> texto;
		}
	}
	public function r_hyzh(){
		if (!empty($this -> hyzh)) {
			echo 'value = "'.$this -> hyzh.'"';
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}