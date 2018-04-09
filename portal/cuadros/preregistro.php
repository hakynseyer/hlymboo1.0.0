<?php
	require_once 'portal/hacer/php/base/base_ingreso.inc.php';
	require_once 'portal/hacer/php/crud/crud_ingreso.inc.php';
	require_once 'portal/hacer/php/realiza/realiza_ingreso.inc.php';

// ********************************************************************************************* \\
	
		$Titulo = 'HLymboo Zouls';
		$Menu_HZ = false;
		$Fragmento = false;
		$Contenido[] = true;
		$Contenido[] = 'portal/hacer/ventanas/registros/preregistro.inc.php';			

// ********************************************************************************************* \\

include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
include_once('portal/cuadros/plantillas/piedra_header.inc.php');
include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');
include_once('portal/cuadros/plantillas/piedra_madre.inc.php');
include_once('portal/cuadros/plantillas/piedra_publicados.inc.php');
include_once('portal/cuadros/plantillas/piedra_remitente.inc.php');
include_once('portal/cuadros/plantillas/piedra_salida.inc.php');