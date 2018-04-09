<?php
	require_once 'portal/hacer/php/base/base_hyzher.inc.php';
	require_once 'portal/hacer/php/crud/crud_hyzher.inc.php';
	require_once 'portal/hacer/php/realiza/realiza_acceso.inc.php';

// ********************************************************************************************* \\
	
		$Titulo = 'Acceso de Hyzhers';
		$Menu_HZ = false;
		$Fragmento = false;
		$Contenido[] = true;
		$Contenido[] = 'portal/hacer/ventanas/registros/acceso.inc.php';			

// ********************************************************************************************* \\

include_once('portal/cuadros/plantillas/piedra_entrada.inc.php');
include_once('portal/cuadros/plantillas/piedra_header.inc.php');
include_once('portal/cuadros/plantillas/piedra_herramientas.inc.php');
include_once('portal/cuadros/plantillas/piedra_madre.inc.php');
include_once('portal/cuadros/plantillas/piedra_publicados.inc.php');
include_once('portal/cuadros/plantillas/piedra_remitente.inc.php');
include_once('portal/cuadros/plantillas/piedra_salida.inc.php');