<?php

	use \crud_hyzher\hyzher as v_hyzher;
	use \crud_fragmento\fragmento as v_fragmento;
	use \crud_archivo\archivo as v_archivo;
	use \crud_imagen\imagen as v_imagen;
	use \crud_personaje\personaje as v_personaje;
	use \crud_leyenda\leyenda as v_leyenda;
	use \crud_blog\blog as v_blog;
	use \crud_grado\grado as v_grado;
	use \crud_categoria\categoria as v_categoria;
	use \crud_clasificacion\clasificacion as v_clasificacion;
	use \crud_tarea\tarea as v_tarea;
	use \crud_spam\spam as v_spam;
	use \crud_opinion\opinion as v_opinion;
	use \crud_perfil\perfil as v_perfil;
	use \crud_detalles\detalles as v_detalles;
	use \crud_nucleo\nucleo as v_nucleo;
	use \crud_ingreso\ingreso as v_ingreso;

class v_generales{

	protected function v_similar($dato, $min, $max, $titulo){
		$contenido = $this -> v_vacio($dato);
		$minimo = $this -> v_lmin($min, $dato);
		$maximo = $this -> v_lmax($max, $dato);

		if ($contenido === false) {
			return 'Hubo un error con el campo "'.$titulo.'", este campo no puede estar vacio, este campo es "obligatorio".';
		}
		if ($minimo[0] === false) {
			return 'Campo "'.$titulo.'" faltante en número de letras, el mínimo necesario es de "'.$min.' letras" (contando espaciados). Tu campo tiene "'.$minimo[1].' letras".';
		}
		if ($maximo[0] === false) {
			return 'Campo "'.$titulo.'" sobrante en número de letras, el máximo permitido es de "'.$max.' letras" (contando espaciados). Tu campo tiene "'.$maximo[1].' letras".';
		}
		return '';
	}
	
