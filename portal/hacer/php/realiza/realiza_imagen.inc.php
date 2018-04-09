<?php
namespace realiza_imagen;
	
	require_once 'validaciones_generales.inc.php';

class imagen extends \v_generales{
	protected $usar = 'crud_imagen';

	private $titulo;
	private $ruta_temporal;
	private $ruta_envio;
		private $e_imagen;
	private $familia;
		private $e_familia;
	private $fuente;
		private $e_fuente;
	private $notas;
		private $e_notas;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct(array $imagen, $familia, $fuente, $notas, $estado, $id, $hyzher){
		$this -> titulo = '';
		$this -> ruta_temporal = $this -> a_inyeccion($imagen['ruta']);
		$this -> ruta_envio = '';
		$this -> familia = $this -> a_inyeccion(ucwords(strtolower($familia)));
		$this -> fuente = $this -> a_inyeccion($fuente);
		$this -> notas = $this -> a_inyeccion($notas);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_imagen = $this -> v_imagen($imagen['error'], $imagen['tamanio'], $imagen['tipo'], $imagen['titulo'], $this -> ruta_temporal);
		$this -> e_familia = $this -> v_familia($this -> familia);
		$this -> e_fuente = $this -> v_fuente($this -> fuente);
		$this -> e_notas = $this -> v_notas($this -> notas);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_imagen($error, $tamanio, $tipo, $titulo, $rutaT){
		if ($error) {
			return 'Hubo un error al validar la imagen... Intenta volver a seleccionar tu imagen; si persiste el problema, por favor enviame un mensaje';
		}
		$tamanio_permitido = 4194304; 
		if ($tamanio > $tamanio_permitido) {
			return 'Tu imagen es muy pesada como para ser almacenada en nuestro libreros memorables... Intenta editar tu imagen para reducir su peso. El máximo permitido es de [ 4 Mb ]';
		}
		if ($tipo !== 'image/jpeg' && $tipo !== 'image/jpg' && $tipo !== 'image/png' && $tipo !== 'image/gif') {
			return 'Error de tipo de imagen... Tu imagen no es aceptada debido a que no cumple con el formato de imagenes. Para imagenes solo es valido [ jpeg, jpg, png, gif ]';
		}
		$similar_RT = $this -> v_similar($rutaT, -1, -1, 'Ruta Temporal');
		if ($similar_RT !== '') {
			return $similar_RT;
		}
		$n_titulo = $this -> a_inyeccion($titulo);
		$similar_T = $this -> v_similar($n_titulo, 7, 50, 'Titulo');
		if ($similar_T !== '') {
			return $similar_T;
		}
		$rutaE = $_SERVER['DOCUMENT_ROOT'].'/puerta/hyzher/imagenes/'.$n_titulo;
		$buscar_RE = $this -> v_busqueda($rutaE, 'ruta');
		if ($buscar_RE === false) {
			return 'Existe otra imagen con la misma ruta que el tuyo... Cambia el titulo de tu imagen y vuelvelo a intentar';
		}
		$this -> ruta_envio = $rutaE;
		switch ($tipo) {
			case 'image/jpeg':
				$n_img1 = str_replace('.jpeg', '', $n_titulo);
				$nuevo_titulo = str_replace('.jpg', '', $n_img1);
				break;
			case 'image/jpg':
				$n_img1 = str_replace('.jpg', '', $n_titulo);
				$nuevo_titulo = str_replace('.jpeg', '', $n_img1);
				break;
			case 'image/png':
				$nuevo_titulo = str_replace('.png', '', $n_titulo);
				break;
			case 'image/gif':
				$nuevo_titulo = str_replace('.gif', '', $n_titulo);
				break;
			default:
				$nuevo_titulo = '';
				break;
		}
		if ($nuevo_titulo === '') {
			return 'No se pudo trabajar con el titulo de tu imagen... Vuelvelo a intentar de nuevo';
		}
		$buscarT = $this -> v_busqueda($nuevo_titulo, 'titulo');
		if ($buscarT === false) {
			return 'Existe otra imagen con el mismo titulo que el tuyo... Cambia el titulo de tu imagen y vuelvelo a intentar';
		}
		$this -> titulo = $nuevo_titulo;
		return '';
	}
	private function v_familia($familia){
		$similar = $this -> v_similar($familia, 5, 40, 'Familia');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_fuente($fuente){
		$similar = $this -> v_similar($fuente, 7, 255, 'Fuente');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_notas($notas){
		$similar = $this -> v_similar($notas, 7, 100, 'Notas');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_estado($estado){
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado de la imagen, no se ha capturado la solicitud del estado';
		}
		return '';

	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección de la imagen, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'img_hyzher');
		if ($buscar === true) {
			return 'La dirección de la imagen no concuerda con el dueño de la imagen... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_imagen === '' && $this -> e_familia === '' && $this -> e_fuente === '' && $this -> e_notas === '') {
			return true;
		}
		return false;
	}
	public function v_cambiar(){
		if ($this -> e_familia === '' && $this -> e_fuente === '' && $this -> e_notas === '' && $this -> e_estado === '' && $this -> e_id === '') {
			return true;
		}
		return false;
	}
	public function v_borrar(){
		if ($this -> e_id === '' && !empty($this -> ruta_envio)) {
			return true;
		}
		return false;
	}

	// AREA DE ACCIONES
	public function tabla_imagenes($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($n_titulo) || !empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_imagenes', true);
		}
		return $tabla;
	}
	public function ajax_imagenes($dato, $buscar, $hyzher, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if ((!empty($n_dato) || !empty($hyzher)) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_dato, 1 => $hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'imagen_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function familia_imagen($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'imagen_familia', true);
		}
		return $respuesta;
	}
	public function ruta_envio($id, $hyzher){
		$n_id = $this -> a_inyeccion($id);
		if (!empty($n_id)) {
			$parametros = array(0 => $n_id, 1 => $hyzher);
			$respuesta = $this -> a_conseguir($parametros, '', 'ruta_envio', false);
		}
		$this -> ruta_envio = $respuesta;
	}
	public function imagenes_contados($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'imagenes_contados', false);
		return $respuesta;
	}

	// AREA DE PASAR DATOS
	public function pasar_titulo(){
		return $this -> titulo;
	}
	public function pasar_ruta_temporal(){
		return $this -> ruta_temporal;
	}
	public function pasar_ruta_envio(){
		return $this -> ruta_envio;
	}
	public function pasar_familia(){
		return $this -> familia;
	}
	public function pasar_fuente(){
		return $this -> fuente;
	}
	public function pasar_notas(){
		return $this -> notas;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_id(){
		return $this -> id;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Eimagen(){
		if ($this -> e_imagen !== '') {
			echo $this -> E_inicio.$this -> e_imagen.$this -> E_fin;
		}
	}
	public function m_Efamilia(){
		if ($this -> e_familia !== '') {
			echo $this -> E_inicio.$this -> e_familia.$this -> E_fin;
		}
	}
	public function m_Efuente(){
		if ($this -> e_fuente !== '') {
			echo $this -> E_inicio.$this -> e_fuente.$this -> E_fin;
		}
	}
	public function m_Enotas(){
		if ($this -> e_notas !== '') {
			echo $this -> E_inicio.$this -> e_notas.$this -> E_fin;
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
	public function r_familia(){
		if (!empty($this -> familia)) {
			echo 'value = "'.$this -> familia.'"';
		}
	}
	public function r_fuente(){
		if (!empty($this -> fuente)) {
			echo 'value = "'.$this -> fuente.'"';
		}
	}
	public function r_notas(){
		if (!empty($this -> notas)) {
			echo $this -> notas;
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}