<?php
	use \realiza_ingreso\ingreso as VD;
	
	if(isset($_POST['acceso'])){
		$validacion = new VD('', '', '', '');
		$validacion -> acceder($_POST['n_email'], $_POST['n_llave'], 'acceso');
		if($validacion -> v_ingreso()){
			control_sesion::email_usuario($validacion -> pasar_email());
			Redireccion::redirigir(REGISTRO);
		}else{
			Redireccion::redirigir(ACCESO);
		}
	}
?>
<div class="el-paquete">
	<form method="POST" action="<?php echo PREREGISTRO;?>" class="form-modal acceso2">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Acceso HLymboo Zouls</h2>
			</div>
		</div>
		<div class="grupo-form">
			<label for="email">Email:</label>
			<input type="email" id="email" name="n_email" required >
		</div>
		<div class="grupo-form">
			<label for="llave">Password Zoul:</label>
			<input type="password" id="llave" name="n_llave" required >
		</div>
		<?php
			if (isset($_POST['acceso'])) {
				$validacion -> m_Eacceso();
			}
		?>
		<div class="grupo-form">
			<button type="submit" class="submit" name="acceso"><i class="fa fa-rocket" aria-hidden="true"> Acceder</i></button>
			<a href="<?php echo ACCESO;?>" class="boton color-rojo"><i class="fa fa-window-close" aria-hidden="true"> Cancelar</i></a>
		</div>
	</form>
</div>