	protected function v_vacio($dato){
		$validado = false;
		if (isset($dato) && !empty($dato)) {
			$validado = true;
		}
		return $validado;
	}
	protected function v_lmin($min, $dato){
		$validado = array(0 => false, 1 => strlen($dato));
		if ($min === -1) {
			$validado[0] = true;
		}
		if (strlen($dato) >= $min) {
			$validado[0] = true;
		}
		return $validado;
	}
	protected function v_lmax($max, $dato){
		$validado = array(0 => false, 1 => strlen($dato));
		if ($max === -1) {
			$validado[0] = true;
		}
		if (strlen($dato) <= $max) {
			$validado[0] = true;
		}
		return $validado;
	}
	protected function v_igual($dato){
		$validado = false;
		if (is_array($dato) && count($dato) > 1) {
			switch (count($dato)) {
				case 2:
					if ($dato[0] === $dato[1]) {
						$validado = true;
					}
					break;
			}
		}
		return $validado;
	}
	protected function v_busqueda($dato, $op){
		$validado = false; //SI EXISTE
		if (isset($this -> usar) && !empty($this -> usar)) {
			switch ($this -> usar) {
				case 'crud_hyzher':
					if (v_hyzher::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_fragmento':
					if (v_fragmento::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_archivo':
					if (v_archivo::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_imagen':
					if (v_imagen::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_personaje':
					if (v_personaje::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_leyenda':
					if (v_leyenda::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_blog':
					if (v_blog::validar($dato, $op) === false) {
						$validado = true; //No existe
					}
					break;
				case 'crud_grado':
					if(v_grado::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_categoria':
					if(v_categoria::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_clasificacion':
					if(v_clasificacion::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_tarea':
					if(v_tarea::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_spam':
					if(v_spam::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_opinion':
					if(v_opinion::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_perfil':
					if(v_perfil::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_detalles':
					if(v_detalles::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_nucleo':
					if(v_nucleo::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
				case 'crud_ingreso':
					if(v_ingreso::validar($dato, $op) === false){
						$validado = true; //No existe
					}
					break;
			}
		}
		return $validado;
	}

	protected function a_inyeccion($dato){
		$no_admitidos = array('<script>', '</script>', '<script type=', '<script src', '<?php', '?>');
		$nuevo_dato = str_replace($no_admitidos, "", $dato);
		// $nuevo_dato2 = strip_tags($nuevo_dato);
		return $nuevo_dato;
	}
	protected function a_insertar($dato, $insertar, $titulo){
		$nuevo_dato = null;
		if (is_array($insertar)) {
			switch ($titulo) {
				case 'inicio_fin':
					$nuevo_dato = $insertar[0].$dato.$insertar[1];
					break;
			}
		}
		return $nuevo_dato;
	}
	protected function a_quitar($dato, $quitar){
		$nuevo_dato = null;
		$nuevo_dato = str_replace($quitar, "", $dato);
		return $nuevo_dato;
	}
	private static function a_quitar_self($dato, $quitar){
		$nuevo_dato = null;
		$nuevo_dato = str_replace($quitar, "", $dato);
		return $nuevo_dato;
	}
	protected function a_examinar($dato, $texto){
		$encontrado = false;
		if (is_array($texto)) {
			switch (count($texto)) {
				case 2:
					if (strpos($dato, $texto[0]) || strpos($dato, $texto[1])) {
						$encontrado = true;
					}
					break;
			}
		}else{
			if (strpos($dato, $texto)) {
				$encontrado = true;
			}
		}
		return $encontrado;
	}
	protected function a_permitido($dato, $solo){
		$encontrado = array(0 => "invalido");
		$letras = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','ñ','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Ñ','Z','X','C','V','B','N','M');
		$numeros = array(1,2,3,4,5,6,7,8,9,0,'1','2','3','4','5','6','7','8','9','0');
		if (isset($solo) && !empty($solo)) {
			switch ($solo) {
				case 'todo':
					$encontrado = array(0 => "todo");
					break;
				case 'letras':
					for ($i=0; $i < count($numeros) ; $i++) { 
						if (strpos($dato, $numeros[$i])) {
							$encontrado = array(0 => "prohibido", 1 => "LETRAS");
							return $encontrado;
						}else{
							$encontrado = array(0 => "letras");
						}
					}
					break;
				case 'numeros':
					for ($i=0; $i < count($letras) ; $i++) { 
						if (strpos($dato,$letras[$i])) {
							$encontrado = array(0 => "prohibido", 1 => "NUMEROS");
							return $encontrado;
						}else{
							$encontrado = array(0 => "numeros");
						}
					}
					break;
			}
		}
		return $encontrado;
	}
	protected function a_conseguir($buscar, $ordenar, $op, $array){
		if ($array === false) {
			$dato = null;
		}else{
			$dato = [];
		}
		if (isset($this -> usar) && !empty($this -> usar)) {
			switch ($this -> usar) {
				case 'crud_hyzher':
					$dato = v_hyzher::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_fragmento':
					$dato = v_fragmento::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_imagen':
					$dato = v_imagen::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_archivo':
					$dato = v_archivo::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_personaje':
					$dato = v_personaje::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_leyenda':
					$dato = v_leyenda::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_blog':
					$dato = v_blog::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_grado':
					$dato = v_grado::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_categoria':
					$dato = v_categoria::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_clasificacion':
					$dato = v_clasificacion::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_tarea':
					$dato = v_tarea::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_spam':
					$dato = v_spam::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_opinion':
					$dato = v_opinion::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_perfil':
					$dato = v_perfil::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_detalles':
					$dato = v_detalles::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_nucleo':
					$dato = v_nucleo::mostrar($buscar, $op, $ordenar);
					break;
				case 'crud_ingreso':
					$dato = v_ingreso::mostrar($buscar, $op, $ordenar);
					break;
			}
		}
		return $dato;
	}

	public function nombre_estado($estado){
		$n_estado = '';
		if (isset($estado)) {
			switch ($estado) {
				case 0:
					$n_estado = 'Oculto';
					break;
				case 1:
					$n_estado = 'Visible';
					break;
				default:
					$n_estado = $estado;
					break;
			}
		}
		return $n_estado;
	}
		private function meses($m){
			$mes = null;
			switch ($m) {
				case '01':
					$mes = 'Enero';
					break;
				case '02':
					$mes = 'Febrero';
					break;
				case '03':
					$mes = 'Marzo';
					break;
				case '04':
					$mes = 'Abril';
					break;
				case '05':
					$mes = 'Mayo';
					break;
				case '06':
					$mes = 'Junio';
					break;
				case '07':
					$mes = 'Julio';
					break;
				case '08':
					$mes = 'Agosto';
					break;
				case '09':
					$mes = 'Septiembre';
					break;
				case '10':
					$mes = 'Octubre';
					break;
				case '11':
					$mes = 'Noviembre';
					break;
				case '12':	
					$mes = 'Diciembre';
					break;
			}
			return $mes;
		}
	public function componer_fecha($fecha, $opcion){
		$n_fecha = null;
		if (isset($fecha) && isset($opcion)) {
			$anio = substr($fecha, -19, -15);
			$mes = $this -> meses(substr($fecha, -14, -12));
			$dia = substr($fecha, -11, -9);
			$horario = substr($fecha, -8);
			switch ($opcion) {
				case 'fecha_hora':
					$n_fecha = '<b>Fecha:</b> <i>'.$dia. ' de '. $mes. ' del '. $anio. '</i><br><b>Tiempo:</b> <i>'. $horario.'</i>';
					break;
				case 'fecha_1':
					$n_fecha = $dia. ' de '. $mes. ' del '. $anio;
					break;
				case 'dia':
					$n_fecha = $dia;
					break;
				case 'mes':
					$n_fecha = substr($fecha, -14, -12);
					break;
				case 'anio':
					$n_fecha = $anio;
					break;
			}
		}
		return $n_fecha;
	}
		private static function meses2($m){
			$mes = null;
			switch ($m) {
				case '01':
					$mes = 'Enero';
					break;
				case '02':
					$mes = 'Febrero';
					break;
				case '03':
					$mes = 'Marzo';
					break;
				case '04':
					$mes = 'Abril';
					break;
				case '05':
					$mes = 'Mayo';
					break;
				case '06':
					$mes = 'Junio';
					break;
				case '07':
					$mes = 'Julio';
					break;
				case '08':
					$mes = 'Agosto';
					break;
				case '09':
					$mes = 'Septiembre';
					break;
				case '10':
					$mes = 'Octubre';
					break;
				case '11':
					$mes = 'Noviembre';
					break;
				case '12':	
					$mes = 'Diciembre';
					break;
			}
			return $mes;
		}
	public static function componer_fecha2($fecha, $opcion){
		$n_fecha = null;
		if (isset($fecha) && isset($opcion)) {
			$anio = substr($fecha, -19, -15);
			$mes = self::meses2(substr($fecha, -14, -12));
			$dia = substr($fecha, -11, -9);
			$horario = substr($fecha, -8);
			switch ($opcion) {
				case 'fecha_hora':
					$n_fecha = '<b>Fecha:</b> <i>'.$dia. ' de '. $mes. ' del '. $anio. '</i><br><b>Tiempo:</b> <i>'. $horario.'</i>';
					break;
				case 'fecha_1':
					$n_fecha = $dia. ' de '. $mes. ' del '. $anio;
					break;
				case 'fecha_2':
					$n_fecha = $dia. ' de '. $mes. ' del '. $anio. ' a las '. $horario;
					break;
				case 'fecha_3':
					$n_fecha = $dia.' / '.substr($fecha, -14, -12).' / '.$anio;
					break;
			}
		}
		return $n_fecha;
	}
	public function componer_ruta($ruta){
		$ruta_compuesta = null;
		$ruta_compuesta = $this ->a_quitar($ruta,$_SERVER['DOCUMENT_ROOT']);
		return $ruta_compuesta;
	}
	public static function componer_ruta_self($ruta){
		$ruta_compuesta = null;
		$ruta_compuesta = self::a_quitar_self($ruta,$_SERVER['DOCUMENT_ROOT']);
		return $ruta_compuesta;
	}

	public static function resumir_texto($texto, $maximo){
		$l_max = $maximo;
		$resultado = null;
		if(strlen($texto) > $l_max){
			for($i = 0; $i <= $l_max; $i++){
				$resultado .= substr($texto, $i, 1);
			}
			$resultado .= "...";
		}else{
			$resultado = $texto;
		}
		return $resultado;
	}
}