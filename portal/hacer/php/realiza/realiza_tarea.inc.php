<?php
namespace realiza_tarea;

	require_once 'validaciones_generales.inc.php';

class tarea extends \v_generales{
	protected  $usar = 'crud_tarea';

	private $blog;
		private $e_blog;
	private $planeacion;
		private $e_planeacion;
	private $descripcion;
		private $e_descripcion;
	private $programada;
		private $p_dia;
		private $p_mes;
		private $p_anio;
		private $e_programada;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;
	
	// 9 parametros
	public function __construct($blog, $planeacion, $descripcion, $p_dia, $p_mes, $p_anio, $estado, $id, $hyzher){
		$this -> blog = $this -> a_inyeccion($blog);
		$this -> planeacion = $this -> a_inyeccion($planeacion);
		$this -> descripcion = $this -> a_inyeccion($descripcion);
		$this -> p_dia = $this -> a_inyeccion($p_dia);
		$this -> p_mes = $this -> a_inyeccion($p_mes);
		$this -> p_anio = $this -> a_inyeccion($p_anio);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_blog = $this -> v_blog($this -> blog, $hyzher);
		$this -> e_planeacion = '';
		$this -> e_descripcion = $this -> v_descripcion($this -> descripcion);
		$this -> e_programada = $this -> v_programada($this -> p_dia, $this -> p_mes, $this -> p_anio);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id);
	}

	//AREA DE VALIDACIONES
	private function v_blog($blog, $hyzher){
		if ($this -> v_vacio($blog) == false) {
			return 'Ha ocurrido un error con la dirección del blog, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $blog, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'blog');
		if ($buscar === true) {
			return 'No se encuentra la dirección del blog en nuestros registros... Error de ubicación';
		}
		$buscar2 = $this -> v_busqueda($blog, 'elblog');
		if($buscar2 === false){
			return 'Esta entrada ya cuenta con una tarea... Error de duplicación';
		}
		return '';
	}
	private function v_descripcion($descripcion){
		$similar = $this -> v_similar($descripcion, 10, 255, 'Descripcion');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}
	private function v_programada($dia, $mes, $anio){
		if((!empty($dia) && !empty($mes) && !empty($anio)) && ($dia !== 'Vacio' && $mes !== 'Vacio' && $anio !== 'Vacio')){
			$this -> programada = $anio.'-'.$mes.'-'.$dia;
			return '';
		}
		return 'La fecha programada se encuentra incompleta o vacia... Error de asignación';
	}
	private function v_estado($estado){
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado de la tarea, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección de la tarea, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($id, 'tarea_blog');
		if ($buscar === true) {
			return 'No se encuentra la dirección de la tarea en nuestros registros... Error de ubicación';
		}
		return '';
	}

	//AREA DE RESULTADOS
	public function v_nuevo(){
		if($this -> e_blog === '' && $this -> e_descripcion === '' && $this -> e_programada === ''){
			return true;
		}
		return false;
	}
	public function v_cambiar(){
		if($this -> e_descripcion === '' && $this -> e_programada === '' && $this -> e_estado === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}
	public function v_borrar(){
		if($this -> e_id === ''){
			return true;
		}
		return false;
	}

	//AREA DE ACCIONES
	public function tabla_tareas($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_tareas', true);
		}
		return $tabla;
	}
	public function ajax_tareas($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'tarea_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function tareas_contados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'tareas_contados', false);
		return $respuesta;
	}
	public function tareas_permitidas($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'tareas_permitidas', false);
		return $respuesta;
	}
	public function mis_blogs($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_blogs', true);
		}
		return $respuesta;
	}
	public function mi_tarea($blog){
		$respuesta = null;
		if (!empty($blog)) {
			$respuesta = $this -> a_conseguir($blog, '', 'mi_tarea', false);
		}
		return $respuesta;
	}

	//AREA PASAR DATOS
	public function pasar_blog(){
		return $this -> blog;
	}
	public function pasar_planeacion(){
		return $this -> planeacion;
	}
	public function pasar_descripcion(){
		return $this -> descripcion;
	}
	public function pasar_programada(){
		return $this -> programada;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_id(){
		return $this -> id;
	}

	public function pasar_dia(){
		return $this -> p_dia;
	}
	public function pasar_mes(){
		return $this -> p_mes;
	}
	public function pasar_anio(){
		return $this -> p_anio;
	}

	//AREA MOSTRAR ERRORES
	public function m_Eblog(){
		if ($this -> e_blog !== '') {
			echo $this -> E_inicio.$this -> e_blog.$this -> E_fin;
		}
	}
	public function m_Eplaneacion(){
		if ($this -> e_planeacion !== '') {
			echo $this -> E_inicio.$this -> e_planeacion.$this -> E_fin;
		}
	}
	public function m_Edescripcion(){
		if ($this -> e_descripcion !== '') {
			echo $this -> E_inicio.$this -> e_descripcion.$this -> E_fin;
		}
	}
	public function m_Eprogramada(){
		if ($this -> e_programada !== '') {
			echo $this -> E_inicio.$this -> e_programada.$this -> E_fin;
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
	public function r_descripcion(){
		if (!empty($this -> descripcion)) {
			echo $this -> descripcion;
		}
	}
	public function r_blog(){
		if(!empty($this -> blog)){
			echo 'value = "'.$this -> blog.'"';
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}