<?php
	use \realiza_personaje\personaje as VD;
	use \base_personaje\personaje as GD;
	use \crud_personaje\personaje as BD;

	$accion = new VD('', '','' ,'', '', '', '', '' ,'', '', '', '','');
	$Tabla_Personajes = $accion -> tabla_personajes('', $Hyzher_id, 'p.personaje_modificado DESC');
	$Familia_Bruta = $accion -> familia_personajes($Hyzher_id);
	$per_permitidos = $accion -> detalles_personaje($Hyzher_id);
	$per_contados = $accion -> personajes_contados($Hyzher_id);
	$per_imagenes = $accion -> mis_imagenes($Hyzher_id);

	if (isset($_POST['Nue_Per'])) {
		$val_nuevo = new VD($_POST['n_imagen'], $_POST['n_nombre'], $_POST['n_familia'], $_POST['n_edad'], $_POST['n_sexo'], $_POST['n_relacion'], $_POST['n_personalidad'], $_POST['n_historia'], $_POST['n_metas'], $_POST['n_extras'], '', '', $Hyzher_id);
		if ($per_contados < $per_permitidos) {
			if ($val_nuevo -> v_nuevo()) {
				$personaje = new GD('', $Hyzher_id, $val_nuevo -> pasar_imagen(), $val_nuevo -> pasar_nombre(), $val_nuevo -> pasar_familia(), $val_nuevo -> pasar_edad(), $val_nuevo -> pasar_sexo(), $val_nuevo -> pasar_relacion(), $val_nuevo -> pasar_personalidad(), $val_nuevo -> pasar_historia(), $val_nuevo -> pasar_metas(), $val_nuevo -> pasar_extras(), '', '', '', '');
				if (BD::nuevo($personaje, 'nuevo')) {
					redireccion::redirigir(PERSONAJES);
				}
			}
		}
	}

	if (isset($_POST['Cam_Per'])) {
		$val_cambiar = new VD($_POST['cam_imagen'], '', $_POST['cam_familia'], $_POST['cam_edad'], $_POST['cam_sexo'], $_POST['cam_relacion'], $_POST['cam_personalidad'], $_POST['cam_historia'], $_POST['cam_metas'], $_POST['cam_extras'], $_POST['cam_estado'], $_POST['cam_id'], $Hyzher_id);
		if ($val_cambiar -> v_cambiar()) {
			$personaje = new GD($val_cambiar -> pasar_id(), $Hyzher_id, $val_cambiar -> pasar_imagen(), '', $val_cambiar -> pasar_familia(), $val_cambiar -> pasar_edad(), $val_cambiar -> pasar_sexo(), $val_cambiar -> pasar_relacion(), $val_cambiar -> pasar_personalidad(), $val_cambiar -> pasar_historia(), $val_cambiar -> pasar_metas(), $val_cambiar -> pasar_extras(), '', '', '', $val_cambiar -> pasar_estado());
			if (BD::modificar($personaje, 'cambiar')) {
				redireccion::redirigir(PERSONAJES);
			}
		}
	}

	if (isset($_POST['Bor_Per'])) {
		$val_borrar = new VD('', '', '', '', '', '', '', '', '', '', '', $_POST['bor_id'], $Hyzher_id);
		if ($val_borrar -> v_borrar()) {
			$personaje = new GD($val_borrar -> pasar_id(), $Hyzher_id, '', '', '', '', '', '', '', '', '', '', '', '', '', '');
			if (BD::eliminar($personaje)) {
				redireccion::redirigir(PERSONAJES);
			}
		}
	}

?>

