<?php
ob_start();
	use \crud_blog\blog as BD;
if(isset($Accion_Entrada) && !empty($Accion_Entrada)){	
	require_once 'portal/hacer/php/base/base_blog.inc.php';
	require_once 'portal/hacer/php/base/base_spam.inc.php';
	require_once 'portal/hacer/php/base/base_opinion.inc.php';
	require_once 'portal/hacer/php/base/base_planeacion.inc.php';
	require_once 'portal/hacer/php/base/base_fragmento.inc.php';
	require_once 'portal/hacer/php/base/base_perfil.inc.php';
	require_once 'portal/hacer/php/base/base_personaje.inc.php';
	require_once 'portal/hacer/php/crud/crud_blog.inc.php';
	require_once 'portal/hacer/php/crud/crud_spam.inc.php';
	require_once 'portal/hacer/php/crud/crud_opinion.inc.php';
	require_once 'portal/hacer/php/realiza/realiza_opinion.inc.php';
	require_once 'portal/hacer/php/realiza/construye/panel_ultimas_entradas.inc.php';

	$ValoresProhibidos = array('<script>', '</script>', '<script type=', '<script src', '<?php', '?>', '<htm>', '</html>');
	$NuevaAccionEntrada = str_replace($ValoresProhibidos, "", $Accion_Entrada);

	if(isset($_GET['Ent_Hyzh']) && !empty($_GET['Ent_Hyzh'])){
		if(password_verify('1UnLoRoMoradO1', $_GET['Ent_Hyzh'])){
			if($Hyzher){
				$ParametrosEntrada = array(0 => $NuevaAccionEntrada, 1 => $Hyzher_id);
				$EntradaNormal = BD::mostrar($ParametrosEntrada,'obtenerEntradaHyzher','');
				$EntSimilar = false;
				$Opiniones = false;
				?>
				<div class="advertencia-vista">
					Entrada en modo de vista para "<?php echo $Hyzher_usuario;?>"... Esta entrada puede no estar publicada.
				</div>
				<?php
			}else{
				$EntradaNormal = BD::mostrar($NuevaAccionEntrada,'obtenerEntradaNormal','');
			}
		}else{
			$EntradaNormal = BD::mostrar($NuevaAccionEntrada,'obtenerEntradaNormal','');
		}
	}else{
		$EntradaNormal = BD::mostrar($NuevaAccionEntrada,'obtenerEntradaNormal','');
		$EntSimilar = true;
		if (!empty($EntradaNormal)){
			if ($EntradaNormal -> obtener_ARCHIVOACTIVO()) {
				$Opiniones = false;
			}else{
				$Opiniones = true;
			}
		}else{
			$Opiniones = true;
		}
	}

	if(isset($EntradaNormal) && !empty($EntradaNormal)){

		// ********************************************************************************************* \\
	
				$Titulo = $EntradaNormal -> obtener_TITULO();
				if(isset($Hyzher) && $Hyzher === true){
					$Menu_HZ = true;
				}else{
					$Menu_HZ = false;
				}
				$Fragmento = true;
				
				$Contenido[] = true;
				$Contenido[] = 'portal/hacer/ventanas/entradas/entrada_normal.inc.php';			

		// ********************************************************************************************* \\

		include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
		include_once('portal/cuadros/plantillas/piedra_header.inc.php');
		include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');
			?>
				<script>
					var lanzar = false;
					$(document).ready(function(){
						if(Galletas.readCookie('entradasFamiliares') == "index"){
							op_familia('mostrar');
							Galletas.createCookie("entradasFamiliares", "mostrar", "");
						}else{
					    	Galletas.createCookie("entradasFamiliares", "mostrar", "");
						}

						if(Galletas.readCookie("menuHeader")== "Index"){
					    	Galletas.createCookie("menuHeader", "EntradaNormal");
					    	pegarHeader(false);
					    }else if(Galletas.readCookie("menuHeader", "EntradaNormal")){
					    	pegarHeader(false);
					    }
					});
					
				</script>
			<?php
		include_once('portal/cuadros/plantillas/piedra_madre.inc.php');
		include_once('portal/cuadros/plantillas/piedra_publicados.inc.php');
		include_once('portal/cuadros/plantillas/piedra_remitente.inc.php');
		include_once('portal/cuadros/plantillas/piedra_salida.inc.php');
	}else{
		redireccion::redirigir(ERROR);
	}
}else{
	redireccion::redirigir(ERROR);
}
	?>
		<script src="<?php echo BUSCADORENTRADAS;?>"></script>
	<?php
ob_end_flush();