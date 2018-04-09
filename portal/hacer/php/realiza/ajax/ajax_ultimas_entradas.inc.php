<?php
$ajaxBuscar = true;
require_once '../construye/panel_ultimas_entradas.inc.php';

	use \construye_PUEntradas\entradas as PUEntradas;

$codigoHtml = PUEntradas::general_panel($_POST['coloca'], $_POST['pagina'], $_POST['accion'], $_POST['valor'], $ajaxBuscar);

if(!empty($codigoHtml)){
	$estado = true;
}else{
	$estado = false;
}

$respuesta = array('salida' => $codigoHtml, 'estado' => $estado);

echo json_encode($respuesta);