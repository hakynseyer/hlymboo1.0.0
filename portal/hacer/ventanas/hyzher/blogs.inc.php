<?php
	use \realiza_blog\blog as VD;
	use \base_blog\blog as GD;
	use \crud_blog\blog as BD;

	$accion = new VD('', '', '', '', '', '', '', '', '', '', '', '', '', '');
	$Tabla_Blogs = $accion -> tabla_blogs('', $Hyzher_id, 'blog_modificado DESC');
	$blog_contados = $accion -> blogs_contados($Hyzher_id);
	$Familia_Bruta = $accion -> familia_blogs($Hyzher_id);
	$Mis_categorias = $accion -> categorias_blogs();
	$Mis_clasificaciones = $accion -> clasificaciones_blogs();
	$Mis_personajes = $accion -> mis_personajes($Hyzher_id);
	$Mis_fragmentos = $accion -> mis_fragmentos($Hyzher_id);
	$Mis_imagenes = $accion -> mis_imagenes($Hyzher_id);
	$Mis_archivos = $accion -> Mis_archivos($Hyzher_id);

	if (isset($_POST['Nue_blog'])) {
		$val_nuevo = new VD('', '', '', $_POST['n_categoria'], $_POST['n_clasificacion'], $_POST['n_titulo'], $_POST['n_familia'], '', '', '', '', '', '', $Hyzher_id);
		if ($val_nuevo -> v_nuevo()) {
			$blog = new GD('', $Hyzher_id, '', '', '', $val_nuevo -> pasar_categoria(), $val_nuevo -> pasar_clasificacion(), $val_nuevo -> pasar_titulo(), $val_nuevo -> pasar_familia(), $val_nuevo -> pasar_url(), '', '', '', '', '', '', '', '');
			if (BD::nuevo($blog, 'nuevo')) {
				redireccion::redirigir(BLOGS);
			}
		}
	}

	if (isset($_POST['Con_Blog'])) {
		$val_texto = new VD('','','','','','','',$_POST['con_texto'],'','','','',$_POST['con_id'],$Hyzher_id);
		if ($val_texto -> v_contenido()) {
			$blog = new GD($val_texto -> pasar_id(),$Hyzher_id,'','','','','','','','',$val_texto -> pasar_texto(),'','','','','','','');
			$NumIntentos = BD::mostrar(array(0 => $val_texto -> pasar_id(), 1 => $Hyzher_id), 'numero_intentos','');
			if($NumIntentos[1] != 0){
				if ($NumIntentos[0] > 0) {
					if (BD::modificar($blog, 'contenido_modificado')) {
						redireccion::redirigir(BLOGS);
					}
				}else{
					if (BD::modificar($blog, 'contenido')) {
						redireccion::redirigir(BLOGS);
					}
				}
			}else{
				if (BD::modificar($blog, 'contenido_estado_oculto')) {
					redireccion::redirigir(BLOGS);
				}
			}
		}
	}

	if (isset($_POST['Det_blog'])) {
		$val_detalle = new VD('', '', '', $_POST['det_categoria'], $_POST['det_clasificacion'], '', $_POST['det_familia'], '', '', '', $_POST['det_derechos'], $_POST['det_estado'], $_POST['det_id'], $Hyzher_id);
		if ($val_detalle -> v_detalle()) {
			if (is_null($val_detalle -> pasar_estado_contenido() -> obtener_TEXTO())) {
				$blog = new GD($val_detalle -> pasar_id(), $Hyzher_id, '', '', '', $val_detalle -> pasar_categoria(), $val_detalle -> pasar_clasificacion(), '', $val_detalle -> pasar_familia(), '', '', '', '', $val_detalle -> pasar_derechos(), '', '', '', 0);
			}else{
				$blog = new GD($val_detalle -> pasar_id(), $Hyzher_id, '', '', '', $val_detalle -> pasar_categoria(), $val_detalle -> pasar_clasificacion(), '', $val_detalle -> pasar_familia(), '', '', '', '', $val_detalle -> pasar_derechos(), '', '', '', $val_detalle -> pasar_estado());
			}
			if (BD::modificar($blog, 'detalles')) {
				redireccion::redirigir(BLOGS);
			}
		}
	}

	if (isset($_POST['Pfi_blog'])) {
		$val_pfi = new VD($_POST['pfi_personaje'], $_POST['pfi_fragmento'], $_POST['pfi_imagen'], '', '', '', '', '', $_POST['pfi_archivo'], $_POST['pfi_archivo_estado'], '', '', $_POST['pfi_id'], $Hyzher_id);

		if ($val_pfi -> v_pfi()) {
			$blog = new GD($val_pfi -> pasar_id(), $Hyzher_id, $val_pfi -> pasar_personaje(), $val_pfi -> pasar_fragmento(), $val_pfi -> pasar_imagen(), '', '', '', '', '', '', $val_pfi -> pasar_archivo(), $val_pfi -> pasar_archivoactivo(), '', '', '', '', '');
			if (BD::modificar($blog, 'pfi_v1')) {
				redireccion::redirigir(BLOGS);
			}			
		}
	}

	if (isset($_POST['Bor_Blo'])) {
		$val_borrar = new VD('','','','','','','','','','','','',$_POST['bor_id'],$Hyzher_id);
		if ($val_borrar -> v_borrar()) {
			$blog = new GD($val_borrar -> pasar_id(),$Hyzher_id,'','','','','','','','','','','','','','','','');
			if (BD::eliminar($blog)) {
				redireccion::redirigir(BLOGS);
			}
		}
	}
