<?php
ob_start();
	require_once 'portal/hacer/php/base/base_perfil.inc.php';
	require_once 'portal/hacer/php/base/base_hyzher.inc.php';
	require_once 'portal/hacer/php/base/base_personaje.inc.php';
	require_once 'portal/hacer/php/base/base_blog.inc.php';
	require_once 'portal/hacer/php/crud/crud_perfil.inc.php';
	require_once 'portal/hacer/php/crud/crud_blog.inc.php';
	require_once 'portal/hacer/php/realiza/construye/panel_ultimas_entradas.inc.php';

// ********************************************************************************************* \\
	
		$Titulo = 'Antología de Hyzhers';
		if($Hyzher){
			$Menu_HZ = true;
		}else{
			$Menu_HZ = false;
		}
		$Fragmento = true;
		$Contenido[] = true;
		$Contenido[] = 'portal/hacer/ventanas/hzoul/hyzhers.inc.php';	

// ********************************************************************************************* \\

include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
include_once('portal/cuadros/plantillas/piedra_header.inc.php');	
include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');
	?>
		<script>
			var lanzar = false;
			$(document).ready(function(){
			    if(Galletas.readCookie('personajesFamiliares') == "personaje"){
					op_familia('mostrar');
					Galletas.createCookie("personajesFamiliares", "mostrar", "");
				}else{
			    	Galletas.createCookie("personajesFamiliares", "mostrar", "");
				}
			});		
		</script>
	<?php
include_once('portal/cuadros/plantillas/piedra_madre.inc.php');
include_once('portal/cuadros/plantillas/piedra_publicados.inc.php');
include_once('portal/cuadros/plantillas/piedra_remitente.inc.php');
include_once('portal/cuadros/plantillas/piedra_salida.inc.php');
	?>
	<script src="<?php echo BUSCADORENTRADAS;?>"></script>
	<?php
ob_end_flush();