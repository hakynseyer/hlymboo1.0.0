<?php
namespace realiza_spam;
	
	require_once 'validaciones_generales.inc.php';

class spam extends \v_generales{
	protected $usar = 'crud_spam';

	private $tipo;
		private $e_tipo;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct($tipo, $id){
		$this -> tipo = $this -> a_inyeccion($tipo);
		$this -> id = $this -> a_inyeccion($id);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_tipo = $this -> v_tipo($this -> tipo);
		$this -> e_id = $this -> v_id($this -> id);
	}

	//AREA DE VALIDACIONES
	private function v_tipo($tipo){
		$similar = $this -> v_similar($tipo, 3, 10, 'Tipo');
		if($similar !== ''){
			return $similar;
		}
		$buscar = $this -> v_busqueda($tipo, 'tipo');
		if($buscar === false){
			return 'Existe otro spam con el mismo atributo tipo... Error de duplicación';
		}
		return '';
	}
	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del spam, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($id, 'id');
		if ($buscar === true) {
			return 'No se encuentra el spam a borrar... Error de buscador';
		}
		return '';
	}

	//AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if($this -> e_tipo === ''){
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

	//AREA DE ACCIONES
	public function tabla_spams($tipo, $ordenar){
		$tabla = [];
		$n_tipo = $this -> a_inyeccion($tipo);
		$tabla = $this -> a_conseguir('%'.$n_tipo.'%', $ordenar, 'tabla_spams', true);
		return $tabla;
	}
	public function ajax_spams($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'spam_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function spams_contados(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'spams_contados', false);
		return $respuesta;
	}

	//AREA PASAR DATOS
	public function pasar_tipo(){
		return $this -> tipo;
	}
	public function pasar_id(){
		return $this -> id;
	}

	//AREA DE MOSTRAR ERRORES
	public function m_Etipo(){
		if ($this -> e_tipo !== '') {
			echo $this -> E_inicio.$this -> e_tipo.$this -> E_fin;
		}
	}
	public function m_Eid(){
		if ($this -> e_id !== '') {
			echo $this -> E_inicio.$this -> e_id.$this -> E_fin;
		}
	}

	//AREA DE REGRESAR DATOS
	public function r_tipo(){
		if (!empty($this -> tipo)) {
			echo 'value = "'.$this -> tipo.'"';
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
}