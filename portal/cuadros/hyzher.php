<?php
ob_start();
if (isset($Accion_Hyzher) && !empty($Accion_Hyzher)) {
	switch ($Accion_Hyzher) {
		case 'fragmentos':
			require_once 'portal/hacer/php/base/base_fragmento.inc.php';
			require_once 'portal/hacer/php/crud/crud_fragmento.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_fragmento.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/fragmentos.inc.php'; 
			break;
		case 'leyendas':
			require_once 'portal/hacer/php/base/base_leyenda.inc.php';
			require_once 'portal/hacer/php/base/base_personaje.inc.php';
			require_once 'portal/hacer/php/crud/crud_leyenda.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_leyenda.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/leyendas.inc.php';
			break;
		case 'imagenes':
			require_once 'portal/hacer/php/base/base_imagen.inc.php';
			require_once 'portal/hacer/php/crud/crud_imagen.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_imagen.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/imagenes.inc.php';
			break;
		case 'archivos':
			require_once 'portal/hacer/php/base/base_archivo.inc.php';
			require_once 'portal/hacer/php/crud/crud_archivo.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_archivo.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/archivos.inc.php';
			break;
		case 'blogs':
			require_once 'portal/hacer/php/base/base_blog.inc.php';
			require_once 'portal/hacer/php/base/base_categoria.inc.php';
			require_once 'portal/hacer/php/base/base_clasificacion.inc.php';
			require_once 'portal/hacer/php/base/base_personaje.inc.php';
			require_once 'portal/hacer/php/base/base_fragmento.inc.php';
			require_once 'portal/hacer/php/base/base_imagen.inc.php';
			require_once 'portal/hacer/php/base/base_archivo.inc.php';
			require_once 'portal/hacer/php/crud/crud_blog.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_blog.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/blogs.inc.php';
			break;
		case 'tareas':
			require_once 'portal/hacer/php/base/base_tarea.inc.php';
			require_once 'portal/hacer/php/base/base_blog.inc.php';
			require_once 'portal/hacer/php/base/base_planeacion.inc.php';
			require_once 'portal/hacer/php/crud/crud_tarea.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_tarea.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/tareas.inc.php';
			break;
		case 'opiniones':
			require_once 'portal/hacer/php/base/base_opinion.inc.php';
			require_once 'portal/hacer/php/base/base_spam.inc.php';
			require_once 'portal/hacer/php/crud/crud_opinion.inc.php';
			require_once 'portal/hacer/php/crud/crud_spam.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_opinion.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/opiniones.inc.php';
			break;
		case 'personajes':
			require_once 'portal/hacer/php/base/base_personaje.inc.php';
			require_once 'portal/hacer/php/base/base_imagen.inc.php';
			require_once 'portal/hacer/php/crud/crud_personaje.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_personaje.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/personajes.inc.php';
			break;
		case 'perfiles':
			require_once 'portal/hacer/php/base/base_perfil.inc.php';
			require_once 'portal/hacer/php/base/base_imagen.inc.php';
			require_once 'portal/hacer/php/base/base_fragmento.inc.php';
			require_once 'portal/hacer/php/crud/crud_perfil.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_perfil.inc.php';
			$incorporar = 'portal/hacer/ventanas/hyzher/perfiles.inc.php';
			break;
		case 'tablon_entrada':
			require_once 'portal/hacer/php/base/base_tablones.inc.php';
			require_once 'portal/hacer/php/crud/crud_tarea.inc.php';
			require_once 'portal/hacer/php/realiza/realiza_tablones.inc.php';
			$incorporar = 'portal/hacer/ventanas/entradas/tablon_entrada.inc.php';
			break;
		default:
			if(isset($HLyzher) && $HLyzher === true){
				switch ($Accion_Hyzher) {
					case 'categorias':
						require_once 'portal/hacer/php/base/base_categoria.inc.php';
						require_once 'portal/hacer/php/crud/crud_categoria.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_categoria.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/categorias.inc.php';
						break;
					case 'clasificaciones':
						require_once 'portal/hacer/php/base/base_clasificacion.inc.php';
						require_once 'portal/hacer/php/crud/crud_clasificacion.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_clasificacion.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/clasificaciones.inc.php';
						break;
					case 'spams':
						require_once 'portal/hacer/php/base/base_spam.inc.php';
						require_once 'portal/hacer/php/crud/crud_spam.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_spam.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/spams.inc.php';
						break;
					case 'grados':
						require_once 'portal/hacer/php/base/base_grado.inc.php';
						require_once 'portal/hacer/php/crud/crud_grado.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_grado.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/grados.inc.php';
						break;
					case 'etiquetas':
						require_once 'portal/hacer/php/base/base_perfil.inc.php';
						require_once 'portal/hacer/php/crud/crud_perfil.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_perfil.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/etiquetas.inc.php';
						break;
					case 'detalles':
						require_once 'portal/hacer/php/base/base_detalles.inc.php';
						require_once 'portal/hacer/php/crud/crud_detalles.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_detalles.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/detalles.inc.php';
						break;
					case 'nucleos':
						require_once 'portal/hacer/php/base/base_nucleo.inc.php';
						require_once 'portal/hacer/php/base/base_hyzher.inc.php';
						require_once 'portal/hacer/php/crud/crud_nucleo.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_nucleo.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/nucleos.inc.php';
						break;
					case 'ingresos':
						require_once 'portal/hacer/php/base/base_ingreso.inc.php';
						require_once 'portal/hacer/php/crud/crud_ingreso.inc.php';
						require_once 'portal/hacer/php/realiza/realiza_ingreso.inc.php';
						$incorporar = 'portal/hacer/ventanas/hyzher/ingresos.inc.php';
						break;
					default:
						redireccion::redirigir(HOME);
						break;
				}
			}else{
				redireccion::redirigir(HOME);
			}
			break;
	}
}else{
	$incorporar = 'portal/hacer/ventanas/hzoul/hyzher.inc.php';
}

// ********************************************************************************************* \\
	
		$Titulo = 'Panel informativo Hyzhers';
		$Script = TINYMCE;
		$Menu_HZ = true;
		$Fragmento = false;
		$Contenido[] = true;
		$Contenido[] = $incorporar;		

// ********************************************************************************************* \\
	
include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
include_once('portal/cuadros/plantillas/piedra_header.inc.php');	
include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');
include_once('portal/cuadros/plantillas/piedra_madre.inc.php');
include_once('portal/cuadros/plantillas/piedra_publicados.inc.php');
include_once('portal/cuadros/plantillas/piedra_remitente.inc.php');
include_once('portal/cuadros/plantillas/piedra_salida.inc.php');
ob_end_flush();
?>
<script>
	$(document).ready(function(){
	    Galletas.eraseCookie("menuHeader");
	    pegarHeader(false);
	});
</script>