<?php
namespace realiza_perfil;

	require_once 'validaciones_generales.inc.php';

class perfil extends \v_generales{
	protected $usar = 'crud_perfil';

	private $hyzher;
		private $e_hyzher;
	private $imagen;
		private $e_imagen;
	private $fragmento;
		private $e_fragmento;
	private $nacimiento;
		private $p_dia;
		private $p_mes;
		private $p_anio;
		private $e_nacimiento;
	private $lugar;
		private $e_lugar;
	private $soy;
		private $e_soy;
	private $social1;
		private $e_social1;
	private $social2;
		private $e_social2;
	private $social3;
		private $e_social3;
	private $social4;
		private $e_social4;
	private $etiqueta;
		private $e_etiqueta;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	// 14 parametros
	public function __construct($hyzher, $imagen, $fragmento, $dia, $mes, $anio, $lugar, $soy, $social1, $social2, $social3, $social4, $etiqueta, $estado, $id){
		$this -> imagen = $this -> a_inyeccion($imagen);
		$this -> fragmento = $this -> a_inyeccion($fragmento);
		$this -> p_dia = $this -> a_inyeccion($dia);
		$this -> p_mes = $this -> a_inyeccion($mes);
		$this -> p_anio = $this -> a_inyeccion($anio);
		$this -> lugar = $this -> a_inyeccion($lugar);
		$this -> soy = $this -> a_inyeccion($soy);
		$this -> social1 = $this -> a_inyeccion($social1);
		$this -> social2 = $this -> a_inyeccion($social2);
		$this -> social3 = $this -> a_inyeccion($social3);
		$this -> social4 = $this -> a_inyeccion($social4);
		$this -> etiqueta = $this -> a_inyeccion($etiqueta);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);
		$this -> hyzher = $this -> a_inyeccion($hyzher);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_hyzher = $this -> v_hyzher($hyzher);
		$this -> e_imagen = $this -> v_imagen($this -> imagen);
		$this -> e_fragmento = $this -> v_fragmento($this -> fragmento);
		$this -> e_nacimiento = $this -> v_nacimiento($this -> p_dia, $this -> p_mes, $this -> p_anio);
		$this -> e_lugar = $this -> v_lugar($this -> lugar);
		$this -> e_soy = $this -> v_soy($this -> soy);
		$this -> e_social1 = $this -> v_social1($this -> social1, $hyzher);
		$this -> e_social2 = $this -> v_social2($this -> social2, $hyzher);
		$this -> e_social3 = $this -> v_social3($this -> social3, $hyzher);
		$this -> e_social4 = $this -> v_social4($this -> social4, $hyzher);
		$this -> e_etiqueta = $this -> v_etiqueta($this -> etiqueta);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	//AREA DE VALIDACIONES
	private function v_hyzher($hyzher){
		if ($this -> v_vacio($hyzher) == false) {
			return 'Ha ocurrido un error con la dirección del hyzher, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($hyzher, 'hyzher');
		if ($buscar === false) {
			return 'Existe ya un perfil tuyo con datos establecidos... Error de duplicación';
		}
		return '';
	}
	private function v_imagen($imagen){
		if ($this -> v_vacio($imagen) == false) {
			return 'Ha ocurrido un error con la dirección de la imagen, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($imagen, 'imagen');
		if ($buscar === true) {
			return 'No se encuentra la dirección de la imagen en nuestros registros... Error de ubicación';
		}
		return '';
	}
	private function v_fragmento($fragmento){
		if (empty($fragmento) || $fragmento === 'Vacio') {
			$this -> fragmento = null;
			return '';
		}
		$buscar = $this -> v_busqueda($fragmento, 'fragmento');
		if ($buscar === true) {
			return 'No se encuentra la dirección del fragmento en nuestros registros... Error de ubicación';
		}
		return '';
	}
	private function v_nacimiento($dia, $mes, $anio){
		if((!empty($dia) && !empty($mes) && !empty($anio)) && ($dia !== 'Vacio' && $mes !== 'Vacio' && $anio !== 'Vacio')){
			$this -> nacimiento = $anio.'-'.$mes.'-'.$dia;
			return '';
		}
		return 'La fecha de nacimiento se encuentra incompleta o vacia... Error de asignación';
	}
	private function v_lugar($lugar){
		$similar = $this -> v_similar($lugar, 2, 255, 'Lugar');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}
	private function v_soy($soy){
		$similar = $this -> v_similar($soy, 10, -1, 'Sobre Mi');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}
	private function v_social1($social, $hyzher){
		if(empty($social)){
			$this -> social1 = null;
			return '';
		}
		$similar = $this -> v_similar($social, 2, -1, 'Red Social Facebook');
		if($similar !== ''){
			return $similar;
		}
		$parametros = array(0 => $social, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'social1');
		if ($buscar === false) {
			return 'Existe otro hyzher con la misma red social que la tuya... Error de autoría';
		}
		return '';
	}
	private function v_social2($social, $hyzher){
		if(empty($social)){
			$this -> social2 = null;
			return '';
		}
		$similar = $this -> v_similar($social, 2, -1, 'Red Social Twitter');
		if($similar !== ''){
			return $similar;
		}
		$parametros = array(0 => $social, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'social2');
		if ($buscar === false) {
			return 'Existe otro hyzher con la misma red social que la tuya... Error de autoría';
		}
		return '';
	}
	private function v_social3($social, $hyzher){
		if(empty($social)){
			$this -> social3 = null;
			return '';
		}
		$similar = $this -> v_similar($social, 2, -1, 'Red Social Youtube');
		if($similar !== ''){
			return $similar;
		}
		$parametros = array(0 => $social, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'social3');
		if ($buscar === false) {
			return 'Existe otro hyzher con la misma red social que la tuya... Error de autoría';
		}
		return '';
	}
	private function v_social4($social, $hyzher){
		if(empty($social)){
			$this -> social4 = null;
			return '';
		}
		$similar = $this -> v_similar($social, 2, -1, 'Red Social Website');
		if($similar !== ''){
			return $similar;
		}
		$parametros = array(0 => $social, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'social4');
		if ($buscar === false) {
			return 'Existe otro hyzher con la misma red social que la tuya... Error de autoría';
		}
		return '';
	}
	private function v_etiqueta($etiqueta){
		if(empty($etiqueta)){
			$this -> etiqueta = null;
			return '';
		}
		$similar = $this -> v_similar($etiqueta, 2, 255, 'etiqueta');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}
	private function v_estado($estado){
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado del perfil, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del perfil, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'id_perfil');
		if ($buscar === true) {
			return 'La dirección del perfil no concuerda con el dueño del hyzher... Error de legitimidad';
		}
		return '';
	}

	//AREA DE RESULTADOS
	public function v_nuevo(){
		if($this -> e_hyzher === '' && $this -> e_nacimiento === '' && $this -> e_lugar === '' && $this -> e_soy === ''){
			return true;
		}
		return false;
	}

	public function v_img(){
		if($this -> e_imagen === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_social(){
		if($this -> e_social1 === '' && $this -> e_social2 === '' && $this -> e_social3 === '' && $this -> e_social4 === '' && $this -> e_fragmento === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_estados(){
		if($this -> e_estado === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_perfil(){
		if($this -> e_nacimiento === '' && $this -> e_lugar === '' && $this -> e_soy === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_etiquetas(){
		if($this -> e_etiqueta === '' && $this -> e_id === ''){
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
	public function tabla_perfil($hyzher, $ordenar){
		$tabla = null;
		$n_hyzher = $this -> a_inyeccion($hyzher);
		$tabla = $this -> a_conseguir($n_hyzher, $ordenar, 'tabla_perfil', false);
		return $tabla;
	}
	public function tabla_perfil2($hyzher, $ordenar){
		$tabla = [];
		$n_hyzher = $this -> a_inyeccion($hyzher);
		$tabla = $this -> a_conseguir('%'.$n_hyzher.'%', $ordenar, 'tabla_perfil2', true);
		return $tabla;
	}
	public function ajax_perfil($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);

		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'perfil_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function ajax_perfil2($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_id = $this -> a_inyeccion($dato[0]);
		$n_hyzher = $this -> a_inyeccion($dato[1]);

		if (!empty($n_id) && !empty($n_hyzher) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_id, 1 => $n_hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'perfil2_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function mis_imagenes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_imagenes', true);
		}
		return $respuesta;
	}
	public function mis_fragmentos($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_fragmentos', true);
		}
		return $respuesta;
	}
	public function etiquetas_contados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'etiquetas_contados', false);
		return $respuesta;
	}

	//AREA PASAR DATOS
	public function pasar_imagen(){
		return $this -> imagen;
	}
	public function pasar_fragmento(){
		return $this -> fragmento;
	}
	public function pasar_nacimiento(){
		return $this -> nacimiento;
	}
	public function pasar_lugar(){
		return $this -> lugar;
	}
	public function pasar_soy(){
		return $this -> soy;
	}
	public function pasar_social1(){
		return $this -> social1;
	}
	public function pasar_social2(){
		return $this -> social2;
	}
	public function pasar_social3(){
		return $this -> social3;
	}
	public function pasar_social4(){
		return $this -> social4;
	}
	public function pasar_etiqueta(){
		return $this -> etiqueta;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_hyzher(){
		return $this -> hyzher;
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
	public function m_Ehyzher(){
		if ($this -> e_hyzher !== '') {
			echo $this -> E_inicio.$this -> e_hyzher.$this -> E_fin;
		}
	}
	public function m_Eimagen(){
		if ($this -> e_imagen !== '') {
			echo $this -> E_inicio.$this -> e_imagen.$this -> E_fin;
		}
	}
	public function m_Efragmento(){
		if ($this -> e_fragmento !== '') {
			echo $this -> E_inicio.$this -> e_fragmento.$this -> E_fin;
		}
	}
	public function m_Enacimiento(){
		if ($this -> e_nacimiento !== '') {
			echo $this -> E_inicio.$this -> e_nacimiento.$this -> E_fin;
		}
	}
	public function m_Elugar(){
		if ($this -> e_lugar !== '') {
			echo $this -> E_inicio.$this -> e_lugar.$this -> E_fin;
		}
	}
	public function m_Esoy(){
		if ($this -> e_soy !== '') {
			echo $this -> E_inicio.$this -> e_soy.$this -> E_fin;
		}
	}
	public function m_Esocial1(){
		if ($this -> e_social1 !== '') {
			echo $this -> E_inicio.$this -> e_social1.$this -> E_fin;
		}
	}
	public function m_Esocial2(){
		if ($this -> e_social2 !== '') {
			echo $this -> E_inicio.$this -> e_social2.$this -> E_fin;
		}
	}
	public function m_Esocial3(){
		if ($this -> e_social3 !== '') {
			echo $this -> E_inicio.$this -> e_social3.$this -> E_fin;
		}
	}
	public function m_Esocial4(){
		if ($this -> e_social4 !== '') {
			echo $this -> E_inicio.$this -> e_social4.$this -> E_fin;
		}
	}
	public function m_Eetiqueta(){
		if ($this -> e_etiqueta !== '') {
			echo $this -> E_inicio.$this -> e_etiqueta.$this -> E_fin;
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
	public function r_imagen(){
		if(!empty($this -> imagen)){
			echo 'value = "'.$this -> imagen.'"';
		}
	}

	public function r_lugar(){
		if(!empty($this -> lugar)){
			echo 'value = "'.$this -> lugar.'"';
		}
	}

	public function r_soy(){
		if (!empty($this -> soy)) {
			echo $this -> soy;
		}
	}

	public function r_social1(){
		if(!empty($this -> social1)){
			echo 'value = "'.$this -> social1.'"';
		}
	}

	public function r_social2(){
		if(!empty($this -> social2)){
			echo 'value = "'.$this -> social2.'"';
		}
	}

	public function r_social3(){
		if(!empty($this -> social3)){
			echo 'value = "'.$this -> social3.'"';
		}
	}

	public function r_social4(){
		if(!empty($this -> social4)){
			echo 'value = "'.$this -> social4.'"';
		}
	}

	public function r_etiqueta(){
		if(!empty($this -> etiqueta)){
			echo $this -> etiqueta;
		}
	}

	public function r_hyzher(){
		if(!empty($this -> hyzher)){
			echo 'value = "'.$this -> hyzher.'"';
		}
	}

	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}