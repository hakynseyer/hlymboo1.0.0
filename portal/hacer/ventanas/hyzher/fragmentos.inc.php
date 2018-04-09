<?php
	use \realiza_fragmento\fragmento as VD;
	use \base_fragmento\fragmento as GD;
	use \crud_fragmento\fragmento as BD;

	$accion = new VD('', '', '', '', '', '');
	$Tabla_Fragmentos = $accion -> tabla_fragmentos('',$Hyzher_id, 'fragmento_modificado DESC');
	$frag_permitidos = $accion -> detalles_fragmento($Hyzher_id);
	$frag_contados = $accion -> fragmentos_contados($Hyzher_id);

	if (isset($_POST['Nue_Frag'])) {
		$val_nuevo = new VD($_POST['n_titulo'], $_POST['n_frontal'], $_POST['n_posterior'], '', '', '');
		if ($frag_contados < $frag_permitidos) {
			if ($val_nuevo -> v_nuevo()) {
				$fragmento = new GD('', $Hyzher_id, $val_nuevo -> pasar_titulo(), $val_nuevo -> pasar_frontal(), $val_nuevo -> pasar_posterior(), '', '', '', '');
				if (BD::nuevo($fragmento, 'nuevo')) {
					redireccion::redirigir(FRAGMENTOS);
				}
			}
		}
	}

	if (isset($_POST['Cam_Frag'])) {
		$val_cambiar = new VD('', $_POST['cam_frontal'], $_POST['cam_posterior'], $_POST['cam_estado'], $_POST['cam_id'], $Hyzher_id);
		if ($val_cambiar -> v_cambiar()) {
			$fragmento = new GD($val_cambiar -> pasar_id(), $Hyzher_id, '', $val_cambiar -> pasar_frontal(), $val_cambiar -> pasar_posterior(), '', '', '', $val_cambiar -> pasar_estado());
			if (BD::modificar($fragmento, 'cambiar')) {
				redireccion::redirigir(FRAGMENTOS);
			}
		}
	}

	if (isset($_POST['Bor_Frag'])) {
		$val_borrar = new VD('', '', '', '', $_POST['bor_id'], $Hyzher_id);
		if ($val_borrar -> v_eliminar()) {
			$fragmento = new GD($val_borrar -> pasar_id(), $Hyzher_id, '', '', '', '', '', '', '');
			if (BD::eliminar($fragmento)) {
				redireccion::redirigir(FRAGMENTOS);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_frag('','NUE_FRAG');">Nuevo Fragmento</button>
		<div class="detalles">
			<span>Total: <?php echo $frag_contados;?></span>
			<span>Sobran: <?php echo $frag_permitidos - $frag_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Fragmentos <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Titulo</td>
				<td>Modificado</td>
				<td>Cambios</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Fragmentos)) {
					foreach ($Tabla_Fragmentos as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TITULO();?></td>
							<td><?php echo $accion -> componer_fecha($t_fila -> obtener_MODIFICADO(), 'fecha_hora')?></td>
							<td><?php echo $t_fila -> obtener_INTENTOS();?></td>
							<?php
							if ($t_fila -> obtener_ESTADO() == 1) {
								?>
									<td class="visible"><?php echo $accion -> nombre_estado($t_fila -> obtener_ESTADO());?></td>
								<?php
							}else{
								?>
									<td class="oculto"><?php echo $accion -> nombre_estado($t_fila -> obtener_ESTADO());?></td>
								<?php
							}
							?>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_frag('<?php echo $t_fila -> obtener_ID();?>','CAM_FRAG');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_frag('<?php echo $t_fila -> obtener_ID();?>','BOR_FRAG');">
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
	<form method="POST" action="<?php echo FRAGMENTOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Fragmento</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Frag"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_frag('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="titulo">Titulo Fragmento:</label>
			<input type="text" id="titulo" name="n_titulo" required <?php if(isset($_POST['Nue_Frag'])){$val_nuevo->r_titulo();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Frag'])) {
				$val_nuevo -> m_Etitulo();
			}
		?>
		<div class="grupo-form">
			<label for="frontal">Contenido Frontal:</label>
			<textarea name="n_frontal" id="frontal" cols="30" rows="12" required><?php if(isset($_POST['Nue_Frag'])){$val_nuevo->r_frontal();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Frag'])) {
				$val_nuevo -> m_Efrontal();
			}
		?>
		<div class="grupo-form">
			<label for="posterior">Contenido Posterior:</label>
			<textarea name="n_posterior" id="posterior" cols="30" rows="12" required><?php if(isset($_POST['Nue_Frag'])){$val_nuevo->r_posterior();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Frag'])) {
				$val_nuevo -> m_Eposterior();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Frag"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_frag('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo FRAGMENTOS;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Fragmento</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Frag"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_frag('', 'X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Fragmento:</label>
				<label class="col-md-9" id="ajax_titulo"></label>
				<label class="col-md-3">Número Cambios:</label>
				<label class="col-md-3" id="ajax_intentos"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_creacion"></label>
				<label class="col-md-3">Ultima Modificación:</label>
				<label class="col-md-3" id="ajax_modificacion"></label>
			</div>
		</div>
		<div class="grupo-form">
			<label>Estado:</label>
			<div class="radio">
				<input type="radio" id="ajax_oculto" name="cam_estado" value="0" checked>
				<label for="ajax_oculto">Oculto</label>
				<input type="radio" id="ajax_visible" name="cam_estado" value="1">
				<label for="ajax_visible">Visible</label>
			</div>
		</div>
		<?php
			if (isset($_POST['Cam_Frag'])) {
				$val_cambiar -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_frontal">Contenido Frontal:</label>
			<textarea name="cam_frontal" id="ajax_frontal" cols="30" rows="12" required><?php if(isset($_POST['Cam_Frag'])){$val_cambiar->r_frontal();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Frag'])) {
				$val_cambiar -> m_Efrontal();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_posterior">Contenido Posterior:</label>
			<textarea name="cam_posterior" id="ajax_posterior" cols="30" rows="12" required><?php if(isset($_POST['Cam_Frag'])){$val_cambiar->r_posterior();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Frag'])) {
				$val_cambiar -> m_Eposterior();
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Frag'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Frag"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_frag('', 'X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo FRAGMENTOS;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Fragmento ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Frag"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_frag('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Fragmento:</label>
				<label class="col-md-9" id="ajax_bor_titulo"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_bor_creacion"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Frag'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Frag'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Frag"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_frag('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_frag(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_FRAG':
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
			case 'CAM_FRAG':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'FRAGMENTO', 'buscar':'id', 'dato':id};
				ajax_global(ajax_H, accion);
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
				break;
					case 'X_cambiar':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_cambiado').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'BOR_FRAG':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'FRAGMENTO', 'buscar':'id', 'dato':id};
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
	};
</script>


<?php
	if (isset($_POST['Nue_Frag'])) {
		if (!$val_nuevo -> v_nuevo() || $frag_contados >= $frag_permitidos) {
			?>
			<script>
				op_frag('','NUE_FRAG');
			</script>
			<?php
		}
	}
	if (isset($_POST['Cam_Frag'])) {
		if (!$val_cambiar -> v_cambiar()) {
			?>
			<script>
				var ajax_H = {'atributo':'FRAGMENTO', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_FRAG_ERRORES');

				<?php
					if ($val_cambiar -> pasar_estado() == 1) {
						?>
						$('#ajax_visible').prop("checked",true);
						<?php
					}else{
						?>
						$('#ajax_oculto').prop("checked",true);
						<?php
					}
				?>

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>