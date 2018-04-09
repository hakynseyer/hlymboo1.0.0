<?php
	use \realiza_hyzher\hyzher as VD;
	use \base_hyzher\hyzher as GD_H;
	use \base_detalles\detalles as GD_D;
	use \base_ingreso\ingreso as GD_I;
	use \crud_hyzher\hyzher as BD;

if (control_sesion::sesion_email() || isset($_POST['registrar'])) {
	if(control_sesion::sesion_email()){

		$PreregistroEmail =  control_sesion::mi_email();
		control_sesion::cerrar_sesion();

	}else if(isset($_POST['registrar'])){

		$validacion = new VD($_POST['n_nombre'], $_POST['n_alias'], $_POST['n_email'], $_POST['n_llave'], $_POST['n_r_llave'], $_POST['n_pregunta1'], $_POST['n_respuesta1'], $_POST['n_pregunta2'], $_POST['n_respuesta2'], '', '', '');
		if ($validacion -> v_nuevo()) {
			$hyzher = new GD_H('', $validacion -> pasar_nombre(), $validacion -> pasar_alias(), $validacion -> pasar_email(), '', password_hash($validacion -> pasar_llave(),PASSWORD_DEFAULT), $validacion -> pasar_pregunta1(), $validacion -> pasar_respuesta1(), $validacion -> pasar_pregunta2(), $validacion -> pasar_respuesta2(), '', '', '');
			if (BD::nuevo($hyzher, 'hyzher')) {
				$id_hyzher = $validacion -> id_hyzher($hyzher -> obtener_ALIAS(), $hyzher -> obtener_EMAIL()); 
				$detalles = new GD_D('', $id_hyzher, '', '', '', '', '');
				if (BD::nuevo($detalles, 'detalles')) {
					$ingreso_email = new GD_I('', '', '', $hyzher -> obtener_EMAIL(), '');
					if(BD::nuevo($ingreso_email, 'ingreso')){
						redireccion::redirigir(ACCESO);
					}else{
					}
				}else{
				}
			}
		}
		
	}
}else{
	control_sesion::cerrar_sesion();
	redireccion::redirigir(ACCESO);
}

?>
<div class="el-paquete" id="registrando">
	<form method="POST" action="<?php echo REGISTRO;?>" class="form-modal">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Hyzher</h2>
			</div>
		</div>
		<div class="grupo-form">
			<label for="nombre">Nombre:</label>
			<input type="text" id="nombre" name="n_nombre" required <?php if(isset($_POST['registrar'])){$validacion->r_nombre();}?> >
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Enombre();
			}
		?>
		<div class="grupo-form">
			<label for="alias">Alias:</label>
			<input type="text" id="alias" name="n_alias" required <?php if(isset($_POST['registrar'])){$validacion->r_alias();}?> >
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Ealias();
			}
		?>
		<div class="grupo-form">
			<label for="email">Hakymail:</label>
			<input type="email" id="email" name="n_email" required <?php if(isset($_POST['registrar'])){$validacion->r_email();}?> value="<?php echo $PreregistroEmail; ?>" readonly>
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Eemail();
			}
		?>
		<div class="grupo-form">
			<label for="llave">Llave:</label>
			<input type="password" id="llave" name="n_llave" required>
		</div>
		<div class="grupo-form">
			<label for="r_llave">Repetir Llave:</label>
			<input type="password" id="r_llave" name="n_r_llave" required>
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Ellave();
				$validacion -> m_Erllave();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<div class="caja-select">
						<select name="n_pregunta1" id="n_pregunta1_select">
							<option value="Mi pasatiempo favorito">Mi pasatiempo favorito</option>
							<option value="Mi comida favorita">Mi comida favorita</option>
							<option value="Lo que más odio">Lo que más odio</option>
							<option value="Mi héroe favorito">Mi héroe favorito</option>
							<option value="Mi mayor miedo">Mi mayor miedo</option>
							<option value="Deseo viajar">Deseo viajar</option>
							<option value="Mi mayor sueño">Mi mayor sueño</option>
						</select>
					</div>
				</div>
				<div class="parte">
					<label for="respuesta1">Respuesta 1:</label>
					<input type="text" id="respuesta1" name="n_respuesta1" required <?php if(isset($_POST['registrar'])){$validacion->r_respuesta1();}?> >
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Erespuesta1();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<div class="caja-select">
						<select name="n_pregunta2" id="n_pregunta2_select">
							<option value="Mi héroe favorito">Mi héroe favorito</option>
							<option value="Mi pasatiempo favorito">Mi pasatiempo favorito</option>
							<option value="Mi comida favorita">Mi comida favorita</option>
							<option value="Lo que más odio">Lo que más odio</option>
							<option value="Mi mayor miedo">Mi mayor miedo</option>
							<option value="Deseo viajar">Deseo viajar</option>
							<option value="Mi mayor sueño">Mi mayor sueño</option>
						</select>
					</div>
				</div>
				<div class="parte">
					<label for="respuesta2">Respuesta 2:</label>
					<input type="text" id="respuesta2" name="n_respuesta2" required <?php if(isset($_POST['registrar'])){$validacion->r_respuesta2();}?> >
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['registrar'])) {
				$validacion -> m_Erespuesta2();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="registrar"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
		</div>
	</form>
</div>

<script>
	function op_registrar(accion){
		switch(accion){
			case 'Limpiar':
				$('#nombre').val('');
				$('#alias').val('');
				$('#email').val('');
				$('#llave').val('');
				$('#r_llave').val('');
				$('#respuesta1').val('');
				$('#respuesta2').val('');
				$('#n_pregunta1_select option[value="Mi pasatiempo favorito"]').prop("selected",true);
				$('#n_pregunta2_select option[value="Mi héroe favorito"]').prop("selected",true);
				$('#registrando').find('div#El_Error').remove();
				break;
		}
	}
	$('#n_pregunta1_select').change(function(){
		$('#respuesta1').focus();
	});
	$('#n_pregunta2_select').change(function(){
		$('#respuesta2').focus();
	});
</script>

<?php
	if (isset($_POST['registrar'])) {
		if (!$validacion -> v_nuevo()) {
			?>
			<script>
				$('#n_pregunta1_select option[value="<?php echo $validacion->pasar_pregunta1();?>"]').prop("selected",true);
				$('#n_pregunta2_select option[value="<?php echo $validacion->pasar_pregunta2();?>"]').prop("selected",true);
			</script>
			<?php
		}
	}
?>