<?php
namespace realiza_acceso;

	require_once 'validaciones_generales.inc.php';

class acceso extends \v_generales{
	protected $usar = 'crud_hyzher';

	private $email;
	private $llave;
		private $e_acceso;
	private $hyzher;

	private $E_inicio;
	private $E_fin;

	public function __construct($email, $llave){
		$this -> email = $this -> a_inyeccion($email);
		$this -> llave = $this -> a_inyeccion($llave);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_acceso = $this -> v_acceso($this -> email, $this -> llave);
	}

	// AREA DE VALIDACIONES
	private function v_acceso($email, $llave){
		$similar_email = $this -> v_similar($email, -1, -1, 'Hakymail');
		if ($similar_email !== '') {
			return $similar_email;
		}
		$similar_llave = $this -> v_similar($llave, -1, -1, 'Llave');
		if ($similar_llave !== '') {
			return $similar_llave;
		}
		$this -> hyzher = $this -> a_conseguir($email, '', 'acceso', false);
		if (is_null($this -> hyzher) || !password_verify($llave, $this -> hyzher -> obtener_LLAVE()) || $email !== $this -> hyzher -> obtener_EMAIL() ) {
			return'¡Datos incorrectos!... La información proporcionada "NO COINCIDE" con la información del sistema';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_adelante(){
		if ($this -> e_acceso === '' && !is_null($this -> hyzher)) {
			return true;
		}
		return false;
	}

	// AREA DE PASAR DATOS
	public function pasar_HYZHER(){
		return $this -> hyzher;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Eacceso(){
		if ($this -> e_acceso !== '') {
			echo $this -> E_inicio.$this -> e_acceso.$this -> E_fin;
		}
	}

	// AREA DE REGRESAR DATOS
	public function r_email(){
		if (!empty($this -> email)) {
			echo 'value = "'.$this -> email.'"';
		}
	}
}