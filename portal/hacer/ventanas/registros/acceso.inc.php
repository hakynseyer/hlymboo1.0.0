<?php
	use \realiza_acceso\acceso as VD;

	if (isset($_POST['acceso'])) {
		$validacion = new VD($_POST['n_hakymail'], $_POST['n_llave']);
		if ($validacion -> v_adelante()) {
			control_sesion::iniciar_sesion($validacion -> pasar_HYZHER() -> obtener_ID(), $validacion -> pasar_HYZHER() -> obtener_ALIAS(), $validacion -> pasar_HYZHER() -> obtener_EMAIL());
			if (control_sesion::sesion_iniciada()) {
				Redireccion::redirigir(HLLAVE);
			}
		}
	}

?>
<div class="el-paquete">
	<form method="POST" action="<?php echo ACCESO;?>" class="form-modal">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Acceso Huesped</h2>
			</div>
		</div>
		<div class="grupo-form">
			<label for="hakymail">Hakymail:</label>
			<input type="email" id="hakymail" name="n_hakymail" required <?php if(isset($_POST['acceso'])){$validacion->r_email();}?> >
		</div>
		<div class="grupo-form">
			<label for="llave">Llave:</label>
			<input type="password" id="llave" name="n_llave" required >
		</div>
		<?php
			if (isset($_POST['acceso'])) {
				$validacion -> m_Eacceso();
			}
		?>
		<div class="grupo-form">
			<button type="submit" class="submit" name="acceso"><i class="fa fa-rocket" aria-hidden="true"> Acceder</i></button>
			<a href="<?php echo PREREGISTRO;?>" class="boton"><i class="fa fa-user-plus" aria-hidden="true"> Hyzhers</i></a>
		</div>
	</form>
</div>