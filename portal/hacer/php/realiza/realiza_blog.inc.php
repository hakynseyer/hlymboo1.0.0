<?php
namespace realiza_blog;

	require_once 'validaciones_generales.inc.php';

class blog extends \v_generales{
	protected $usar = 'crud_blog';

	private $personaje;
		private $e_personaje;
	private $fragmento;
		private $e_fragmento;
	private $imagen;
		private $e_imagen;
	private $categoria;
		private $e_categoria;
	private $clasificacion;
		private $e_clasificacion;
	private $titulo;
		private $e_titulo;
	private $familia;
		private $e_familia;
	private $url;
		// private $e_url;
	private $texto;
		private $e_texto;
	private $archivo;
		private $e_archivo;
	private $archivoactivo;
		private $e_archivoactivo;
	private $derechos;
		private $e_derechos;
	private $estado;
		private $e_estado;
	private $id;
		private $e_id;

	private $val_contenido;

	private $E_inicio;
	private $E_fin;
//  14 parametros
	public function __construct($personaje, $fragmento, $imagen, $categoria, $clasificacion, $titulo, $familia, $texto, $archivo, $archivoactivo, $derechos, $estado, $id, $hyzher){
		$this -> personaje = $this -> a_inyeccion($personaje);
		$this -> fragmento = $this -> a_inyeccion($fragmento);
		$this -> imagen = $this -> a_inyeccion($imagen);
		$this -> categoria = $this -> a_inyeccion($categoria);
		$this -> clasificacion = $this -> a_inyeccion($clasificacion);
		$this -> titulo = $this -> a_inyeccion(ucwords(strtolower($titulo)));
		$this -> familia = $this -> a_inyeccion(ucwords(strtolower($familia)));
		$this -> texto = $this -> a_inyeccion($texto);
		$this -> archivo = $this -> a_inyeccion($archivo);
		$this -> archivoactivo = $this -> a_inyeccion($archivoactivo);
		$this -> derechos = $this -> a_inyeccion($derechos);
		$this -> estado = $this -> a_inyeccion($estado);
		$this -> id = $this -> a_inyeccion($id);
		
		$this -> val_contenido = null;

		$this -> E_inicio = '<div class="grupo-form" id="El_Error"><div class="error"><i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp; ';
		$this -> E_fin = '</div></div>';

		$this -> e_personaje = $this -> v_personaje($this -> personaje, $hyzher);
		$this -> e_fragmento = $this -> v_fragmento($this -> fragmento, $hyzher);
		$this -> e_imagen = $this -> v_imagen($this -> imagen, $hyzher);
		$this -> e_categoria = $this -> v_categoria($this -> categoria);
		$this -> e_clasificacion = $this -> v_clasificacion($this -> clasificacion);
		$this -> e_titulo = $this -> v_titulo($this -> titulo);
		$this -> e_familia = $this -> v_familia($this -> familia, $hyzher);
		$this -> e_texto = $this -> v_texto($this -> texto);
		$this -> e_archivo = $this -> v_archivo($this -> archivo, $hyzher);
		$this -> e_archivoactivo = $this -> v_archivoactivo($this -> archivoactivo, $this -> id, $hyzher);
		$this -> e_derechos = $this -> v_derechos($this -> derechos);
		$this -> e_estado = $this -> v_estado($this -> estado, $this -> id, $hyzher);
		$this -> e_id = $this -> v_id($this -> id, $hyzher);
	}

