<?php
	use \realiza_archivo\archivo as VD;
	use \base_archivo\archivo as GD;
	use \crud_archivo\archivo as BD;

	$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
	$accion = new VD($sn, '', '', '', '', '', '');
	$Tabla_Archivos = $accion -> tabla_archivos('', $Hyzher_id, 'a.archivo_modificado DESC');
	$Familia_Bruta = $accion -> familia_archivo($Hyzher_id);
	$arch_contados = $accion -> archivos_contados($Hyzher_id);
;
	
	if (isset($_POST['Nue_Arch'])) {
		$archivo_array = array('error' => $_FILES['n_archivo']['error'], 'tamanio' => $_FILES['n_archivo']['size'], 'tipo' => $_FILES['n_archivo']['type'], 'titulo' => $_FILES['n_archivo']['name'], 'ruta' => $_FILES['n_archivo']['tmp_name']);
		$val_nuevo = new VD($archivo_array, $_POST['n_familia'], $_POST['n_derechos'], $_POST['n_notas'], '', '', '');
		if ($val_nuevo -> v_nuevo()) {
			$subir_archivo = move_uploaded_file($val_nuevo -> pasar_ruta_temporal(), $val_nuevo -> pasar_ruta_envio());
			if ($subir_archivo) {
				$archivo = new GD('', $Hyzher_id, $val_nuevo -> pasar_titulo(), $val_nuevo -> pasar_familia(), $val_nuevo -> pasar_ruta_envio(), $val_nuevo -> pasar_derechos(), $val_nuevo -> pasar_notas(), '', '', '', '');
				if (BD::nuevo($archivo, 'nuevo')) {
					redireccion::redirigir(ARCHIVOS);
				}else{
					unlink($val_nuevo -> pasar_ruta_envio());
				}
			}else{
				unlink($val_nuevo -> pasar_ruta_envio());
			}
		}
	}

	if (isset($_POST['Cam_Arch'])) {
		$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
		$val_cambiar = new VD($sn, $_POST['cam_familia'], $_POST['cam_derechos'], $_POST['cam_notas'], $_POST['cam_estado'], $_POST['cam_id'], $Hyzher_id);
		if ($val_cambiar -> v_cambiar()) {
			$archivo = new GD($val_cambiar -> pasar_id(), $Hyzher_id, '', $val_cambiar -> pasar_familia(), '', $val_cambiar -> pasar_derechos(), $val_cambiar -> pasar_notas(), '', '', '', $val_cambiar -> pasar_estado());
			if (BD::modificar($archivo, 'cambiar')) {
				redireccion::redirigir(ARCHIVOS);
			}
		}
	}

	if (isset($_POST['Bor_Arch'])) {
		$sn = array('error' => '', 'tamanio' => '', 'tipo' => '', 'titulo' => '', 'ruta' => '');
		$val_borrar = new VD($sn, '', '', '', '', $_POST['bor_id'], $Hyzher_id);
		$val_borrar -> ruta_envio($_POST['bor_id'], $Hyzher_id);
		if ($val_borrar -> v_borrar()) {
			$archivo = new GD($val_borrar -> pasar_id(), $Hyzher_id, '', '', '', '', '', '', '', '', '');
			$borrar_archivo = unlink($val_borrar -> pasar_ruta_envio());
			if ($borrar_archivo) {
				if (BD::eliminar($archivo)) {
					redireccion::redirigir(ARCHIVOS);
				}
			}
			
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_arch('','NUE_ARCH');">Nuevo Archivo</button>
		<div class="detalles">
			<span>Total: <?php echo $arch_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Archivos <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Titulo</td>
				<td>Derechos</td>
				<td>Modificado</td>
				<td>Cambios</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Archivos)) {
					foreach ($Tabla_Archivos as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TITULO();?></td>
							<td><?php echo $t_fila -> obtener_DERECHOS();?></td>
							<td><?php echo $accion -> componer_fecha($t_fila -> obtener_MODIFICADO(), 'fecha_hora');?></td>
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
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_arch('<?php echo $t_fila -> obtener_ID();?>','CAM_ARCH');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_arch('<?php echo $t_fila -> obtener_ID();?>','BOR_ARCH');">
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
	<form method="POST" action="<?php echo ARCHIVOS; ?>" enctype="multipart/form-data" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Archivo</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Arch"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_arch('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="archivo">Entrada Archivo:</label>
			<input type="file" id="archivo" name="n_archivo" required>
		</div>
		<?php
			if (isset($_POST['Nue_Arch'])) {
				$val_nuevo -> m_Earchivo();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="familia">Familia Archivo:</label>
					<input type="text" id="familia" name="n_familia" required <?php if(isset($_POST['Nue_Arch'])){$val_nuevo->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="n_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Archivos = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Archivos)){echo count($Familia_Archivos);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Archivos)) {
									foreach ($Familia_Archivos as $f_archivo) {
										?>
										<option value="<?php echo $f_archivo;?>"><?php echo $f_archivo;?></option>
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
			if (isset($_POST['Nue_Arch'])) {
				$val_nuevo -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<label for="derechos">Derechos Autor:</label>
			<input type="text" id="derechos" name="n_derechos" required <?php if(isset($_POST['Nue_Arch'])){$val_nuevo->r_derechos();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Arch'])) {
				$val_nuevo -> m_Ederechos();
			}
		?>
		<div class="grupo-form">
			<label for="notas">Notas Archivo:</label>
			<textarea name="n_notas" id="notas" cols="30" rows="12" required><?php if(isset($_POST['Nue_Arch'])){$val_nuevo->r_notas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Arch'])) {
				$val_nuevo -> m_Enotas();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Arch"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_arch('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo ARCHIVOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Archivo</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Arch"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_arch('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
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
			if (isset($_POST['Cam_Arch'])) {
				$val_cambiar -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familia">Familia Archivo:</label>
					<input type="text" id="ajax_familia" name="cam_familia" required <?php if(isset($_POST['Cam_Arch'])){$val_cambiar->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Archivos = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php echo count($Familia_Archivos);?>	 ]</option>
							<?php
								if (count($Familia_Archivos)) {
									foreach ($Familia_Archivos as $f_archivo) {
										?>
										<option value="<?php echo $f_archivo;?>"><?php echo $f_archivo;?></option>
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
			if (isset($_POST['Cam_Arch'])) {
				$val_cambiar -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_derechos">Derechos Autor:</label>
			<input type="text" id="ajax_derechos" name="cam_derechos" required <?php if(isset($_POST['Cam_Arch'])){$val_cambiar->r_derechos();}?> >
		</div>
		<?php
			if (isset($_POST['Cam_Arch'])) {
				$val_cambiar -> m_Ederechos();
			}
		?>
		<div class="grupo-form">
			<label for="notas">Notas Archivo:</label>
			<textarea name="cam_notas" id="ajax_notas" cols="30" rows="12" required><?php if(isset($_POST['Cam_Arch'])){$val_cambiar->r_notas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Arch'])) {
				$val_cambiar -> m_Enotas();
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Arch'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Arch"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_arch('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo ARCHIVOS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Archivo ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Arch"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_arch('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
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
			if (isset($_POST['Bor_Arch'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Arch'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Arch"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_arch('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_arch(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_ARCH':
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
			case 'CAM_ARCH':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'ARCHIVO', 'buscar':'id', 'dato':id};
				ajax_global(ajax_H, accion);
				$('#e_VFrag').remove();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
				break;
					case 'X_cambiar':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_cambiado').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'BOR_ARCH':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'ARCHIVO', 'buscar':'id', 'dato':id};
				ajax_global(ajax_H, accion);
				$('#e_VFrag').remove();
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
	if (isset($_POST['Nue_Arch'])) {
		if (!$val_nuevo -> v_nuevo()) {
			?>
			<script>
				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_familia();?>"]').prop('selected', true);
				if ($('#n_familia_select').val() != "Vacio") {
					$('#n_familia_select').css('background', '#755860');
				}

				op_arch('', 'NUE_ARCH');
			</script>
			<?php
		}
	}
	if (isset($_POST['Cam_Arch'])) {
		if (!$val_cambiar -> v_cambiar()) {
			?>
			<script>
				var ajax_H = {'atributo':'ARCHIVO', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_ARCH_ERRORES');

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