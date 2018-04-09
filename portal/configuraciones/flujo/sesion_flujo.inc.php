<?php
	require_once 'sesion_iniciada.inc.php';
	
if (control_sesion::sesion_iniciada()) {
	$Hyzher = true;
	$Hyzher_id = control_sesion::mi_id();
	$Hyzher_usuario = control_sesion::mi_usuario();
	$Hyzher_email = control_sesion::mi_email();
	if(strtoupper($Hyzher_usuario) === 'HAKYN SEYER'){
		$HLyzher = true;
	}
}else{
	$Hyzher=false;
	$Hyzher_id = null;
	?>
	<script>
		window.onload = menuCargar;
		function menuCargar(){
			Galletas.eraseCookie("menuHyzher");
		}		
	</script>
	<?php
}