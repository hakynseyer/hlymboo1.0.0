<?php
namespace realiza_hyzher;

	require_once 'validaciones_generales.inc.php';

class hyzher extends \v_generales{
	protected $usar = 'crud_hyzher';

	private $nombre;
		private $e_nombre;
	private $alias;
		private $e_alias;
	private $email;
		private $e_email;
	private $llave;
		private $e_llave;
	private $r_llave;
		private $e_r_llave;
	private $pregunta1;
	private $respuesta1;
		private $e_respuesta1;
	private $pregunta2;
	private $respuesta2;
		private $e_respuesta2;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;
	private $E_inicio;
	private $E_fin;

	public function __construct($nombre, $alias, $email, $llave, $r_llave, $pregunta1, $respuesta1, $pregunta2, $respuesta2, $estado, $id, $dato){
		$this -> nombre = $this -> a_inyeccion($nombre);
		$this -> alias = $this -> a_inyeccion($alias);
		$this -> email = $this -> a_inyeccion($email);
		$this -> llave = $this -> a_inyeccion($llave);
		$this -> r_llave = $this -> a_inyeccion($r_llave);
		$this -> pregunta1 = $this -> a_inyeccion($pregunta1);
		$this -> respuesta1 = $this -> a_inyeccion($respuesta1);
		$this -> pregunta2 = $this -> a_inyeccion($pregunta2);
		$this -> respuesta2 = $this -> a_inyeccion($respuesta2);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_nombre = $this -> v_nombre($nombre);
		$this -> e_alias = $this -> v_alias($alias);
		$this -> e_email = $this -> v_email($email);
		$this -> e_llave = $this -> v_llave($llave);
		$this -> e_r_llave = $this -> v_llaveR($llave, $r_llave);
		$this -> e_respuesta1 = $this -> v_respuesta1($respuesta1);
		$this -> e_respuesta2 = $this -> v_respuesta2($respuesta2);
		$this -> e_estado = $this -> v_estado($this -> estado);
		$this -> e_id = $this -> v_id($this -> id, $dato);
	}

	// AREA DE VALIDACIONES
	private function v_nombre($dato){
		$similar = $this -> v_similar($dato, 5, 45, 'Nombre');
		return $similar;
	}
	private function v_alias($dato){
		$similar = $this -> v_similar($dato, 4, 15, 'Alias');
		if ($similar !== '') {
			return $similar;
		}
		$buscar = $this -> v_busqueda($dato, 'alias');
		if ($buscar === false) {
			return 'Existe otro Hyzher con el mismo alias... Piensa en otro alias y vuelvelo a enviar.';
		}
		return '';
	}
	private function v_email($dato){
		$similar = $this -> v_similar($dato, -1, -1, 'Email');
		if ($similar !== '') {
			return $similar;
		}
		$buscar = $this -> v_busqueda($dato, 'email');
		if ($buscar === false) {
			return 'Existe otro Hyzher con el mismo email... Si deseas recuperar tu cuenta Hyzher recurre a un administrador o al creador.';
		}
		$buscar2 = $this -> v_busqueda($dato, 'email_ingreso');
		if ($buscar2 === true){
			return 'Este correo no existe en los registros del preregistro... Error de usuario';
		}
		return '';
	}
	private function v_llave($dato){
		$similar = $this -> v_similar($dato, 4, 255, 'Llave');
		return $similar;
	}
	private function v_llaveR($llave_N, $llave_R){
		$dato = array(0 => $llave_N, 1 => $llave_R);
		if ($this -> v_igual($dato) === false) {
			return 'Ambas llaves no coinciden... Favor de colocar la misma llave en los 2 campos requeridos';
		}
		return '';
	}
	private function v_respuesta1($dato){
		$similar = $this -> v_similar($dato, 4, -1, 'Respuesta 1');
		return $similar;
	}
	private function v_respuesta2($dato){
		$similar = $this -> v_similar($dato, 4, -1, 'Respuesta 2');
		return $similar;
	}
	private function v_estado($estado){
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado del usuario Hyzher, no se ha capturado la solicitud del estado';
		}
		return '';
	}
	private function v_id($id, $email){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del usuario Hyzher, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $email);
		$buscar = $this -> v_busqueda($parametros, 'hyzher_hyzher');
		if ($buscar === true) {
			return 'La dirección del usuario Hyzher no concuerda con el dueño del usuario Hyzher... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_nombre === '' && $this -> e_alias === '' && $this -> e_email === '' && $this -> e_llave === '' && $this -> e_r_llave === '' && $this -> e_respuesta1 === '' && $this -> e_respuesta2 === '') {
			return true;
		}
		return false;
	}

	// AREA DE ACCIONES
	public function id_hyzher($alias, $email){
		$n_alias = $this -> a_inyeccion($alias);
		$n_email = $this -> a_inyeccion($email);
		if (!empty($n_alias) && !empty($n_email)) {
			$parametros = array(0 => $n_alias, 1 => $n_email);
			$respuesta = $this -> a_conseguir($parametros, '', 'id_hyzher', false);
		}
		return $respuesta;
	}

	// AREA DE PASAR DATOS
	public function pasar_nombre(){
		return $this -> nombre;
	}
	public function pasar_alias(){
		return $this -> alias;
	}
	public function pasar_email(){
		return $this -> email;
	}
	public function pasar_llave(){
		return $this -> llave;
	}
	public function pasar_pregunta1(){
		return $this -> pregunta1;
	}
	public function pasar_respuesta1(){
		return $this -> respuesta1;
	}
	public function pasar_pregunta2(){
		return $this -> pregunta2;
	}
	public function pasar_respuesta2(){
		return $this -> respuesta2;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Enombre(){
		if ($this -> e_nombre !== '') {
			echo $this -> E_inicio.$this -> e_nombre.$this -> E_fin;
		}
	}
	public function m_Ealias(){
		if ($this -> e_alias !== '') {
			echo $this -> E_inicio.$this -> e_alias.$this -> E_fin;
		}
	}
	public function m_Eemail(){
		if ($this -> e_email !== '') {
			echo $this -> E_inicio.$this -> e_email.$this -> E_fin;
		}
	}
	public function m_Ellave(){
		if ($this -> e_llave !== '') {
			echo $this -> E_inicio.$this -> e_llave.$this -> E_fin;
		}
	}
	public function m_Erllave(){
		if ($this -> e_r_llave !== '') {
			echo $this -> E_inicio.$this -> e_r_llave.$this -> E_fin;
		}
	}
	public function m_Erespuesta1(){
		if ($this -> e_respuesta1 !== '') {
			echo $this -> E_inicio.$this -> e_respuesta1.$this -> E_fin;
		}
	}
	public function m_Erespuesta2(){
		if ($this -> e_respuesta2 !== '') {
			echo $this -> E_inicio.$this -> e_respuesta2.$this -> E_fin;
		}
	}

	// AREA REGRESAR DATOS
	public function r_nombre(){
		if (!empty($this -> nombre)) {
			echo 'value = "'.$this -> nombre.'"';
		}
	}
	public function r_alias(){
		if (!empty($this -> alias)) {
			echo 'value = "'.$this -> alias.'"';
		}
	}
	public function r_email(){
		if (!empty($this -> email)) {
			echo 'value = "'.$this -> email.'"';
		}
	}
	public function r_respuesta1(){
		if (!empty($this -> respuesta1)) {
			echo 'value = "'.$this -> respuesta1.'"';
		}
	}
	public function r_respuesta2(){
		if (!empty($this -> respuesta2)) {
			echo 'value = "'.$this -> respuesta2.'"';
		}
	}
}