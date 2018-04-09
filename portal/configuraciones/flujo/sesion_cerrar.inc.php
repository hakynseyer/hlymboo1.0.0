<?php
	require_once 'sesion_iniciada.inc.php';
	require_once 'url_redireccion.inc.php';
	require_once 'portal/configuraciones/configurador/configurador_rutas.inc.php';

control_sesion::cerrar_sesion();
redireccion::redirigir(ACCESO);