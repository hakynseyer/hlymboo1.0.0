<?php
	require_once 'portal/hacer/php/crud/crud_blog.inc.php';
	require_once 'portal/hacer/php/crud/crud_tarea.inc.php';
	require_once 'portal/hacer/php/realiza/realiza_tablones.inc.php';
	require_once 'portal/hacer/php/realiza/construye/panel_familia.inc.php';
	require_once 'portal/hacer/php/realiza/construye/panel_ultimas_entradas.inc.php';
	require_once 'portal/hacer/php/base/base_blog.inc.php';
	require_once 'portal/hacer/php/base/base_tablones.inc.php';
	require_once 'portal/hacer/php/base/base_perfil.inc.php';
	require_once 'portal/hacer/php/base/base_personaje.inc.php';

// ********************************************************************************************* \\
	
		$Titulo = 'Bienvenido a Hlymboo';
		$Menu_HZ = true;
		$Fragmento = false;
		$Contenido[] = true;
		$Contenido[] = 'portal/hacer/ventanas/entradas/entradas.inc.php';		

// ********************************************************************************************* \\

include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
include_once('portal/cuadros/plantillas/piedra_header.inc.php');	
include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');	
	?>
	<script>
		var moverTareas = false;
		$(document).ready(function(){
		    Galletas.eraseCookie("entradasFamiliares");
		    Galletas.eraseCookie("personajesFamiliares");

		     if(Galletas.readCookie("menuHeader")!= null){
		    	if(Galletas.readCookie("menuHeader") == "EntradaNormal"){
		    		Galletas.createCookie("menuHeader", "Index", "");
		    		pegarHeader(true);
		    	}
		    }else{
		    	Galletas.createCookie("menuHeader", "Index", "");
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