<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_per('','NUE_PER');">Nuevo Personaje</button>
		<div class="detalles">
			<span>Total: <?php echo $per_contados;?></span>
			<span>Sobran: <?php echo $per_permitidos - $per_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Personajes <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Nombre</td>
				<td>Familia</td>
				<td>Modificado</td>
				<td>Cambios</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Personajes)) {
					foreach ($Tabla_Personajes as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_NOMBRE();?></td>
							<td><?php echo $t_fila -> obtener_FAMILIA();?></td>
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
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_per('<?php echo $t_fila -> obtener_ID();?>','CAM_PER');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_per('<?php echo $t_fila -> obtener_ID();?>','BOR_PER');">
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
	<form method="POST" action="<?php echo PERSONAJES;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Personaje</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Per"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_per('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="nombre">Nombre Personaje:</label>
			<input type="text" name="n_nombre" required <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_nombre();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Enombre();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="familia">Familia Personaje:</label>
					<input type="text" id="familia" name="n_familia" required <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="n_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Personajes = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Personajes)){echo count($Familia_Personajes);}else{echo "0";}?>	 ]</option>
							<?php
								if (count($Familia_Personajes)) {
									foreach ($Familia_Personajes as $f_personaje) {
										?>
										<option value="<?php echo $f_personaje;?>"><?php echo $f_personaje;?></option>
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
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<label for="edad">Edad Personaje:</label>
			<input type="text" name="n_edad" required <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_edad();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Eedad();
			}
		?>
		<div class="grupo-form">
			<label for="sexo">Sexo Personaje:</label>
			<input type="text" name="n_sexo" required <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_sexo();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Esexo();
			}
		?>
		<div class="grupo-form">
			<label for="relacion">Relación Personaje:</label>
			<input type="text" name="n_relacion" required <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_relacion();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Erelacion();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="personalidad">Personalidad Personaje:</label>
			<textarea name="n_personalidad" id="n_WYSIWYG"><?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_personalidad();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Epersonalidad();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="historia">Historia Personaje:</label>
			<textarea name="n_historia" id="n_WYSIWYG"><?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_historia();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Ehistoria();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="metas">Metas Personaje:</label>
			<textarea name="n_metas" id="n_WYSIWYG"><?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_metas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Emetas();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="extras">Extras Personaje:</label>
			<textarea name="n_extras" id="n_WYSIWYG"><?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_extras();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Eextras();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte slider">
					<label for="extras">Imagen Personaje:</label>
					<div class="caja-select trozo">
						<select id="selectImgFamNuevo">
							
							<?php
								if (count($per_imagenes)) {
									foreach ($per_imagenes as $fam_img) {
										$Fam_I[] = $fam_img -> obtener_FAMILIA();
									}
									$Familia_imagenes = array_unique($Fam_I);
								}
							?>
							<option value="imagenesHlymboo">Todas Imagenes</option>
							<?php
								if (count($Familia_imagenes)) {
									foreach ($Familia_imagenes as $f_imagen) {
										?>
										<option value="<?php echo $f_imagen;?>"><?php echo $f_imagen;?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
					<div class="libre" id="infoImagenNuevo">
						<span id="imagenNombre"></span>
						<span id="imagenCreado"></span>
						<span id="imagenNotas"></span>
					</div>
					<input type="text" class="trozo ocultar" id="imagen" name="n_imagen" required readonly <?php if(isset($_POST['Nue_Per'])){$val_nuevo->r_imagen();}?>>
				</div>
				<div class="parte slider">
					<div class="marco" id="marco1">
						<div class="slider" id="slider1" style="width: <?php echo ((count($per_imagenes))*100)."%";?>">
							<?php
							foreach ($per_imagenes as $la_img) {
								if (count($per_imagenes)) {
									?>
									<section>
										<img src="<?php echo $accion -> componer_ruta($la_img -> obtener_RUTA());?>" alt="">
										<div class="detalles">
											<span class="p-detalles" id="titulo"><b>Titulo:</b> <?php echo $la_img -> obtener_TITULO()?></span>
											<span class="p-detalles" id="fam"><b>Familia:</b> <?php echo $la_img -> obtener_FAMILIA();?></span>
											<span class="p-detalles" id="creado"><b>Creado:</b> <?php echo $accion -> componer_fecha($la_img -> obtener_CREADO(), 'fecha_1');?></span>
											<p class="p-detalles"><b>Fuente:</b> <?php echo $la_img -> obtener_FUENTE();?></p>
											<span class="p-detalles" id="notas">"<?php echo $la_img -> obtener_NOTAS();?>"</span>
										</div>
										<input type="hidden" id="id" readonly value = "<?php echo $la_img -> obtener_ID();?>">
										<input type="hidden" id="familia" readonly value = "<?php echo $la_img -> obtener_FAMILIA();?>">
									</section>
									<?php
								}
							}
							?>
						</div>
						<div class="controles" id="controles">
							<div class="btn" id="m_izq"></div>
							<div class="btn" id="m_capturar"></div>
							<div class="btn" id="m_der"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Nue_Per'])) {
				$val_nuevo -> m_Eimagen();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Per"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_per('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo PERSONAJES;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Personaje</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Per"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_per('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Nombre Personaje:</label>
				<label class="col-md-9" id="ajax_nombre"></label>
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
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familia">Familia Personaje:</label>
					<input type="text" id="ajax_familia" name="cam_familia" required <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Personajes = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php echo count($Familia_Personajes);?>	 ]</option>
							<?php
								if (count($Familia_Personajes)) {
									foreach ($Familia_Personajes as $f_personaje) {
										?>
										<option value="<?php echo $f_personaje;?>"><?php echo $f_personaje;?></option>
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
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_edad">Edad Personaje:</label>
			<input type="text" id="ajax_edad" name="cam_edad" required <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_edad();}?> >
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Eedad();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_sexo">Sexo Personaje:</label>
			<input type="text" id="ajax_sexo" name="cam_sexo" required <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_sexo();}?> >
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Esexo();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_relacion">Relación Personaje:</label>
			<input type="text" id="ajax_relacion" name="cam_relacion" required <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_relacion();}?> >
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Erelacion();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="ajax_personalidad">Personalidad Personaje:</label>
			<textarea name="cam_personalidad" id="ajax_personalidad"><?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_personalidad();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Epersonalidad();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="ajax_historia">Historia Personaje:</label>
			<textarea name="cam_historia" id="ajax_historia"><?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_historia();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Ehistoria();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="ajax_metas">Metas Personaje:</label>
			<textarea name="cam_metas" id="ajax_metas"><?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_metas();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Emetas();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="ajax_extras">Extras Personaje:</label>
			<textarea name="cam_extras" id="ajax_extras"><?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_extras();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Eextras();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte slider">
					<label for="extras">Imagen Personaje:</label>
					<div class="caja-select trozo">
						<select id="selectImgFamCambiar">
							
							<?php
								if (count($per_imagenes)) {
									foreach ($per_imagenes as $fam_img) {
										$Fam_I[] = $fam_img -> obtener_FAMILIA();
									}
									$Familia_imagenes = array_unique($Fam_I);
								}
							?>
							<option value="imagenesHlymboo">Todas Imagenes</option>
							<?php
								if (count($Familia_imagenes)) {
									foreach ($Familia_imagenes as $f_imagen) {
										?>
										<option value="<?php echo $f_imagen;?>"><?php echo $f_imagen;?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
					<div class="libre" id="infoImagenCambiar">
						<span id="imagenNombre"></span>
						<span id="imagenCreado"></span>
						<span id="imagenNotas"></span>
					</div>
					<input type="text" class="trozo ocultar" id="ajax_imagen" name="cam_imagen" required readonly <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_imagen();}?>>
				</div>
				<div class="parte slider">
					<div class="marco" id="marco2">
						<div class="slider" id="slider2" style="width: <?php echo ((count($per_imagenes))*100)."%";?>">
							<?php
							foreach ($per_imagenes as $la_img) {
								if (count($per_imagenes)) {
									?>
									<section>
										<img src="<?php echo $accion -> componer_ruta($la_img -> obtener_RUTA());?>" alt="">
										<div class="detalles">
											<span class="p-detalles" id="titulo"><b>Titulo:</b> <?php echo $la_img -> obtener_TITULO()?></span>
											<span class="p-detalles" id="fam"><b>Familia:</b> <?php echo $la_img -> obtener_FAMILIA();?></span>
											<span class="p-detalles" id="creado"><b>Creado:</b> <?php echo $accion -> componer_fecha($la_img -> obtener_CREADO(), 'fecha_1');?></span>
											<p class="p-detalles"><b>Fuente:</b> <?php echo $la_img -> obtener_FUENTE();?></p>
											<span class="p-detalles" id="notas">"<?php echo $la_img -> obtener_NOTAS();?>"</span>
										</div>
										<input type="hidden" id="id" readonly value = "<?php echo $la_img -> obtener_ID();?>">
										<input type="hidden" id="familia" readonly value = "<?php echo $la_img -> obtener_FAMILIA();?>">
									</section>
									<?php
								}
							}
							?>
						</div>
						<div class="controles" id="controles">
							<div class="btn" id="m_izq"></div>
							<div class="btn" id="m_capturar"></div>
							<div class="btn" id="m_der"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Cam_Per'])) {
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Per"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_per('', 'X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo PERSONAJES;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Personaje ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Per"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_per('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Nombre Personaje:</label>
				<label class="col-md-9" id="ajax_bor_nombre"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_bor_creacion"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Per'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Per'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Per"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_per('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
function op_per(id, accion){
	$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_PER':
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
			case 'CAM_PER':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'PERSONAJE', 'buscar':'id', 'dato':id};
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
			case 'BOR_PER':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'PERSONAJE', 'buscar':'id', 'dato':id};
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
	if (isset($_POST['Nue_Per'])) {
		if (!$val_nuevo -> v_nuevo()) {
			?>
			<script>
				op_per('', 'NUE_PER');

				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_familia();?>"]').prop('selected', true);
				if ($('#n_familia_select').val() != "Vacio") {
					$('#n_familia_select').css('background', '#755860');
				}
				<?php
				if(!empty($val_nuevo -> pasar_imagen())){
				?>
					var idImgDetalle = <?php echo $val_nuevo -> pasar_imagen();?>;
					$('#infoImagenNuevo').find('#imagenNombre').text($('#slider1').find('input[value='+idImgDetalle+']').closest('section').find('span#titulo').text());
					$('#infoImagenNuevo').find('#imagenCreado').text($('#slider1').find('input[value='+idImgDetalle+']').closest('section').find('span#creado').text());
					$('#infoImagenNuevo').find('#imagenNotas').text($('#slider1').find('input[value='+idImgDetalle+']').closest('section').find('span#notas').text());
				<?php
				}
				?>
			</script>
			<?php
		}
	}

	if (isset($_POST['Cam_Per'])) {
		if (!$val_cambiar -> v_cambiar()) {
			?>
			<script>
				var ajax_H = {'atributo':'PERSONAJE', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_PER_ERRORES');

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

				<?php
				if(!empty($val_cambiar -> pasar_imagen())){
				?>
					var idImgDetalle = <?php echo $val_cambiar -> pasar_imagen();?>;
					$('#infoImagenCambiar').find('#imagenNombre').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#titulo').text());
					$('#infoImagenCambiar').find('#imagenCreado').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#creado').text());
					$('#infoImagenCambiar').find('#imagenNotas').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#notas').text());
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
<script>
	tinymce.init({ 
		selector: 'textarea[id="n_WYSIWYG"]',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount'
		],
		toolbar1: 'undo redo | newdocument print | table | link image | searchreplace | code fullscreen',
		toolbar2: 'styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | visualblocks removeformat',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});
	tinymce.init({ 
		selector: '#ajax_personalidad',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount'
		],
		toolbar1: 'undo redo | newdocument print | table | link image | searchreplace | code fullscreen',
		toolbar2: 'styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | visualblocks removeformat',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});	
	tinymce.init({ 
		selector: '#ajax_historia',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount'
		],
		toolbar1: 'undo redo | newdocument print | table | link image | searchreplace | code fullscreen',
		toolbar2: 'styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | visualblocks removeformat',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});	
	tinymce.init({ 
		selector: '#ajax_metas',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount'
		],
		toolbar1: 'undo redo | newdocument print | table | link image | searchreplace | code fullscreen',
		toolbar2: 'styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | visualblocks removeformat',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});	
	tinymce.init({ 
		selector: '#ajax_extras',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount'
		],
		toolbar1: 'undo redo | newdocument print | table | link image | searchreplace | code fullscreen',
		toolbar2: 'styleselect | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | visualblocks removeformat',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});
</script>