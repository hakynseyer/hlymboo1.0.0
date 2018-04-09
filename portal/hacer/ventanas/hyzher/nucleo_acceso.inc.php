<?php
	use \realiza_nucleo\nucleo as VD;

	if(isset($_POST['acceso'])){
		$validacion = new VD($Hyzher_id, '', $_POST['n_llave'], '', '');
		if($validacion -> v_adelante()){
			control_sesion::estado_Hllave('ElAccesoPermitido');
			Redireccion::redirigir(HOME);
		}else{
			Redireccion::redirigir(REALIDAD);
		}
	}

?>
<div class="el-paquete">
	<form method="POST" action="<?php echo HLLAVE;?>" class="form-modal">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Acceso Hcompuerta</h2>
			</div>
		</div>
		<div class="grupo-form">
			<label for="llave">Llave Hcompuerta:</label>
			<input type="password" id="llave" name="n_llave" required >
		</div>
		<?php
			if (isset($_POST['acceso'])) {
				$validacion -> m_Eacceso();
			}
		?>
		<div class="grupo-form">
			<button type="submit" class="submit" name="acceso"><i class="fa fa-rocket" aria-hidden="true"> Acceder</i></button>
			<a href="<?php echo REALIDAD;?>" class="boton color-rojo"><i class="fa fa-window-close" aria-hidden="true"> Cancelar</i></a>
		</div>
	</form>
</div>