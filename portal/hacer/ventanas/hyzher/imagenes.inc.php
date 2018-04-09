<?php
	use \realiza_imagen\imagen as VD;
	use \base_imagen\imagen as GD;
	use \crud_imagen\imagen as BD;

	$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
	$accion = new VD($sn, '', '', '', '', '', '');
	$Tabla_Imagenes = $accion -> tabla_imagenes('', $Hyzher_id, 'i.imagen_modificado DESC');
	$Familia_Bruta = $accion -> familia_imagen($Hyzher_id);
	$img_contados = $accion -> imagenes_contados($Hyzher_id);

	if (isset($_POST['Nue_Img'])) {
		$imagen_array = array('error' => $_FILES['n_imagen']['error'], 'tamanio' => $_FILES['n_imagen']['size'], 'tipo' => $_FILES['n_imagen']['type'], 'titulo' => $_FILES['n_imagen']['name'], 'ruta' => $_FILES['n_imagen']['tmp_name']);
		$val_nuevo = new VD($imagen_array, $_POST['n_familia'], $_POST['n_fuente'], $_POST['n_notas'], '', '', '');
		if ($val_nuevo -> v_nuevo()) {
			$subir_imagen = move_uploaded_file($val_nuevo -> pasar_ruta_temporal(), $val_nuevo -> pasar_ruta_envio());
			if ($subir_imagen) {
				$imagen = new GD('', $Hyzher_id, $val_nuevo -> pasar_titulo(), $val_nuevo -> pasar_familia(), $val_nuevo -> pasar_ruta_envio(), $val_nuevo -> pasar_fuente(), $val_nuevo -> pasar_notas(), '', '', '', '');
				if (BD::nuevo($imagen, 'nuevo')) {
					redireccion::redirigir(IMAGENES);
				}else{
					unlink($val_nuevo -> pasar_ruta_envio());
				}
			}else{
				unlink($val_nuevo -> pasar_ruta_envio());
			}
		}
	}

	if (isset($_POST['Cam_Img'])) {
		$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
		$val_cambiar = new VD($sn, $_POST['cam_familia'], $_POST['cam_fuente'], $_POST['cam_notas'], $_POST['cam_estado'], $_POST['cam_id'], $Hyzher_id);
		if ($val_cambiar -> v_cambiar()) {
			$imagen = new GD($val_cambiar -> pasar_id(), $Hyzher_id, '', $val_cambiar -> pasar_familia(), '', $val_cambiar -> pasar_fuente(), $val_cambiar -> pasar_notas(), '', '', '', $val_cambiar -> pasar_estado());
			if (BD::modificar($imagen, 'cambiar')) {
				redireccion::redirigir(IMAGENES);
			}
		}
	}

	if (isset($_POST['Bor_Img'])) {
		$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
		$val_borrar = new VD($sn, '', '', '', '', $_POST['bor_id'], $Hyzher_id);
		$val_borrar -> ruta_envio($_POST['bor_id'], $Hyzher_id);
		if ($val_borrar -> v_borrar()) {
			$imagen = new GD($val_borrar -> pasar_id(), $Hyzher_id, '', '', '', '', '', '', '', '', '');
			$borrar_imagen = unlink($val_borrar -> pasar_ruta_envio());
			if ($borrar_imagen) {
				if (BD::eliminar($imagen)) {
					redireccion::redirigir(IMAGENES);
				}
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_img('','NUE_IMG');">Nueva Imagen</button>
		<div class="detalles">
			<span>Total: <?php echo $img_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Imagenes <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Titulo</td>
				<td>Familia</td>
				<td>Modificado</td>
				<td>Cambios</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Imagenes)) {
					foreach ($Tabla_Imagenes as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TITULO();?></td>
							<td><?php echo $t_fila -> obtener_FAMILIA();?></td>
							<td><?php echo $accion -> componer_fecha($t_fila -> obtener_MODIFICADO(), 'fecha_hora');?></td>
							<td><?php if($t_fila -> obtener_INTENTOS() - 1 > 0){ echo $t_fila -> obtener_INTENTOS() - 1;} else{ echo 0;}?></td>
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
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_img('<?php echo $t_fila -> obtener_ID();?>','CAM_IMG');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_img('<?php echo $t_fila -> obtener_ID();?>','BOR_IMG');">
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
	<form method="POST" action="<?php echo IMAGENES; ?>" enctype="multipart/form-data" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nueva Imagen</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Img"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_img('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="archivo">Entrada Imagen:</label>
			<input type="file" id="archivo" name="n_imagen" required>
		</div>
		<?php
			if (isset($_POST['Nue_Img'])) {
				$val_nuevo -> m_Eimagen();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="familia">Familia Imagen:</label>
					<input type="text" id="familia" name="n_familia" required <?php if(isset($_POST['Nue_Img'])){$val_nuevo->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="n_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Imagenes = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Imagenes)){echo count($Familia_Imagenes);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Imagenes)) {
									foreach ($Familia_Imagenes as $f_imagen) {
										?>
										<option value="<?php echo $f_imagen;?>"><?php echo $f_imagen;?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Nue_Img'])) {
				$val_nuevo -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<label for="fuente">Fuente Imagen:</label>
			<input type="text" id="fuente" name="n_fuente" required <?php if(isset($_POST['Nue_Img'])){$val_nuevo->r_fuente();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Img'])) {
				$val_nuevo -> m_Efuente();
			}
		?>
		<div class="grupo-form">
			<label for="notas">Notas Imagen:</label>
			<textarea name="n_notas" id="notas" cols="30" rows="12" required><?php if(isset($_POST['Nue_Img'])){$val_nuevo->r_notas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Img'])) {
				$val_nuevo -> m_Enotas();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Img"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_img('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo IMAGENES; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Imagen</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Img"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_img('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Imagen:</label>
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
			if (isset($_POST['Cam_Img'])) {
				$val_cambiar -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familia">Familia Imagen:</label>
					<input type="text" id="ajax_familia" name="cam_familia" required <?php if(isset($_POST['Cam_Img'])){$val_cambiar->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Imagenes = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php echo count($Familia_Imagenes);?>	 ]</option>
							<?php
								if (count($Familia_Imagenes)) {
									foreach ($Familia_Imagenes as $f_imagen) {
										?>
										<option value="<?php echo $f_imagen;?>"><?php echo $f_imagen;?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Cam_Img'])) {
				$val_cambiar -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<input type="text" id="ajax_fuente" name="cam_fuente" required <?php if(isset($_POST['Cam_Img'])){$val_cambiar->r_fuente();}?> >
			<label for="ajax_fuente">Fuente Imagen:</label>
		</div>
		<?php
			if (isset($_POST['Cam_Img'])) {
				$val_cambiar -> m_Efuente();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_notas">Notas Imagen:</label>
			<textarea name="cam_notas" id="ajax_notas" cols="30" rows="12" required><?php if(isset($_POST['Cam_Img'])){$val_cambiar->r_notas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Img'])) {
				$val_cambiar -> m_Enotas();
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Img'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Img"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_img('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo IMAGENES;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Imagen ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Img"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_img('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Imagen:</label>
				<label class="col-md-9" id="ajax_bor_titulo"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_bor_creacion"></label>	
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Img'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Img'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Img"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_img('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_img(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case'NUE_IMG':
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
			case'CAM_IMG':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'IMAGEN', 'buscar':'id', 'dato':id};
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
			case 'BOR_IMG':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'IMAGEN', 'buscar':'id', 'dato':id};
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
	if (isset($_POST['Nue_Img'])) {
		if (!$val_nuevo -> v_nuevo()) {
			?>
			<script>
				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_familia();?>"]').prop('selected', true);
				if ($('#n_familia_select').val() != "Vacio") {
					$('#n_familia_select').css('background', '#755860');
				}

				op_img('', 'NUE_IMG');
			</script>
			<?php
		}
	}
	if (isset($_POST['Cam_Img'])) {
		if (!$val_cambiar -> v_cambiar()) {
			?>
			<script>
				var ajax_H = {'atributo':'IMAGEN', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_IMG_ERRORES');

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

				$('#cam_familia_select option[value="<?php echo $val_cambiar -> pasar_familia();?>"]').prop('selected', true);
				if ($('#cam_familia_select').val() != "Vacio") {
					$('#cam_familia_select').css('background', '#755860');
				}

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>