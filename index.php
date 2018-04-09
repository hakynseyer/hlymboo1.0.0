<?php
require_once 'portal/configuraciones/requeridos.inc.php';

$componentes_link = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_link['path'];

$pedacitos_ruta = explode('/', $ruta);
$pedacitos_ruta = array_filter($pedacitos_ruta);
$pedacitos_ruta = array_slice($pedacitos_ruta, 0);

$dirigir = 'portal/cuadros/404.php';
$Hcompuerta = false;

if(count($pedacitos_ruta) == 0){
	$dirigir = 'portal/cuadros/hlymboo.php';
}
else if(count($pedacitos_ruta) == 1){
	if ($Hyzher === false) {
		switch ($pedacitos_ruta[0]) {
			case 'acceso':
				$dirigir = 'portal/cuadros/acceso.php';
				break;
			case 'preregistro':
				$dirigir = 'portal/cuadros/preregistro.php';
				break;
			case 'registro':
				$dirigir = 'portal/cuadros/registro.php';
				break;
			case 'error':
				$dirigir = 'portal/cuadros/hyzhers.php';
				break;
			default:
				$dirigir = "portal/cuadros/entrada.php";
				$Accion_Entrada = $pedacitos_ruta[0];
				break;
		}
	} else if($Hyzher === true){
		switch ($pedacitos_ruta[0]) {
			case 'hcompuerta':
				if (control_sesion::sesion_iniciada()) {
					if(control_sesion::mi_acceso() === 'ElAccesoPermitido'){
						Redireccion::redirigir(ERROR);
					}
				}
				$dirigir = 'portal/cuadros/hcompuerta.php';
				$Hcompuerta = true;
				break;
			case 'realidad':
				$dirigir = 'portal/configuraciones/flujo/sesion_cerrar.inc.php';
				$Hcompuerta = true;
				break;
			case 'hyzher':
				$dirigir = 'portal/cuadros/hyzher.php';
				break;
			case 'error':
				$dirigir = 'portal/cuadros/404.php';
				break;	
			default:
				$dirigir = "portal/cuadros/entrada.php";
				$Accion_Entrada = $pedacitos_ruta[0];
				break;
		}
	}
}
else if(count($pedacitos_ruta) === 2){
	if($Hyzher === false){
		switch ($pedacitos_ruta[0]) {
			case 'hyzhers':
				$dirigir = 'portal/cuadros/hyzhers.php';
				$Accion_Autores = $pedacitos_ruta[1];
				break;
			case 'hijos':
				$dirigir = 'portal/cuadros/hijos.php';
				$Accion_Hijos = $pedacitos_ruta[1];
				break;
		}
	} else if($Hyzher === true){
		switch ($pedacitos_ruta[0]) {
			case 'hyzher':
				$dirigir = 'portal/cuadros/hyzher.php';
				$Accion_Hyzher = $pedacitos_ruta[1];
				break;
			case 'hyzhers':
				$dirigir = 'portal/cuadros/hyzhers.php';
				$Accion_Autores = $pedacitos_ruta[1];
				break;
			case 'hijos':
				$dirigir = 'portal/cuadros/hijos.php';
				$Accion_Hijos = $pedacitos_ruta[1];
				break;
		}
	}
}

if (control_sesion::sesion_iniciada()) {
	if(control_sesion::mi_acceso() !== 'ElAccesoPermitido' && $Hcompuerta === false){
		Redireccion::redirigir(HLLAVE);
	}
}

include_once($dirigir);