	// AREA DE VALIDACIONES
	private function v_personaje($personaje, $hyzher){
		$parametros = array(0 => $personaje, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'per_hyzher');
		if ($buscar === true) {
			$this -> personaje = null;
		}
		return '';
	}
	private function v_fragmento($fragmento, $hyzher){
		$parametros = array(0 => $fragmento, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'frag_hyzher');
		if ($buscar === true) {
			$this -> fragmento = null;
		}
		return '';
	}
	private function v_imagen($imagen, $hyzher){
		$parametros = array(0 => $imagen, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'img_hyzher');
		if ($buscar === true) {
			$this -> imagen = null;
		}
		return '';
	}
	private function v_archivo($archivo, $hyzher){
		$parametros = array(0 => $archivo, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'arch_hyzher');
		if ($buscar === true) {
			$this -> archivo = null;
		}
		return '';
	}
	private function v_categoria($categoria){
		if ($this -> v_vacio($categoria) == false) {
			return 'Ha ocurrido un error con la captura de la categoria, no se ha podido procesar bien la solicitud';
		}
		$buscar = $this -> v_busqueda($categoria, 'cat_global');
		if ($buscar === true) {
			return 'La dirección de la categoria no concuerda con los registros globales de categorias... Error de vinvulo';
		}
		return '';
	}
	private function v_clasificacion($clasificacion){
		if ($this -> v_vacio($clasificacion) == false) {
			return 'Ha ocurrido un error con la captura de la clasificacion, no se ha podido procesar bien la solicitud';
		}
		$buscar = $this -> v_busqueda($clasificacion, 'cla_global');
		if ($buscar === true) {
			return 'La dirección de la clasificacion no concuerda con los registros globales de clasificaciones... Error de vinvulo';
		}
		return '';
	}
	private function v_titulo($titulo){
		$similar = $this -> v_similar($titulo, 5, 50, 'Titulo');
		if ($similar !== '') {
			return $similar;
		}
		$buscar = $this -> v_busqueda($titulo, 'titulo');
		if ($buscar === false) {
			return 'Existe otro blog con el mismo titulo que el tuyo... Cambia el titulo de tu blog y vuelvelo a intentar';
		}
		$la_url = str_replace(" ", "-", $titulo);
		$buscar2 = $this -> v_busqueda($la_url, 'url');
		if ($buscar === false) {
			return 'La url creada para tu blog coincide con otra ya existente... Cambia el titulo de tu blog y vuelvelo a intentar';
		}
		$this -> url = $la_url;
		return '';
	}
	private function v_familia($familia, $hyzher){
		$similar = $this -> v_similar($familia, 5, 40, 'Familia');
		if ($similar !== '') {
			return $similar;
		}
		$parametros = array(0 => $familia, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'familia');
		if ($buscar === false) {
			return 'Existe otro blog con la misma familia que el tuyo... Cambia la familia de tu blog y vuelvelo a intentar';
		}
		return '';
	}
	private function v_derechos($derechos){
		$similar = $this -> v_similar($derechos, 5, 255, 'Derechos');
		if ($similar !== '') {
			return $similar;
		}
		// $buscar = $this -> v_busqueda($derechos, 'derechos');
		// if ($buscar === false) {
		// 	return 'Existe otro blog con los mismos derechos que el tuyo... Revisa atentamente tus derechos de autor y si existe una confusión, anomalia, contacta con algún superior';
		// }
		return '';
	}
	private function v_texto($texto){
		$similar = $this -> v_similar($texto, 100, -1, 'Contenido');
		if ($similar !== '') {
			return $similar;
		}
		return '';
	}
	private function v_archivoactivo($archivoactivo, $id, $hyzher){
		if (!isset($archivoactivo) && $archivoactivo < 0 && $archivoactivo > 1) {
			return 'Ha ocurrido un error con la selección del estado de las opiniones, no se ha capturado la solicitud de la actividad';
		}
		return '';
	}
	private function v_estado($estado, $id, $hyzher){
		$buscar = null;
		if (!isset($estado) && $estado < 0 && $estado > 1) {
			return 'Ha ocurrido un error con el estado del blog, no se ha capturado la solicitud del estado';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$this -> val_contenido = $this -> a_conseguir($parametros, '', 'blog_contenido', false);
		return '';
	}
	private function v_id($id, $hyzher){
		if ($this -> v_vacio($id) == false) {
			return 'Ha ocurrido un error con la dirección del blog, no se ha capturado la solicitud de la dirección';
		}
		$parametros = array(0 => $id, 1 => $hyzher);
		$buscar = $this -> v_busqueda($parametros, 'blog_hyzher');
		if ($buscar === true) {
			return 'La dirección del blog no concuerda con el dueño del blog... Error de legitimidad';
		}
		return '';
	}

	// AREA DE RESULTADOS DE VALIDACIONES
	public function v_nuevo(){
		if ($this -> e_categoria === '' && $this -> e_clasificacion === '' && $this -> e_titulo === '' && $this -> e_familia === '') {
			return true;
		}
		return false;
	}
	public function v_contenido(){
		if ($this -> e_texto === '' && $this -> e_id === '') {
			return true;
		}
		return false;
	}
	public function v_detalle(){
		if ($this -> e_categoria === '' && $this -> e_clasificacion === '' && $this -> e_familia === '' && $this -> e_estado === '' && $this -> e_id === '' && $this -> e_derechos === '') {
			return true;
		}
		return false;
	}
	public function v_pfi(){
		if ($this -> e_personaje === '' && $this -> e_fragmento === '' && $this -> e_imagen === '' && $this -> e_archivo === '' && $this -> e_archivoactivo === '') {
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
	public function tabla_blogs($titulo, $hyzher, $ordenar){
		$tabla = [];
		$n_titulo = $this -> a_inyeccion($titulo);
		if (!empty($n_titulo) || !empty($hyzher)) {
			$parametros = array(0 => '%'.$n_titulo.'%', 1 => $hyzher);
			$tabla = $this -> a_conseguir($parametros, $ordenar, 'tabla_blogs', true);
		}
		return $tabla;
	}
	public function ajax_blogs($dato, $buscar, $hyzher, $ordenar){
		$respuesta = null;
		$n_dato = $this -> a_inyeccion($dato);
		if ((!empty($n_dato) || !empty($hyzher)) && (isset($buscar) && !empty($buscar))) {
			switch ($buscar) {
				case 'ID':
					$parametros = array(0 => $n_dato, 1 => $hyzher);
					$respuesta = $this -> a_conseguir($parametros, $ordenar, 'blog_ID', false);
					break;
			}
		}
		return $respuesta;
	}
	public function familia_blogs($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'blog_familia', true);
		}
		return $respuesta;
	}
	public function categorias_blogs(){
		$respuesta = [];
		$respuesta = $this -> a_conseguir('', '', 'las_categorias', true);
		return $respuesta;
	}
	public function clasificaciones_blogs(){
		$respuesta = [];
		$respuesta = $this -> a_conseguir('', '', 'las_clasificaciones', true);
		return $respuesta;
	}
	public function blogs_contados($hyzher){
		$respuesta = null;
		$respuesta = $this -> a_conseguir($hyzher, '', 'blog_contados', false);
		return $respuesta;
	}
	public function mis_personajes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_personajes', true);
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
	public function mis_imagenes($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_imagenes', true);
		}
		return $respuesta;
	}
	public function mis_archivos($hyzher){
		$respuesta = [];
		if (!empty($hyzher)) {
			$respuesta = $this -> a_conseguir($hyzher, '', 'mis_archivos', true);
		}
		return $respuesta;
	}

