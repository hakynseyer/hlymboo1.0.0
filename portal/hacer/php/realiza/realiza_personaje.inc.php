<?php
namespace realiza_personaje;

	require_once 'validaciones_generales.inc.php';

class personaje extends \v_generales{
	protected $usar = 'crud_personaje';

	private $imagen;
		private $e_imagen;
	private $nombre;
		private $e_nombre;
	private $familia;
		private $e_familia;
	private $edad;
		private $e_edad;
	private $sexo;
		private $e_sexo;
	private $relacion;
		private $e_relacion;
	private $personalidad;
		private $e_personalidad;
	private $historia;
		private $e_historia;
	private $metas;
		private $e_metas;
	private $extras;
		private $e_extras;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;
// 12 parametros
	public function __construct($imagen, $nombre, $familia, $edad, $sexo, $relacion, $personalidad, $historia, $metas, $extras, $estado, $id, $hyzher){
		$this -> imagen = $this -> a_inyeccion($imagen);
		$this -> nombre = $this -> a_inyeccion($nombre);
		$this -> familia = $this -> a_inyeccion(ucwords(strtolower($familia)));
		$this -> edad = $this -> a_inyeccion($edad);
		$this -> sexo = $this -> a_inyeccion($sexo);
		$this -> relacion = '<p>'.$this -> a_inyeccion($relacion).'</p>';
		$this -> personalidad = $this -> a_inyeccion($personalidad);
		$this -> historia = $this -> a_inyeccion($historia);
		$this -> metas = $this -> a_inyeccion($metas);
		$this -> extras = $this -> a_inyeccion($extras);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_imagen = $this -> v_imagen($this -> imagen, $hyzher);
		$this -> e_nombre = $this -> v_nombre($this -> nombre);
		$this -> e_familia = $this -> v_familia($this -> familia);
		$this -> e_edad = $this -> v_edad($this -> edad);
		$this -> e_sexo = $this -> v_sexo($this -> sexo);
		$this -> e_relacion = $this -> v_relacion($this -> relacion);
		$this -> e_personalidad = $this -> v_personalidad($this -> personalidad);
		$this -> e_historia = $this -> v_historia($this -> historia);
		$this -> e_metas = $this -> v_metas($this -> metas);
		$this -> e_extras = $this -> v_extras($this -> extras);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_imagen($imagen, $hyzher){
		if ($this -> v_vacio($imagen) == false) {
			$this -> imagen = null;
			return '';
		}
		$parametros = array(0 => $imagen, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'img_hyzher');
		if ($buscar === true) {
			return 'La dirección de la imagen no concuerda con el dueño de la imagen... Error de legitimidad';
		}
		return '';
	}
	private function v_nombre($nombre){
		$similar = $this -> v_similar($nombre, 7, 25, 'Nombre');
		if ($similar !== '') {
			return $similar;
		}
		$buscar = $this -> v_busqueda($nombre, 'nombre');
		if ($buscar === false) {
			return 'Existe otro personaje con el mismo nombre que el tuyo... Cambia el nombre de tu personaje y vuelvelo a intentar';
		}
		return '';
	}
	private function v_familia($familia){
		$similar = $this -> v_similar($familia, 5, 40, 'Familia');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_edad($edad){
		$similar = $this -> v_similar($edad, -1, 40, 'Edad');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_sexo($sexo){
		$similar = $this -> v_similar($sexo, -1, 40, 'Sexo');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_relacion($relacion){
		$similar = $this -> v_similar($relacion, 7, -1, 'Relacion');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_personalidad($personalidad){
		$similar = $this -> v_similar($personalidad, 7, -1, 'Personalidad');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_historia($historia){
		$similar = $this -> v_similar($historia, 7, -1, 'Historia');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_metas($metas){
		$similar = $this -> v_similar($metas, 7, -1, 'Metas');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_extras($extras){
		$similar = $this -> v_similar($extras, 7, -1, 'Extras');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_estado($estado){
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado del personaje, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del personaje, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'per_hyzher');
		if ($buscar === true) {
			return 'La dirección del personaje no concuerda con el dueño del personaje... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_imagen === ''  && $this -> e_nombre === '' && $this -> e_familia === '' && $this -> e_edad === '' && $this -> e_sexo === '' && $this -> e_relacion === '' && $this -> e_personalidad === '' && $this -> e_historia === '' && $this -> e_metas === '' && $this -> e_extras === '') {
			return true;
		}
		return false;
	}
	public function v_cambiar(){
		if ($this -> e_imagen === '' && $this -> e_familia === ''  && $this -> e_edad === '' && $this -> e_sexo === '' && $this -> e_relacion === '' && $this -> e_personalidad === '' && $this -> e_historia === '' && $this -> e_metas === '' && $this -> e_extras === '' && $this -> e_estado === '' && $this -> e_id === '') {
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
	public function tabla_personajes($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($n_titulo) || !empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_personajes', true);
		}
		return $tabla;
	}
	public function ajax_personajes($dato, $buscar, $hyzher, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if ((!empty($n_dato) || !empty($hyzher)) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_dato, 1 => $hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'personaje_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function familia_personajes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'personaje_familia', true);
		}
		return $respuesta;
	}
	public function detalles_personaje($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'detalles_personaje', false);
		return $respuesta;
	}
	public function personajes_contados($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'personajes_contados', false);
		return $respuesta;
	}
	public function mis_imagenes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_imagenes', true);
		}
		return $respuesta;
	}

	// AREA PASAR DATOS
	public function pasar_imagen(){
		return $this -> imagen;
	}
	public function pasar_nombre(){
		return $this -> nombre;
	}
	public function pasar_familia(){
		return $this -> familia;
	}
	public function pasar_edad(){
		return $this -> edad;
	}
	public function pasar_sexo(){
		return $this -> sexo;
	}
	public function pasar_relacion(){
		return $this -> relacion;
	}
	public function pasar_personalidad(){
		return $this -> personalidad;
	}
	public function pasar_historia(){
		return $this -> historia;
	}
	public function pasar_metas(){
		return $this -> metas;
	}
	public function pasar_extras(){
		return $this -> extras;
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
	public function m_Enombre(){
		if ($this -> e_nombre !== '') {
			echo $this -> E_inicio.$this -> e_nombre.$this -> E_fin;
		}
	}
	public function m_Efamilia(){
		if ($this -> e_familia !== '') {
			echo $this -> E_inicio.$this -> e_familia.$this -> E_fin;
		}
	}
	public function m_Eedad(){
		if ($this -> e_edad !== '') {
			echo $this -> E_inicio.$this -> e_edad.$this -> E_fin;
		}
	}
	public function m_Esexo(){
		if ($this -> e_sexo !== '') {
			echo $this -> E_inicio.$this -> e_sexo.$this -> E_fin;
		}
	}
	public function m_Erelacion(){
		if ($this -> e_relacion !== '') {
			echo $this -> E_inicio.$this -> e_relacion.$this -> E_fin;
		}
	}
	public function m_Epersonalidad(){
		if ($this -> e_personalidad !== '') {
			echo $this -> E_inicio.$this -> e_personalidad.$this -> E_fin;
		}
	}
	public function m_Ehistoria(){
		if ($this -> e_historia !== '') {
			echo $this -> E_inicio.$this -> e_historia.$this -> E_fin;
		}
	}
	public function m_Emetas(){
		if ($this -> e_metas !== '') {
			echo $this -> E_inicio.$this -> e_metas.$this -> E_fin;
		}
	}
	public function m_Eextras(){
		if ($this -> e_extras !== '') {
			echo $this -> E_inicio.$this -> e_extras.$this -> E_fin;
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
	public function r_imagen(){
		if (!empty($this -> imagen)) {
			echo 'value = "'.$this -> imagen.'"';
		}
	}
	public function r_nombre(){
		if (!empty($this -> nombre)) {
			echo 'value = "'.$this -> nombre.'"';
		}
	}
	public function r_familia(){
		if (!empty($this -> familia)) {
			echo 'value = "'.$this -> familia.'"';
		}
	}
	public function r_edad(){
		if (!empty($this -> edad)) {
			echo 'value = "'.$this -> edad.'"';
		}
	}
	public function r_sexo(){
		if (!empty($this -> sexo)) {
			echo 'value = "'.$this -> sexo.'"';
		}
	}
	public function r_relacion(){
		if (!empty($this -> relacion)) {
			echo 'value = "'.$this -> relacion.'"';
		}
	}
	public function r_personalidad(){
		if (!empty($this -> personalidad)) {
			echo $this -> personalidad;
		}
	}
	public function r_historia(){
		if (!empty($this -> historia)) {
			echo $this -> historia;
		}
	}
	public function r_metas(){
		if (!empty($this -> metas)) {
			echo $this -> metas;
		}
	}
	public function r_extras(){
		if (!empty($this -> extras)) {
			echo $this -> extras;
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}