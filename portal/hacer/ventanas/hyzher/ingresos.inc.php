<?php
	use \realiza_ingreso\ingreso as VD;
	use \base_ingreso\ingreso as GD;
	use \crud_ingreso\ingreso as BD;

	$accion = new VD('', '', '', '');
	$Tabla_Ingresos = $accion -> tabla_ingresos('', 'ingreso_estado');
	$ingresos_totales = $accion -> ingresos_totales();
	$ingresos_registrados = $accion -> ingresos_registrados();

	if(isset($_POST['Nue_Ingreso'])){
		$val_nuevo = new VD($_POST['n_zoulname'], $_POST['n_password'], $_POST['n_email'], '');
		if($val_nuevo -> v_nuevo()){
			$ingreso = new GD('', $val_nuevo -> pasar_user(), password_hash($val_nuevo -> pasar_pass(), PASSWORD_DEFAULT), $val_nuevo -> pasar_email(), '');
			if(BD::nuevo($ingreso, 'nuevo')){
				redireccion::redirigir(INGRESOS);
			}
		}
	}

	if(isset($_POST['Cam_Pass'])){
		$val_cambiar = new VD('', $_POST['cam_pass'], '', $_POST['cam_id_pass']);
		if($val_cambiar -> v_cambiar_pass()){
			$ingreso = new GD($val_cambiar -> pasar_id(), '', password_hash($val_cambiar -> pasar_pass(), PASSWORD_DEFAULT), '', '');
			if(BD::modificar($ingreso, 'cambiar_pass')){
				redireccion::redirigir(INGRESOS);
			}
		}
	}

	if(isset($_POST['Bor_Ingreso'])){
		$val_borrar = new VD('', '', '', $_POST['bor_id']);
		if($val_borrar -> v_borrar()){
			$ingreso = new GD($val_borrar -> pasar_id(), '', '', '', '');
			if(BD::eliminar($ingreso, 'ingreso')){
				redireccion::redirigir(INGRESOS);
			}
		}
	}

?>

<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_ingreso('','NUE_INGRESO');">Nuevo Ingreso</button>
		<div class="detalles">
			<span>Users: <?php echo $ingresos_totales;?></span>
			<span>Users Aceptados: <?php echo $ingresos_registrados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Ingresos Users</caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>ZoulName</td>
				<td>Email</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Ingresos)) {
					foreach ($Tabla_Ingresos as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_USER();?></td>
							<td><?php echo $t_fila -> obtener_EMAIL();?></td>
							<?php
							if ($t_fila -> obtener_ESTADO() == 1) {
								?>
									<td class="visible">Aceptado</td>
								<?php
							}else{
								?>
									<td class="oculto"><?php echo $accion -> nombre_estado($t_fila -> obtener_ESTADO());?></td>
								<?php
							}
							?>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_ingreso('<?php echo $t_fila -> obtener_ID();?>','CAM_INGRESO_PASS');">
									<i class="fa fa-user-secret fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_ingreso('<?php echo $t_fila -> obtener_ID();?>','BOR_INGRESO');">
									<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
								</label>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
	</div>
</div>


<div class="el-paquete" id="el_nuevo">
	<form method="POST" action="<?php echo INGRESOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Ingreso</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Ingreso"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_ingreso('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="zoulname">Zoulname:</label>
			<input type="text" name="n_zoulname" required <?php if(isset($_POST['Nue_Ingreso'])){$val_nuevo->r_user();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Ingreso'])) {
				$val_nuevo -> m_Euser();
			}
		?>
		<div class="grupo-form">
			<label for="password">Password:</label>
			<input type="password" name="n_password" required>
		</div>
		<?php
			if (isset($_POST['Nue_Ingreso'])) {
				$val_nuevo -> m_Epass();
			}
		?>
		<div class="grupo-form">
			<label for="email">Email:</label>
			<input type="email" name="n_email" required <?php if(isset($_POST['Nue_Ingreso'])){$val_nuevo->r_email();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Ingreso'])) {
				$val_nuevo -> m_Eemail();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Ingreso"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_ingreso('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo INGRESOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Password</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Cam_Pass"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_ingreso('', 'X_pass');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Zoulname:</label>
				<label id="ajax_user"></label>
				<label>Email:</label>
				<label id="ajax_email"></label>
			</div>
		</div>
		<div class="grupo-form">
			<label>Password:</label>
			<input type="password" name="cam_pass" required>
		</div>
		<?php
			if (isset($_POST['Cam_Pass'])) {
				$val_cambiar -> m_Epass();
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_pass" name="cam_id_pass" readonly <?php if(isset($_POST['Cam_Pass'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit" name="Cam_Pass"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_ingreso('', 'X_pass');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo INGRESOS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Ingreso ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Ingreso"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_ingreso('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Zoulname:</label>
				<label id="ajax_bor_user"></label>
				<label>Email:</label>
				<label id="ajax_bor_email"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Ingreso'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Ingreso'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Ingreso"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_ingreso('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_ingreso(valor, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case'NUE_INGRESO':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_nuevo').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_nuevo").offset().top  }, 1);
				break;
					case 'X_nuevo':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_nuevo').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'CAM_INGRESO_PASS':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'INGRESOS', 'buscar':'id', 'dato':valor};
				ajax_global(ajax_H, accion);
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
				break;
					case 'X_pass':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_cambiado').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'BOR_INGRESO':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'INGRESOS', 'buscar':'id', 'dato':valor};
				ajax_global(ajax_H, accion);
				$('#el_borrado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_borrado").offset().top  }, 1);
				break;
					case 'X_borrar':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_borrado').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			default:
				$('#el_principado').css('pointer-events' , 'auto');
		}
	}
</script>


<?php
	if(isset($_POST['Nue_Ingreso'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				op_ingreso('', 'NUE_INGRESO');
			</script>
			<?php
		}
	}

	if(isset($_POST['Cam_Pass'])){
		if(!$val_cambiar -> v_cambiar_pass()){
			?>
			<script>
				var ajax_H = {'atributo':'INGRESOS', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_INGRESOS_PASS_ERROR');

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>