?>

<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_blog('','NUE_BLOG');">Nuevo Blog</button>
		<div class="detalles">
			<span>Total: <?php echo $blog_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Blogs <?php echo $Hyzher_usuario;?></caption>
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
				if (count($Tabla_Blogs)) {
					foreach ($Tabla_Blogs as $t_fila) {
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
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_blog('<?php echo $t_fila -> obtener_ID();?>','CAM_BLOG_TEXTO');">
									<i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_blog('<?php echo $t_fila -> obtener_ID();?>','CAM_BLOG_DETALLES');">
									<i class="fa fa-folder-open fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_blog('<?php echo $t_fila -> obtener_ID();?>','CAM_BLOG_PFI');">
									<i class="fa fa-cubes fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_blog('<?php echo $t_fila -> obtener_ID();?>','BOR_BLOG');">
									<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<?php $PassVista = password_hash('1UnLoRoMoradO1',PASSWORD_DEFAULT);?>
									<a href="<?php echo $t_fila -> obtener_URL().'?Ent_Hyzh='.$PassVista; ?>" target="_blank">
										<i class="fa fa-file fa-2x" aria-hidden="true"></i>
									</a>
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
	<form method="POST" action="<?php echo BLOGS;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Blog</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_blog('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="titulo">Titulo Blog:</label>
			<input type="text" id="titulo" name="n_titulo" required <?php if(isset($_POST['Nue_blog'])){$val_nuevo->r_titulo();}?> >
		</div>
		<?php
			if (isset($_POST['Nue_blog'])) {
				$val_nuevo -> m_Etitulo();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="familia">Familia Blog:</label>
					<input type="text" id="familia" name="n_familia" required <?php if(isset($_POST['Nue_blog'])){$val_nuevo->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="n_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Blogs = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Blogs)){echo count($Familia_Blogs);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Blogs)) {
									foreach ($Familia_Blogs as $f_blog) {
										?>
										<option value="<?php echo $f_blog;?>"><?php echo $f_blog;?></option>
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
			if (isset($_POST['Nue_blog'])) {
				$val_nuevo -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Categorias Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="n_categoria" id="n_categoria_select">
						<option value="Vacio">Mis Categorias [ <?php echo count($Mis_categorias);?> ]</option>
						<?php
						if (count($Mis_categorias)) {
							foreach ($Mis_categorias as $Mis_cat) {
								?>
								<option value="<?php echo $Mis_cat -> obtener_ID();?>"><?php echo $Mis_cat -> obtener_TIPO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Nue_blog'])) {
				$val_nuevo -> m_Ecategoria();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Clasificaciones Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="n_clasificacion" id="n_clasificacion_select">
						<option value="Vacio">Mis Clasificaciones [ <?php echo count($Mis_clasificaciones);?> ]</option>
						<?php
						if (count($Mis_clasificaciones)) {
							foreach ($Mis_clasificaciones as $Mis_cla) {
								?>
								<option value="<?php echo $Mis_cla -> obtener_ID();?>"><?php echo $Mis_cla -> obtener_TIPO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Nue_blog'])) {
				$val_nuevo -> m_Eclasificacion();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_blog('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_escrito">
	<form method="POST" action="<?php echo BLOGS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Contenido Blog</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Con_Blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_contI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_blog('','X_contenido');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Blog:</label>
				<label class="col-md-9" id="ajax_con_titulo"></label>
				<label class="col-md-3">Ultima Modificación:</label>
				<label class="col-md-3" id="ajax_con_modificacion"></label>
			</div>
		</div>
		<div class="grupo-form-WYSIWYG">
			<textarea name="con_texto" id="con_texto" style="height: 10px;"><?php if(isset($_POST['Con_Blog'])){$val_texto->r_texto();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Con_Blog'])) {
				$val_texto -> m_Etexto();
				$val_texto -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_con_id" name="con_id" readonly <?php if(isset($_POST['Con_Blog'])){$val_texto->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Con_Blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_contF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_blog('','X_contenido');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_detallado">
	<form method="POST" action="<?php echo BLOGS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Detalles del Blog</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Det_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_detalleI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_blog('','X_detalle');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Blog:</label>
				<label class="col-md-9" id="ajax_titulo"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_creacion"></label>
				<label class="col-md-3">Ultima Modificación:</label>
				<label class="col-md-3" id="ajax_modificacion"></label>
			</div>
		</div>
		<div class="grupo-form">
			<label>Estado:</label>
			<div class="radio">
				<input type="radio" id="ajax_oculto" name="det_estado" value="0" checked>
				<label for="ajax_oculto">Oculto</label>
				<input type="radio" id="ajax_visible" name="det_estado" value="1">
				<label for="ajax_visible">Visible</label>
			</div>
			<p style="color: #fff; font-size: 14px; font-weight: bold;"> IMPORTANTE: Para publicarlo ("Visible") es necesario que exista un contenido en el blog, sin esto jamás será publicado.</p>
		</div>
		<?php
			if (isset($_POST['Det_blog'])) {
				$val_detalle -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familia">Familia Blog:</label>
					<input type="text" id="ajax_familia" name="det_familia" required <?php if(isset($_POST['Det_blog'])){$val_detalle->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Blogs = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Blogs)){echo count($Familia_Blogs);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Blogs)) {
									foreach ($Familia_Blogs as $f_blog) {
										?>
										<option value="<?php echo $f_blog;?>"><?php echo $f_blog;?></option>
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
			if (isset($_POST['Det_blog'])) {
				$val_detalle -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Categorias Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="det_categoria" id="cam_categoria_select">
						<option value="Vacio">Mis Categorias [ <?php echo count($Mis_categorias);?> ]</option>
						<?php
						if (count($Mis_categorias)) {
							foreach ($Mis_categorias as $Mis_cat) {
								?>
								<option value="<?php echo $Mis_cat -> obtener_ID();?>"><?php echo $Mis_cat -> obtener_TIPO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Det_blog'])) {
				$val_detalle -> m_Ecategoria();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Clasificaciones Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="det_clasificacion" id="cam_clasificacion_select">
						<option value="Vacio">Mis Clasificaciones [ <?php echo count($Mis_clasificaciones);?> ]</option>
						<?php
						if (count($Mis_clasificaciones)) {
							foreach ($Mis_clasificaciones as $Mis_cla) {
								?>
								<option value="<?php echo $Mis_cla -> obtener_ID();?>"><?php echo $Mis_cla -> obtener_TIPO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Det_blog'])) {
				$val_detalle -> m_Eclasificacion();
			}
		?>
		<div class="grupo-form">
			<label for="det_derechos">Derechos Blog:</label>
			<textarea name="det_derechos" id="det_derechos" cols="30" rows="12" required><?php if(isset($_POST['Det_blog'])){$val_detalle->r_derechos();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Det_blog'])) {
				$val_detalle -> m_Ederechos();
				$val_detalle -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_det_id" name="det_id" readonly <?php if(isset($_POST['Det_blog'])){$val_detalle->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Det_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_detalleF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_blog('','X_detalle');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_pfi">
	<form method="POST" action="<?php echo BLOGS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Complementos del Blog</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Pfi_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_pfiI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_blog('','X_pfi');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Blog:</label>
				<label class="col-md-9" id="ajaxPFI_titulo"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajaxPFI_creacion"></label>
				<label class="col-md-3">Ultima Modificación:</label>
				<label class="col-md-3" id="ajaxPFI_modificacion"></label>
			</div>
		</div>
		<div class="grupo-form">
			<label>Activar Opiniones:</label>
			<div class="radio">
				<input type="radio" id="ajax_oculto2" name="pfi_archivo_estado" value="0" checked>
				<label for="ajax_oculto2">Activados</label>
				<input type="radio" id="ajax_visible2" name="pfi_archivo_estado" value="1">
				<label for="ajax_visible2">Desactivados</label>
			</div>
		</div>
		<?php
			if (isset($_POST['Pfi_blog'])) {
				$val_pfi -> m_Earchivo();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Aisgnar personaje Autor:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="pfi_personaje" id="mod_personaje_select">
						<option value="Vacio">Mis Personajes [ <?php if(count($Mis_personajes)){echo count($Mis_personajes);}else{echo 'No hay personajes';}?> ]</option>
						<?php
						if (count($Mis_personajes)) {
							foreach ($Mis_personajes as $Mis_per) {
								?>
								<option value="<?php echo $Mis_per -> obtener_ID();?>"><?php echo $Mis_per -> obtener_NOMBRE();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Pfi_blog'])) {
				$val_pfi -> m_Epersonaje();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Asignar fragmento Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="pfi_fragmento" id="mod_fragmento_select">
						<option value="Vacio">Mis Fragmentos [ <?php if(count($Mis_fragmentos)){echo count($Mis_fragmentos);}else{echo 'No hay fragmentos';}?> ]</option>
						<?php
						if (count($Mis_fragmentos)) {
							foreach ($Mis_fragmentos as $Mis_frag) {
								?>
								<option value="<?php echo $Mis_frag -> obtener_ID();?>"><?php echo $Mis_frag -> obtener_TITULO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Pfi_blog'])) {
				$val_pfi -> m_Efragmento();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Asignar archivo Blog:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="pfi_archivo" id="mod_archivo_select">
						<option value="Vacio">Mis Archivos [ <?php if(count($Mis_archivos)){echo count($Mis_archivos);}else{echo 'No hay archivos';}?> ]</option>
						<?php
						if (count($Mis_archivos)) {
							foreach ($Mis_archivos as $Mis_arch) {
								?>
								<option value="<?php echo $Mis_arch -> obtener_ID();?>"><?php echo $Mis_arch -> obtener_TITULO();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte slider">
					<label for="extras">Asignar imagen Blog:</label>
					<div class="caja-select trozo">
						<select id="selectImgFamCambiar">
							
							<?php
								if (count($Mis_imagenes)) {
									foreach ($Mis_imagenes as $fam_img) {
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
					<input type="text" class="ocultar" id="ajax_imagen" name="pfi_imagen" required readonly <?php if(isset($_POST['Cam_Per'])){$val_cambiar->r_imagen();}?>>
				</div>
				<div class="parte slider">
					<div class="marco" id="marco2">
						<div class="slider" id="slider2" style="width: <?php echo ((count($Mis_imagenes))*100)."%";?>">
							<?php
							foreach ($Mis_imagenes as $la_img) {
								if (count($Mis_imagenes)) {
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
			if (isset($_POST['Pfi_blog'])) {
				$val_pfi -> m_Eimagen();
				$val_pfi -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_pfi_id" name="pfi_id" readonly <?php if(isset($_POST['Pfi_blog'])){$val_pfi->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Pfi_blog"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_pfiF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_blog('','X_pfi');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo BLOGS;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿Borrar Blog?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Blo"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_blog('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Blog:</label>
				<label class="col-md-9" id="ajax_bor_titulo"></label>
				<label class="col-md-3">Fecha Creación:</label>
				<label class="col-md-3" id="ajax_bor_creacion"></label>
				<label class="col-md-3">Ultima Modificación:</label>
				<label class="col-md-3" id="ajax_bor_modificacion"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Blo'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Blo'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Blo"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_blog('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>
<script>
function op_blog(id, accion){
	$('#el_principado').css('pointer-events' , 'none');
	switch(accion){
		case 'NUE_BLOG':
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
		case 'CAM_BLOG_TEXTO':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
            limpiador.limpiarT();
            var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
			$('#el_escrito').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_escrito").offset().top  }, 1);
			break;
				case 'X_contenido':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_escrito').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		case 'CAM_BLOG_DETALLES':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
            limpiador.limpiarD();
            var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
			$('#el_detallado').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_detallado").offset().top  }, 1);
			break;
				case 'X_detalle':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_detallado').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		case 'CAM_BLOG_PFI':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
			limpiador.limpiarP();
		 	var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
            $('#el_pfi').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_pfi").offset().top  }, 1);
			break;
				case 'X_pfi':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_pfi').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		case 'BOR_BLOG':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
			var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
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
	if (isset($_POST['Nue_blog'])) {
		if (!$val_nuevo -> v_nuevo()) {
			?>
			<script>
				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_familia();?>"]').prop('selected', true);
				if ($('#n_familia_select').val() != "Vacio") {
					$('#n_familia_select').css('background', '#755860');
				}

				$('#n_categoria_select option[value="<?php echo $val_nuevo -> pasar_categoria();?>"]').prop('selected', true);
				if ($('#n_categoria_select').val() != "Vacio") {
					$('#n_categoria_select').css('background', '#755860');
				}

				$('#n_clasificacion_select option[value="<?php echo $val_nuevo -> pasar_clasificacion();?>"]').prop('selected', true);
				if ($('#n_clasificacion_select').val() != "Vacio") {
					$('#n_clasificacion_select').css('background', '#755860');
				}

				op_blog('', 'NUE_BLOG');
			</script>
			<?php
		}
	}

	if (isset($_POST['Con_Blog'])) {
		if (!$val_texto -> v_contenido()) {
			?>
			<script>
				var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':<?php echo $val_texto -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_BLOG_TEXTO_ERRORES');

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_escrito').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_escrito").offset().top  }, 1);
			</script>
			<?php
		}
	}

	if (isset($_POST['Det_blog'])) {
		if (!$val_detalle -> v_detalle()) {
			?>
			<script>
				var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':<?php echo $val_detalle -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_BLOG_DETALLES_ERRORES');

				<?php
					if ($val_detalle -> pasar_estado() == 1) {
						?>
						$('#ajax_visible').prop("checked",true);
						<?php
					}else{
						?>
						$('#ajax_oculto').prop("checked",true);
						<?php
					}
				?>

				$('#cam_familia_select option[value="<?php echo $val_detalle -> pasar_familia();?>"]').prop('selected', true);
				if ($('#cam_familia_select').val() != "Vacio") {
					$('#cam_familia_select').css('background', '#755860');
				}

				$('#cam_categoria_select option[value="<?php echo $val_detalle -> pasar_categoria();?>"]').prop('selected', true);
				if ($('#cam_categoria_select').val() != "Vacio") {
					$('#cam_categoria_select').css('background', '#755860');
				}

				$('#cam_clasificacion_select option[value="<?php echo $val_detalle -> pasar_clasificacion();?>"]').prop('selected', true);
				if ($('#cam_clasificacion_select').val() != "Vacio") {
					$('#cam_clasificacion_select').css('background', '#755860');
				}

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_detallado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_detallado").offset().top  }, 1);
			</script>
			<?php
		}
	}

	if (isset($_POST['Pfi_blog'])) {
		if (!$val_pfi -> v_pfi()) {
			?>
			<script>
				var ajax_H = {'atributo':'BLOG', 'buscar':'id', 'dato':<?php echo $val_pfi -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_BLOG_PFI_ERRORES');

				$('#mod_personaje_select option[value="<?php echo $val_pfi -> pasar_personaje();?>"]').prop('selected', true);
				if ($('#mod_personaje_select').val() != "Vacio") {
					$('#mod_personaje_select').css('background', '#755860');
				}

				$('#mod_fragmento_select option[value="<?php echo $val_pfi -> pasar_fragmento();?>"]').prop('selected', true);
				if ($('#mod_fragmento_select').val() != "Vacio") {
					$('#mod_fragmento_select').css('background', '#755860');
				}

				$('#mod_archivo_select option[value="<?php echo $val_pfi -> pasar_archivo();?>"]').prop('selected', true);
				if ($('#mod_archivo_select').val() != "Vacio") {
					$('#mod_archivo_select').css('background', '#755860');
				}

				<?php
					if ($val_pfi -> pasar_archivoactivo() == 1) {
						?>
						$('#ajax_visible2').prop("checked",true);
						<?php
					}else{
						?>
						$('#ajax_oculto2').prop("checked",true);
						<?php
					}
				?>
				<?php
				if(!empty($val_pfi -> pasar_imagen())){
				?>
					var idImgDetalle = <?php echo $val_pfi -> pasar_imagen();?>;
					$('#infoImagenCambiar').find('#imagenNombre').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#titulo').text());
					$('#infoImagenCambiar').find('#imagenCreado').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#creado').text());
					$('#infoImagenCambiar').find('#imagenNotas').text($('#slider2').find('input[value='+idImgDetalle+']').closest('section').find('span#notas').text());
				<?php
				}
				?>

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_pfi').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_pfi").offset().top  }, 1);

			</script>
			<?php
		}
	}
?>
<script>
	tinymce.init({ 
		selector: '#con_texto',
  		height: 350,
  		menubar: false,
		plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code wordcount textcolor colorpicker'
		],
		image_caption: true,
		toolbar1: 'undo redo | newdocument print | insert table | link image | searchreplace visualblocks | code fullscreen',
		toolbar2: 'fontsizeselect styleselect | forecolor backcolor | bold italic strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat',
		fontsize_formats: '8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt',
	 	contextmenu: "link image | bold italic strikethrough | removeformat alignment"
	});
</script>

