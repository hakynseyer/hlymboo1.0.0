<?php
	require_once '../../../configuraciones/flujo/sesion_flujo.inc.php';

	use \realiza_fragmento\fragmento as VF;
	use \realiza_archivo\archivo as VA;
	use \realiza_imagen\imagen as VI;
	use \realiza_personaje\personaje as VP;
	use \realiza_leyenda\leyenda as VL;
    use \realiza_blog\blog as VB;
    use \realiza_grado\grado as VG;
    use \realiza_categoria\categoria as VC;
    use \realiza_clasificacion\clasificacion as VCL;
    use \realiza_tarea\tarea as VT;
    use \realiza_spam\spam as VS;
    use \realiza_opinion\opinion as VO;
    use \realiza_perfil\perfil as VPE;
    use \realiza_detalles\detalles as VD;
    use \realiza_nucleo\nucleo as VN;
    use \realiza_ingreso\ingreso as VIN;

    use \base_opinion\opinion as BO;

    use \crud_opinion\opinion as CO;

$respuesta = array('validado' => false);
$ajax = true;
// $_POST['atributo'] = 'INGRESOS';
// $_POST['buscar'] = 'id';
// $_POST['dato'] = '1';
// $_POST['dato2'] = '2';
if (isset($_POST['atributo']) && !empty($_POST['atributo'])) {
	switch ($_POST['atributo']) {
		case 'FRAGMENTO':
			require_once 'realiza_fragmento.inc.php';
			require_once '../crud/crud_fragmento.inc.php';
			require_once '../base/base_fragmento.inc.php';

			$realiza = new VF('', '', '', '', '', '');

			switch ($_POST['buscar']) {
				case 'id':
					$parametros = $realiza -> ajax_fragmentos($_POST['dato'], 'ID', $Hyzher_id, '');
					break;
			}
			if (isset($parametros) && !empty($parametros) && !is_null($parametros)) {
				
				$id = $parametros -> obtener_ID();
				$titulo = $parametros -> obtener_TITULO();
				$frontal = $parametros -> obtener_LADO1();
				$posterior = $parametros -> obtener_LADO2();
				$creado = $realiza -> componer_fecha($parametros -> obtener_CREADO(), 'fecha_1');
				$modificado = $realiza -> componer_fecha($parametros -> obtener_MODIFICADO(), 'fecha_1');
				$intentos = $parametros -> obtener_INTENTOS();
				$totales = $realiza -> detalles_fragmento($Hyzher_id);
				$estado = $parametros -> obtener_ESTADO();

				$respuesta = array('validado' => true, 'id' => $id, 'titulo' => $titulo, 'frontal' => $frontal, 'posterior' => $posterior, 'creado' => $creado, 'modificado' => $modificado, 'intentos' => $intentos, 'totales' => $totales, 'estado' => $estado);
			}
			break;

		case 'ARCHIVO':
			require_once 'realiza_archivo.inc.php';
			require_once '../crud/crud_archivo.inc.php';
			require_once '../base/base_archivo.inc.php';

			$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
			$realiza = new VA($sn, '', '', '', '', '', '');

			switch ($_POST['buscar']) {
				case 'id':
					$parametros = $realiza -> ajax_archivos($_POST['dato'], 'ID', $Hyzher_id, '');
					break;
			}
			if (isset($parametros) && !empty($parametros) && !is_null($parametros)) {
				
				$id = $parametros -> obtener_ID();
				$titulo = $parametros -> obtener_TITULO();
				$familia = $parametros -> obtener_FAMILIA();
				$derechos = $parametros -> obtener_DERECHOS();
				$notas = $parametros -> obtener_NOTAS();
				$creado = $realiza -> componer_fecha($parametros -> obtener_CREADO(), 'fecha_1');
				$modificado = $realiza -> componer_fecha($parametros -> obtener_MODIFICADO(), 'fecha_1');
				$intentos = $parametros -> obtener_INTENTOS();
				$estado = $parametros -> obtener_ESTADO();

				$respuesta = array('validado' => true, 'id' => $id, 'titulo' => $titulo, 'familia' => $familia, 'derechos' => $derechos, 'notas' => $notas, 'creado' => $creado, 'modificado' => $modificado, 'intentos' => $intentos, 'estado' => $estado);
			}
			break;

		case 'IMAGEN':
				require_once 'realiza_imagen.inc.php';
				require_once '../crud/crud_imagen.inc.php';
				require_once '../base/base_imagen.inc.php';

				$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
				$realiza = new VI($sn, '', '', '', '', '', '');

				switch ($_POST['buscar']) {
					case 'id':
						$parametros = $realiza -> ajax_imagenes($_POST['dato'], 'ID', $Hyzher_id, '');
						break;
				}
				if (isset($parametros) && !empty($parametros) && !is_null($parametros)) {
					
					$id = $parametros -> obtener_ID();
					$titulo = $parametros -> obtener_TITULO();
					$familia = $parametros -> obtener_FAMILIA();
					$fuente = $parametros -> obtener_FUENTE();
					$notas = $parametros -> obtener_NOTAS();
					$creado = $realiza -> componer_fecha($parametros -> obtener_CREADO(), 'fecha_1');
					$modificado = $realiza -> componer_fecha($parametros -> obtener_MODIFICADO(), 'fecha_1');
					$intentos = $parametros -> obtener_INTENTOS();
					$estado = $parametros -> obtener_ESTADO();

					$respuesta = array('validado' => true, 'id' => $id, 'titulo' => $titulo, 'familia' => $familia, 'fuente' => $fuente, 'notas' => $notas, 'creado' => $creado, 'modificado' => $modificado, 'intentos' => $intentos, 'estado' => $estado);
				}
			break;

		case 'PERSONAJE':
				require_once 'realiza_personaje.inc.php';
				require_once '../crud/crud_personaje.inc.php';
				require_once '../base/base_personaje.inc.php';

				$realiza = new VP('', '', '', '', '', '', '', '', '', '', '', '', '');

				switch ($_POST['buscar']) {
					case 'id':
						$parametros = $realiza -> ajax_personajes($_POST['dato'], 'ID', $Hyzher_id, '');
						break;
				}
				if (isset($parametros) && !empty($parametros) && !is_null($parametros)) {
					
					$id = $parametros -> obtener_ID();
					$imagen = $parametros -> obtener_IMAGEN();
					$nombre = $parametros -> obtener_NOMBRE();
					$familia = $parametros -> obtener_FAMILIA();
					$edad = $parametros -> obtener_EDAD();
					$sexo = $parametros -> obtener_SEXO();
					$relacion = $parametros -> obtener_RELACION();
					$personalidad = $parametros -> obtener_PERSONALIDAD();
					$historia = $parametros -> obtener_HISTORIA();
					$metas = $parametros -> obtener_METAS();
					$extras = $parametros -> obtener_EXTRAS();
					$creado = $realiza -> componer_fecha($parametros -> obtener_CREADO(), 'fecha_1');
					$modificado = $realiza -> componer_fecha($parametros -> obtener_MODIFICADO(), 'fecha_1');
					$intentos = $parametros -> obtener_INTENTOS();
					$estado = $parametros -> obtener_ESTADO();

					$respuesta = array('validado' => true, 'id' => $id, 'imagen' => $imagen, 'nombre' => $nombre, 'familia' => $familia, 'edad' => $edad, 'sexo' => $sexo, 'relacion' => $relacion, 'personalidad' => $personalidad, 'historia' => $historia, 'metas' => $metas, 'extras' => $extras, 'creado' => $creado, 'modificado' => $modificado, 'intentos' => $intentos, 'estado' => $estado);
				}
			break;

		case 'LEYENDA':
				require_once 'realiza_leyenda.inc.php';
				require_once '../crud/crud_leyenda.inc.php';
				require_once '../base/base_leyenda.inc.php';

				$realiza = new VL('', '', '', '');

				switch ($_POST['buscar']) {
					case 'id':
						$parametros = $realiza -> ajax_leyendas($_POST['dato'], 'ID', $Hyzher_id, '');
						break;
				}
				if (isset($parametros) && !empty($parametros) && !is_null($parametros)) {
					
					$id = $parametros -> obtener_ID();
					$personaje = $parametros -> obtener_PERSONAJE();
					$escrito = $parametros -> obtener_ESCRITO();

					$respuesta = array('validado' => true, 'id' => $id, 'personaje' => $personaje, 'escrito' => $escrito);
				}
			break;
        
        case 'BLOG':
            require_once 'realiza_blog.inc.php';
            require_once '../crud/crud_blog.inc.php';
            require_once '../base/base_blog.inc.php';
            
            $realiza = new VB('', '', '', '', '', '', '', '', '', '', '', '', '', '');
            
            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_blogs($_POST['dato'], 'ID', $Hyzher_id, '');
                    break;
            }
            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){
                $id = $parametros -> obtener_ID();
                $estado = $parametros -> obtener_ESTADO();
                $familia = $parametros -> obtener_FAMILIA();
                $categoria = $parametros -> obtener_CATEGORIA();
                $clasificacion = $parametros -> obtener_CLASIFICACION();
                $titulo = $parametros -> obtener_TITULO();
                $creado = $realiza -> componer_fecha($parametros -> obtener_CREADO(),'fecha_1');
                $modificado = $realiza -> componer_fecha($parametros -> obtener_MODIFICADO(), 'fecha_1');
                $personaje = $parametros -> obtener_PERSONAJE();
                $fragmento = $parametros -> obtener_FRAGMENTO();
                $imagen = $parametros -> obtener_IMAGEN();
                $archivo = $parametros -> obtener_ARCHIVO();
                $habilitado = $parametros -> obtener_ARCHIVOACTIVO();
                $derechos = $parametros -> obtener_DERECHOS();
                $texto = $parametros -> obtener_TEXTO();
                $respuesta = array('validado' => true, 'id' => $id, 'estado' => $estado,'familia' => $familia, 'categoria' => $categoria, 'clasificacion' => $clasificacion, 'titulo' => $titulo, 'creado' => $creado, 'modificado' => $modificado, 'personaje' => $personaje, 'fragmento' => $fragmento, 'imagen' => $imagen, 'archivo' => $archivo, 'habilitado' => $habilitado, 'derechos' => $derechos, 'texto' => $texto);
            }
            break;
        case 'GRADO':
    	 	require_once 'realiza_grado.inc.php';
            require_once '../crud/crud_grado.inc.php';
            require_once '../base/base_grado.inc.php';

            $realiza = new VG('', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_grados($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

            	$id = $parametros -> obtener_ID();
            	$tipo = $parametros -> obtener_TIPO();

            	$respuesta  = array('validado' => true, 'id' => $id, 'tipo' => $tipo);
            }
        	break;
        case 'CATEGORIA':
        	require_once 'realiza_categoria.inc.php';
            require_once '../crud/crud_categoria.inc.php';
            require_once '../base/base_categoria.inc.php';

            $realiza = new VC('', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_categorias($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

            	$id = $parametros -> obtener_ID();
            	$tipo = $parametros -> obtener_TIPO();

            	$respuesta  = array('validado' => true, 'id' => $id, 'tipo' => $tipo);
            }
        	break;
        case 'CLASIFICACION':
        	require_once 'realiza_clasificacion.inc.php';
            require_once '../crud/crud_clasificacion.inc.php';
            require_once '../base/base_clasificacion.inc.php';

            $realiza = new VCL('', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_clasificaciones($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

            	$id = $parametros -> obtener_ID();
            	$tipo = $parametros -> obtener_TIPO();

            	$respuesta  = array('validado' => true, 'id' => $id, 'tipo' => $tipo);
            }
        	break;
        case 'TAREA':
        	require_once 'realiza_tarea.inc.php';
            require_once '../crud/crud_tarea.inc.php';
            require_once '../base/base_tarea.inc.php';

            $realiza = new VT('', '', '', '', '', '', '', '', '');

            switch($_POST['buscar']){
            	case 'id':
            		$parametros = $realiza -> ajax_tareas($_POST['dato'], 'ID', '');
            		break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

            	$titulo = $parametros -> obtener_BLOG();
            	$familia = $parametros -> obtener_PLANEACION();
            	$publicacion = $parametros -> obtener_PROGRAMADA();
            	$estado = $parametros -> obtener_ESTADO();
            	$descripcion = $parametros -> obtener_DESCRIPCION();
            	$id = $parametros -> obtener_ID();
            	
            	$la_fecha = $publicacion." 00:00:00";
            	$dia = $realiza -> componer_fecha($la_fecha, 'dia');
            	$mes = $realiza -> componer_fecha($la_fecha, 'mes');
            	$anio = $realiza -> componer_fecha($la_fecha, 'anio');
            	$fecha_publicada = $realiza -> componer_fecha($la_fecha, 'fecha_1');

            	$respuesta  = array('validado' => true, 'titulo' => $titulo, 'familia' => $familia, 'publicacion' => $fecha_publicada, 'estado' => $estado, 'descripcion' => $descripcion, 'id' => $id, 'dia' => $dia, 'mes' => $mes, 'anio' => $anio);
            }

        	break;
        case 'PLANEACION':
        	require_once 'realiza_tarea.inc.php';
            require_once '../crud/crud_tarea.inc.php';
            require_once '../base/base_planeacion.inc.php';

            $realiza = new VT('', '', '', '', '', '', '', '', '');

            switch($_POST['buscar']){
            	case 'id':
            		$parametros = $realiza -> ajax_planeaciones($_POST['dato'], 'ID', '');
            		break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){
            	$blog = $parametros -> obtener_ID();
            	$titulo = $parametros -> obtener_BLOG();
            	$progreso = $parametros -> obtener_PROCESO();
            	$etapa1 = $parametros -> obtener_ETAPA1();
            	$etapa2 = $parametros -> obtener_ETAPA2();
            	$etapa3 = $parametros -> obtener_ETAPA3();
            	$etapa4 = $parametros -> obtener_ETAPA4();
            	$etapa5 = $parametros -> obtener_ETAPA5();
            	$etapa6 = $parametros -> obtener_ETAPA6();

            	if($etapa1 !== null){
            		$etapa1 = $realiza -> componer_fecha($etapa1, 'fecha_1');
            	}
            	if($etapa2 !== null){
            		$etapa2 = $realiza -> componer_fecha($etapa2, 'fecha_1');
            	}
            	if($etapa3 !== null){
            		$etapa3 = $realiza -> componer_fecha($etapa3, 'fecha_1');
            	}
            	if($etapa4 !== null){
            		$etapa4 = $realiza -> componer_fecha($etapa4, 'fecha_1');
            	}
            	if($etapa5 !== null){
            		$etapa5 = $realiza -> componer_fecha($etapa5, 'fecha_1');
            	}
            	if($etapa6 !== null){
            		$etapa6 = $realiza -> componer_fecha($etapa6, 'fecha_1');
            	}

            	$respuesta  = array('validado' => true, 'titulo' => $titulo, 'progreso' => $progreso, 'etapa1' => $etapa1, 'etapa2' => $etapa2, 'etapa3' => $etapa3, 'etapa4' => $etapa4, 'etapa5' => $etapa5, 'etapa6' => $etapa6, 'blog' => $blog);
            }

        	break;
        case 'SPAM':
            require_once 'realiza_spam.inc.php';
            require_once '../crud/crud_spam.inc.php';
            require_once '../base/base_spam.inc.php';

            $realiza = new VS('', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_spams($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

                $id = $parametros -> obtener_ID();
                $tipo = $parametros -> obtener_TIPO();

                $respuesta  = array('validado' => true, 'id' => $id, 'tipo' => $tipo);
            }
            break;
        case 'OPINION_ESTADO':
            require_once 'realiza_opinion.inc.php';
            require_once '../crud/crud_opinion.inc.php';
            require_once '../base/base_opinion.inc.php';

            $realiza = new VO('', '', '', '', '', $_POST['id'], '');
            if($realiza -> v_ids()){
                $opinion = new BO($realiza -> pasar_id(), '', '', '', '', '', '', '');
                if(CO::modificar($opinion, 'estado')){
                    $respuesta  = array('validado' => true);
                }
            }
            break;
        case 'OPINION_BORRAR':
            require_once 'realiza_opinion.inc.php';
            require_once '../crud/crud_opinion.inc.php';
            require_once '../base/base_opinion.inc.php';

            $realiza = new VO('', '', '', '', '', $_POST['id'], '');
            if($realiza -> v_ids()){
                $opinion = new BO($realiza -> pasar_id(), '', '', '', '', '', '', '');
                if(CO::eliminar($opinion, 'opinion')){
                    $respuesta  = array('validado' => true);
                }
            }
            break;
        case 'PERFIL':
            require_once 'realiza_perfil.inc.php';
            require_once '../crud/crud_perfil.inc.php';
            require_once '../base/base_perfil.inc.php';

            $realiza = new VPE('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

            switch ($_POST['buscar']){
                case 'id':
                    if(isset($_POST['dato2'])){
                        $LosDatos = array(0 => $_POST['dato'], 1 => $_POST['dato2']);
                        $parametros = $realiza -> ajax_perfil2($LosDatos, 'ID', '');
                    }else{
                        $parametros = $realiza -> ajax_perfil($_POST['dato'], 'ID', '');
                    }
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

                $id = $parametros -> obtener_ID();
                //Estos son solo numeros
                $hyzher = $parametros -> obtener_HYZHER(); 
                $imagen = $parametros -> obtener_IMAGEN();
                $fragmento = $parametros -> obtener_FRAGMENTO();

                $nacimiento = $parametros -> obtener_NACIMIENTO();
                    $la_fecha = $nacimiento." 00:00:00";
                    $dia = $realiza -> componer_fecha($la_fecha, 'dia');
                    $mes = $realiza -> componer_fecha($la_fecha, 'mes');
                    $anio = $realiza -> componer_fecha($la_fecha, 'anio');

                $lugar = $parametros -> obtener_LUGAR();
                $soy = strip_tags($parametros -> obtener_SOY());
                $social1 = $parametros -> obtener_SOCIAL1();
                $social2 = $parametros -> obtener_SOCIAL2();
                $social3 = $parametros -> obtener_SOCIAL3();
                $social4 = $parametros -> obtener_SOCIAL4();
                $etiqueta = $parametros -> obtener_ETIQUETA();
                $estado = $parametros -> obtener_ESTADO();

                $respuesta  = array('validado' => true, 'id' => $id, 'hyzher' => $hyzher, 'imagen' => $imagen, 'fragmento' => $fragmento, 'nacimiento' => $nacimiento, 'dia' => $dia, 'mes' => $mes, 'anio' => $anio, 'lugar' => $lugar, 'soy' => $soy, 'social1' => $social1, 'social2' => $social2, 'social3' => $social3, 'social4' => $social4, 'etiqueta' => $etiqueta, 'estado' => $estado);
            }

            break;
        case 'DETALLES':
            require_once 'realiza_detalles.inc.php';
            require_once '../crud/crud_detalles.inc.php';
            require_once '../base/base_detalles.inc.php';

            $realiza = new VD('', '', '', '', '', '', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_detalles($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

                $id = $parametros -> obtener_ID();
                $fragmento = $parametros -> obtener_FRAGMENTOS();
                $personaje = $parametros -> obtener_PERSONAJES();
                $tarea = $parametros -> obtener_TAREAS();
                $leyenda = $parametros -> obtener_LEYENDAS();
                $autor = $parametros -> obtener_HYZHER();

                $respuesta  = array('validado' => true, 'id' => $id, 'fragmentos' => $fragmento, 'personajes' => $personaje, 'tareas' => $tarea, 'leyendas' => $leyenda, 'hyzher' => $autor);
            }

            break;
        case 'NUCLEOS':
            require_once 'realiza_nucleo.inc.php';
            require_once '../crud/crud_nucleo.inc.php';
            require_once '../base/base_nucleo.inc.php';

            $realiza = new VN('', '', '', '', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_nucleo($_POST['dato'], 'ID', '');
                    $tam_familia = $realiza -> tam_familiares($parametros -> obtener_FAMILIA());
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

                $id = $parametros -> obtener_ID();
                $hyzher = $parametros -> obtener_HYZHER();
                $familia = $parametros -> obtener_FAMILIA();
                $familia_numero = $parametros -> obtener_FAMILIA().' ( '.$tam_familia.' )';
                $cerradura = $parametros -> obtener_CERRADURA();
                $creado = $parametros -> obtener_CREADO();

                if($creado !== null){
                    $creado = $realiza -> componer_fecha($creado, 'fecha_1');
                }

                $respuesta  = array('validado' => true, 'id' => $id, 'hyzher' => $hyzher, 'familia' => $familia, 'familia_numero' => $familia_numero, 'cerradura' => $cerradura, 'creado' => $creado);
            }

            break;
        case 'INGRESOS':
            require_once 'realiza_ingreso.inc.php';
            require_once '../crud/crud_ingreso.inc.php';
            require_once '../base/base_ingreso.inc.php';

            $realiza = new VIN('', '', '', '');

            switch ($_POST['buscar']){
                case 'id':
                    $parametros = $realiza -> ajax_ingresos($_POST['dato'], 'ID', '');
                    break;
            }

            if (isset($parametros) && !empty($parametros) && !is_null($parametros)){

                $id = $parametros -> obtener_ID();
                $user = $parametros -> obtener_USER();
                $email = $parametros -> obtener_EMAIL();

                $respuesta  = array('validado' => true, 'id' => $id, 'user' => $user, 'email' => $email);
            }

            break;
	}
}
echo json_encode($respuesta);