	// AREA PASAR DATOS
	public function pasar_personaje(){
		return $this -> personaje;
	}
	public function pasar_fragmento(){
		return $this -> fragmento;
	}
	public function pasar_imagen(){
		return $this -> imagen;
	}
	public function pasar_categoria(){
		return $this -> categoria;
	}
	public function pasar_clasificacion(){
		return $this -> clasificacion;
	}
	public function pasar_titulo(){
		return $this -> titulo;
	}
	public function pasar_familia(){
		return $this -> familia;
	}
	public function pasar_url(){
		return $this -> url;
	}
	public function pasar_texto(){
		return $this -> texto;
	}
	public function pasar_archivo(){
		return $this -> archivo;
	}
	public function pasar_archivoactivo(){
		return $this -> archivoactivo;
	}
	public function pasar_derechos(){
		return $this -> derechos;
	}
	public function pasar_estado(){
		return $this -> estado;
	}
	public function pasar_id(){
		return $this -> id;
	}
	public function pasar_estado_contenido(){
		return $this -> val_contenido;
	}

	// AREA DE MOSTRAR ERRORES
	public function m_Epersonaje(){
		if ($this -> e_personaje !== '') {
			echo $this -> E_inicio.$this -> e_personaje.$this -> E_fin;
		}
	}
	public function m_Efragmento(){
		if ($this -> e_fragmento !== '') {
			echo $this -> E_inicio.$this -> e_fragmento.$this -> E_fin;
		}
	}
	public function m_Eimagen(){
		if ($this -> e_imagen !== '') {
			echo $this -> E_inicio.$this -> e_imagen.$this -> E_fin;
		}
	}
	public function m_Ecategoria(){
		if ($this -> e_categoria !== '') {
			echo $this -> E_inicio.$this -> e_categoria.$this -> E_fin;
		}
	}
	public function m_Eclasificacion(){
		if ($this -> e_clasificacion !== '') {
			echo $this -> E_inicio.$this -> e_clasificacion.$this -> E_fin;
		}
	}
	public function m_Etitulo(){
		if ($this -> e_titulo !== '') {
			echo $this -> E_inicio.$this -> e_titulo.$this -> E_fin;
		}
	}
	public function m_Efamilia(){
		if ($this -> e_familia !== '') {
			echo $this -> E_inicio.$this -> e_familia.$this -> E_fin;
		}
	}
	public function m_Etexto(){
		if ($this -> e_texto !== '') {
			echo $this -> E_inicio.$this -> e_texto.$this -> E_fin;
		}
	}
	public function m_Earchivo(){
		if ($this -> e_archivo !== '') {
			echo $this -> E_inicio.$this -> e_archivo.$this -> E_fin;
		}
	}
	public function m_Earchivoactivo(){
		if ($this -> e_archivoactivo !== '') {
			echo $this -> E_inicio.$this -> e_archivoactivo.$this -> E_fin;
		}
	}
	public function m_Ederechos(){
		if ($this -> e_derechos !== '') {
			echo $this -> E_inicio.$this -> e_derechos.$this -> E_fin;
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
	public function r_titulo(){
		if (!empty($this -> titulo)) {
			echo 'value = "'.$this -> titulo.'"';
		}
	}
	public function r_familia(){
		if (!empty($this -> familia)) {
			echo 'value = "'.$this -> familia.'"';
		}
	}
	public function r_texto(){
		if (!empty($this -> texto)) {
			echo $this -> texto;
		}
	}
	public function r_derechos(){
		if (!empty($this -> derechos)) {
			echo $this -> derechos;
		}
	}
	public function r_id(){
		if (!empty($this -> id)) {
			echo 'value = "'.$this -> id.'"';
		}
	}
	public function r_imagen(){
		if (!empty($this -> imagen)) {
			echo 'value = "'.$this -> imagen.'"';
		}
	}
}