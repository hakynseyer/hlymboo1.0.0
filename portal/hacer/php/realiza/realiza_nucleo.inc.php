<?php
namespace realiza_nucleo;

	require_once 'validaciones_generales.inc.php';

class nucleo extends \v_generales{
	protected $usar = 'crud_nucleo';

	private $hyzher;
		private $e_hyzher;
	private $familia;
		private $e_familia;
	private $familia2;
		private $e_familia2;
	private $cerraduraNueva;
	private $cerradura;
	private $acceso;
		private $e_acceso;
	private $id;
		private $e_id;

	private $E_inicio;
	private $E_fin;

	public function __construct($hyzher, $familia, $cerradura, $id, $familia2){
		$this -> hyzher = $this -> a_inyeccion($hyzher);
		$this -> familia = $this -> a_inyeccion($familia);
		$this -> cerradura = $this -> a_inyeccion($cerradura);
		$this -> id = $this -> a_inyeccion($id);
		$this -> familia2 = $this -> a_inyeccion($familia2);

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_hyzher = $this -> v_hyzher($this -> hyzher);
		$this -> e_familia = $this -> v_familia($this -> familia);
		$this -> e_familia2 = $this -> v_familia2($this -> familia2);
		$this -> e_id = $this -> v_id($this -> id);
		$this -> e_acceso = $this -> v_cerradura_acceso($this -> cerradura, $this -> hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_hyzher($hyzher){
		if ($this -> v_vacio($hyzher) == false) {
			return 'No se ha capturado la información del Hyzher';
		}
		$buscar = $this -> v_busqueda($hyzher, 'hyzher');
		if($buscar === true){
			return 'No se encuentra el Hyzher en nuestros registros... Error de buscador';
		}
		return '';
	}

	private function v_familia($familia){
		$similar = $this -> v_similar($familia, 5, 15, 'Familia');
		if($similar !== ''){
			return $similar;
		}
		$buscar = $this -> v_busqueda($familia, 'familia');
		if($buscar === false){
			$this -> cerraduraNueva = $this -> a_conseguir($familia, '', 'cerradura_familiar', false);
		}else{
			$this -> cerraduraNueva = $this -> generar_clave();
		}
		return '';
	}

	private function v_familia2($familia){
		$similar = $this -> v_similar($familia, 5, 15, 'Familia');
		if($similar !== ''){
			return $similar;
		}
		$buscar = $this -> v_busqueda($familia, 'familia');
		if($buscar === true){
			return 'No se encuentra la familia de solicitud... Error de buscador';
		}
		return '';
	}

	private function generar_clave(){
		$alimento = 'poiuytrewqzxcvbnmlkjhgfdsa';
		$alimento .= 'LKJHGFDSAZXCVBNMYUIOPTREWQ';
		$alimento .= '0987654321';
		$alimento .= ')/&%#$¡?-*;¿!';

		$i = 0;
		$clave = '';
		while($i < 15){
			$randear = rand(0, strlen($alimento)-1);
			$clave.= substr($alimento, $randear, 1);
			$i++;
		}

		return $clave;
	}

	private function v_cerradura_acceso($cerradura, $hyzher){
		$similar = $this -> v_similar($cerradura, -1, -1, 'Cerradura');
		if($similar !== ''){
			return $similar;
		}
		$CerraduraMadre = $this -> a_conseguir($hyzher, '', 'acceso', false);
		$this -> acceso = $this -> a_inyeccion($CerraduraMadre);
		if(is_null($this -> acceso) || $this -> acceso !== $cerradura){
			return 'Se te ha negado el acceso a Hlymboo Hyzher.';
		}
		// if(is_null($this -> acceso) || !password_verify($cerradura, $this -> acceso)){
		// 	return 'Se te ha negado el acceso a Hlymboo Hyzher.';
		// }
		return '';
	}

	private function v_id($id){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del núcleo, no se ha capturado la solicitud de la dirección';
		}
		$buscar = $this -> v_busqueda($id, 'id_nucleo');
		if ($buscar === true) {
			return 'No se encuentra el núcleo a borrar... Error de buscador';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if($this -> e_hyzher === '' && $this -> e_familia === ''){
			return true;
		}
		return false;
	}

	public function v_cambiar_familia_uno(){
		if($this -> e_familia === '' && $this -> e_id === ''){
			return true;
		}
		return false;
	}

	public function v_cambiar_familia_nucleo(){
		if($this -> e_familia === '' && $this -> e_familia2 === ''){
			return true;
		}
		return false;
	}

	public function v_cambiar_cerradura(){
		if($this -> e_familia2 === ''){
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

	public function v_adelante(){
		if ($this -> e_acceso === '' && !is_null($this -> acceso)) {
			return true;
		}
		return false;
	}

	// AREA DE ACCIONES
	public function nueva_cerradura(){
		$this -> cerraduraNueva = $this -> generar_clave();
	}
	
	public function tabla_nucleo($alias, $ordenar){
		$tabla = [];
		$n_alias = $this -> a_inyeccion($alias);
		$tabla = $this -> a_conseguir('%'.$n_alias.'%', $ordenar, 'tabla_nucleo', true);
		return $tabla;
	}

	public function ajax_nucleo($dato, $buscar, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if (!empty($n_dato) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$respuesta = $this -> a_conseguir($n_dato, $ordenar, 'nucleo_ID', false);
					break;
			}
		}
		return $respuesta;
	}

	public function hyzhers_totales(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'hyzhers_totales', false);
		return $respuesta;
	}

	public function hyzhers_nucleo(){
		$respuesta = null;
		$respuesta = $this -> a_conseguir('', '', 'hyzhers_nucleo', false);
		return $respuesta;
	}

	public function tam_familiares($familia){
		$n_familia = $this -> a_inyeccion($familia);
		$respuesta = null;
		$respuesta = $this -> a_conseguir($n_familia, '', 'numero_familiares', false);
		return $respuesta;
	}

	public function hyzhers_faltantes(){
		$seleccion = [];
		$seleccion = $this -> a_conseguir('', '', 'hyzhers_faltantes', true);
		return $seleccion;
	}

	public function familia_nucleo(){
		$seleccion = [];
		$seleccion = $this -> a_conseguir('', '', 'familia_nucleo', true);
		return $seleccion;
	}

	//AREA PASAR DATOS
	public function pasar_hyzher(){
		return $this -> hyzher;
	}

	public function pasar_familia(){
		return $this -> familia;
	}

	public function pasar_familia2(){
		return $this -> familia2;
	}

	public function pasar_cerradura(){
		return $this -> cerraduraNueva;
	}

	public function pasar_id(){
		return $this -> id;
	}

	//AREA DE MOSTRAR ERRORES

	public function m_Ehyzher(){
		if ($this -> e_hyzher !== '') {
			echo $this -> E_inicio.$this -> e_hyzher.$this -> E_fin;
		}
	}

	public function m_Efamilia(){
		if ($this -> e_familia !== '') {
			echo $this -> E_inicio.$this -> e_familia.$this -> E_fin;
		}
	}

	public function m_EfamiliaBuscar(){
		if ($this -> e_familia2 !== '') {
			echo $this -> E_inicio.$this -> e_familia2.$this -> E_fin;
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
	public function r_hyzher(){
		if (!empty($this -> hyzher)) {
			echo 'value = "'.$this -> hyzher.'"';
		}
	}

	public function r_familia(){
		if (!empty($this -> familia)) {
			echo 'value = "'.$this -> familia.'"';
		}
	}

	public function r_familia2(){
		if (!empty($this -> familia2)) {
			echo 'value = "'.$this -> familia2.'"';
		}
	}

	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}

}