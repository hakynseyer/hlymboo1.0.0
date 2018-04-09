<?php
	namespace realiza_ingreso;

	require_once 'validaciones_generales.inc.php';

class ingreso extends \v_generales{
	protected $usar = 'crud_ingreso';

	private $user;
		private $e_user;
	private $pass;
		private $e_pass;
	private $email;
		private $e_email;
	private $id;
		private $e_id;

	private $acceso;
		private $e_acceso;

	private $E_inicio;
	private $E_fin;

	public function __construct($user, $pass, $email, $id){
		$this -> user = $this -> a_inyeccion($user);
		$this -> pass = $this -> a_inyeccion($pass);
		$this -> email = $this -> a_inyeccion($email);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_user = $this -> v_user($this -> user);
		$this -> e_pass = $this -> v_pass($this -> pass);
		$this -> e_email = $this -> v_email($this -> email);
		$this -> e_id = $this -> v_id($this -> id);
	}

	//AREA DE VALIDACIONES
	private function v_user($user){
		$similar = $this -> v_similar($user, 5, 15, 'Usuario');
		if($similar !== ''){
			return $similar;
		}
		$buscar_ingreso = $this -> v_busqueda($user, 'user_ingreso');
		if($buscar_ingreso === false){
			return 'Existe actualmente un usuario con el mismo alias... Error de duplicación';
		}
		$buscar_hyzher = $this -> v_busqueda($user, 'user_hyzher');
		if($buscar_hyzher === false){
			return 'Existe actualmente un hyzher con el mismo alias... Error de duplicación';
		}
		return '';
	}

	private function v_pass($pass){
		$similar = $this -> v_similar($pass, 5, 15, 'Password');
		if($similar !== ''){
			return $similar;
		}
		return '';
	}

	private function v_email($email){
		$similar = $this -> v_similar($email, -1, -1, 'Email');
		if($similar !== ''){
			return $similar;
		}
		$buscar_ingreso = $this -> v_busqueda($email, 'email_ingreso');
		if($buscar_ingreso === false){
			return 'Existe actualmente un usuario con el mismo email... Error de duplicación';
		}
		$buscar_hyzher = $this -> v_busqueda($email, 'email_hyzher');
		if($buscar_hyzher === false){
			return 'Existe actualmente un hyzher con el mismo email... Error de duplicación';
		}
		return '';
	}

	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del usuario usuario, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($id, 'user_id');
		if ($buscar === true) {
			return 'No se encuentra el usuario en nuestros registros... Error de legitimidad';
		}
		return '';
	}

	private function v_acceso($email, $pass, $modo){
		$similar_email = $this -> v_similar($email, -1, -1, 'Email');
		if ($similar_email !== '') {
			return $similar_email;
		}
		$similar_pass = $this -> v_similar($pass, -1, -1, 'Password');
		if ($similar_pass !== '') {
			return $similar_pass;
		}
		switch ($modo) {
			case 'acceso':
				$this -> acceso = $this -> a_conseguir($email, '', 'acceso_registro', false);
				break;
			case 'compuerta':
				$this -> acceso = $this -> a_conseguir($email, '', 'hcompuerta', false);
				break;
			default:
				$this -> acceso = null;
				break;
		}
		
		if (is_null($this -> acceso) || !password_verify($pass, $this -> acceso -> obtener_PASS()) || $email !== $this -> acceso -> obtener_EMAIL() ) {
			return'¡Datos incorrectos!... Se te niega el ingreso al "Registro de Hyzhers"';
		}
		return '';
	}


	//AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if($this -> e_user === '' && $this -> e_pass === '' && $this -> e_email === ''){
			return true;
		}
		return false;
	}

	public function v_cambiar_pass(){
		if($this -> e_pass === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

//CAMPO INHABILITADO POR EL MOMENTO DEBIDO A UNA UNA MEJORA EN LA BUSQUEDA DE EMAIL UNICO EN BD.
	// public function v_cambiar_email(){
	// 	if($this -> e_email === ''){
	// 		return true;
	// 	}
	// 	return false;
	// }

	public function v_borrar(){
		if($this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_ingreso(){
		if ($this -> e_acceso === '' && !is_null($this -> acceso)) {
			return true;
		}
		return false;
	}

	//AREA DE ACCIONES

	public function acceder($email, $pass, $modo){
		$this -> email = $this -> a_inyeccion($email);
		$this -> e_acceso = $this -> v_acceso($this -> email, $this -> a_inyeccion($pass), $modo);
	}

	public function tabla_ingresos($user, $ordenar){
		$tabla = [];
		$n_user = $this -> a_inyeccion($user);
		$tabla = $this -> a_conseguir('%'.$n_user.'%', $ordenar, 'tabla_ingresos', true);
		return $tabla;
	}

	public function ajax_ingresos($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'ingresos_ID', false);
					break;
			}
		}
		return $respuesta;
	}

	public function ingresos_totales(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'ingresos_totales', false);
		return $respuesta;
	}

	public function ingresos_registrados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'ingresos_totales_registrados', false);
		return $respuesta;
	}

	//AREA PASAR DATOS

	public function pasar_user(){
		return $this -> user;
	}

	public function pasar_pass(){
		return $this -> pass;
	}

	public function pasar_email(){
		return $this -> email;
	}

	public function pasar_id(){
		return $this -> id;
	}

	//AREA DE MOSTRAR ERRORES

	public function m_Euser(){
		if ($this -> e_user !== '') {
			echo $this -> E_inicio.$this -> e_user.$this -> E_fin;
		}
	}

	public function m_Epass(){
		if ($this -> e_pass !== '') {
			echo $this -> E_inicio.$this -> e_pass.$this -> E_fin;
		}
	}

	public function m_Eemail(){
		if ($this -> e_email !== '') {
			echo $this -> E_inicio.$this -> e_email.$this -> E_fin;
		}
	}

	public function m_Eid(){
		if ($this -> e_id !== '') {
			echo $this -> E_inicio.$this -> e_id.$this -> E_fin;
		}
	}

	public function m_Eacceso(){
		if ($this -> e_acceso !== '') {
			echo $this -> E_inicio.$this -> e_acceso.$this -> E_fin;
		}
	}

	// AREA DE REGRESAR DATOS

	public function r_user(){
		if (!empty($this -> user)) {
			echo 'value = "'.$this -> user.'"';
		}
	}

	public function r_email(){
		if (!empty($this -> email)) {
			echo 'value = "'.$this -> email.'"';
		}
	}

	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}

}
