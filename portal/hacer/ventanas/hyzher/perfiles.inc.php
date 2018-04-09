<?php
	use \realiza_perfil\perfil as VD;
	use \base_perfil\perfil as GD;
	use \crud_perfil\perfil as BD;

	$accion = new VD('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
	$Tabla_Perfil = $accion -> tabla_perfil($Hyzher_id, 'id_perfil');
	$Mis_imagenes = $accion -> mis_imagenes($Hyzher_id);
	$Mis_fragmentos = $accion -> mis_fragmentos($Hyzher_id);

if(isset($_POST['Nue_Perf'])){
	$val_nuevo = new VD($Hyzher_id, '', '', $_POST['n_dia'], $_POST['n_mes'], $_POST['n_anio'], $_POST['n_lugar'], $_POST['n_soy'], '', '', '', '', '', '', '');
	if($val_nuevo -> v_nuevo()){
		$perfil = new GD('', $Hyzher_id, '', '', $val_nuevo -> pasar_nacimiento(), $val_nuevo -> pasar_lugar(), $val_nuevo -> pasar_soy(), '', '', '', '', '', '');
		if(BD::nuevo($perfil, 'perfil')){
			redireccion::redirigir(PERFILES);
		}
	}
}

if(isset($_POST['Cam_Perf'])){
	$val_perfil = new VD($Hyzher_id, '', '', $_POST['cam_dia'], $_POST['cam_mes'], $_POST['cam_anio'], $_POST['cam_lugar'], $_POST['cam_soy'], '', '', '', '', '', '', $_POST['perfil_id']);
	if($val_perfil -> v_perfil()){
		$perfil = new GD($val_perfil -> pasar_id(), $Hyzher_id, '', '', $val_perfil -> pasar_nacimiento(), $val_perfil -> pasar_lugar(), $val_perfil -> pasar_soy(), '', '', '', '', '', '');
		if(BD::modificar($perfil, 'perfil')){
			redireccion::redirigir(PERFILES);
		}
	}
}

if(isset($_POST['Img_Perf'])){
	$val_imagen = new VD($Hyzher_id, $_POST['pfi_imagen'], '', '', '', '', '', '', '', '', '', '', '', '', $_POST['pfi_id']);
	if($val_imagen -> v_img()){
		$perfil = new GD($val_imagen -> pasar_id(), $Hyzher_id, $val_imagen -> pasar_imagen(), '', '', '', '', '', '', '', '', '', '');
		if(BD::modificar($perfil, 'imagen')){
			redireccion::redirigir(PERFILES);
		}
	}
}

if(isset($_POST['Soc_Per'])){
	$val_social = new VD($Hyzher_id, '', $_POST['social_fragmento'], '', '', '', '', '', $_POST['social1_perf'], $_POST['social2_perf'], $_POST['social3_perf'], $_POST['social4_perf'], '', '', $_POST['social_id']);
	if($val_social -> v_social()){
		$perfil = new GD($val_social -> pasar_id(), $Hyzher_id, '', $val_social -> pasar_fragmento(), '', '', '', $val_social -> pasar_social1(), $val_social -> pasar_social2(), $val_social -> pasar_social3(), $val_social -> pasar_social4(), '', '');
		if(BD::modificar($perfil, 'social')){
			redireccion::redirigir(PERFILES);
		}
	}
}

if(isset($_POST['Est_Per'])){
	$val_estado = new VD($Hyzher_id, '', '', '', '', '', '', '', '', '', '', '', '', $_POST['cam_estado'], $_POST['estado_id']);
	if($val_estado -> v_estados()){
		$perfil = new GD($val_estado -> pasar_id(), $Hyzher_id, '', '', '', '', '', '', '', '', '', '', $val_estado -> pasar_estado());
		if(BD::modificar($perfil, 'estado')){
			redireccion::redirigir(PERFILES);
		}
	}
}

?>

<div class="el-paquete" id="el_principado">
	<?php
		if(empty($Tabla_Perfil)){
			?>
				<div class="f-nuevo">
					<button onclick="op_perf('','NUE_PERF');">Nuevo Perfil</button>
				</div>
			<?php
		}
	?>
	<div class="tabla">
		<table>
			<caption>Perfil <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Nacimiento</td>
				<td>Procedencia</td>
				<td>Etiqueta</td>
				<td>Estado</td>
				<td>Trabajo</td>
			</tr>
			<?php
				if(!empty($Tabla_Perfil)){
					if(empty($Tabla_Perfil -> obtener_ETIQUETA())){
						$LaEtiqueta = "Asignado por el creador... ¿Cómo estás?";
					}else{
						$LaEtiqueta = $Tabla_Perfil -> obtener_ETIQUETA();
					}
					?>
					<tr class="cuerpo">
						<td><?php echo $Tabla_Perfil -> obtener_ID();?></td>
						<td><?php echo $accion -> componer_fecha($Tabla_Perfil -> obtener_NACIMIENTO().' 00:00:00', 'fecha_1')?></td>
						<td><?php echo $Tabla_Perfil -> obtener_LUGAR();?></td>
						<td><textarea class="super-escrito" readonly><?php echo $LaEtiqueta;?></textarea></td>
						<?php
						if ($Tabla_Perfil -> obtener_ESTADO() == 1) {
							?>
								<td class="visible"><?php echo $accion -> nombre_estado($Tabla_Perfil -> obtener_ESTADO());?></td>
							<?php
						}else{
							?>
								<td class="oculto"><?php echo $accion -> nombre_estado($Tabla_Perfil -> obtener_ESTADO());?></td>
							<?php
						}
						?>
						<td>
							<label>
								<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $Tabla_Perfil -> obtener_ID();?>','CAM_PERF');">
								<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
							</label>
							<label>
								<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $Tabla_Perfil -> obtener_ID();?>','CAM_IMG_PERF');">
								<i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
							</label>
							<label>
								<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $Tabla_Perfil -> obtener_ID();?>','CAM_SOC_PERF');">
								<i class="fa fa-hand-peace-o fa-2x" aria-hidden="true"></i>
							</label>
							<?php
							if ($Tabla_Perfil -> obtener_ESTADO() == 0) {
								?>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $Tabla_Perfil -> obtener_ID();?>','CAM_EST_PERF');">
									<i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
								</label>
								<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
			?>	
		</table>
	</div>
</div>


<div class="el-paquete" id="el_nuevo">
	<form method="POST" action="<?php echo PERFILES; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Perfil</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<?php
			if(isset($_POST['Nue_Perf'])){
				$val_nuevo -> m_Ehyzher();
			}
		?>
		<div class="grupo-form">
			<label>Fecha de Nacimiento:</label>
			<div class="grupo">
				<div class="parte">
					<div class="caja-select">
						<select name="n_dia" id="n_dia_select">
							<option value="Vacio">Dias</option>
							<?php
							for ($i=1; $i <=31 ; $i++) {
								if($i < 10){
									$n ='0'.$i;
								}else{
									$n =$i;
								} 
								?>
								<option value="<?php echo $n;?>"><?php echo $n;?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="parte">
					<div class="caja-select">
						<select name="n_mes" id="n_mes_select">
							<option value="Vacio">Meses</option>
							<option value="01">Enero</option>
							<option value="02">Febrero</option>
							<option value="03">Marzo</option>
							<option value="04">Abril</option>
							<option value="05">Mayo</option>
							<option value="06">Junio</option>
							<option value="07">Julio</option>
							<option value="08">Agosto</option>
							<option value="09">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
				</div>
				<div class="parte">
					<div class="caja-select">
						<select name="n_anio" id="n_anio_select">
							<option value="Vacio">Años</option>
							<?php
								$año_fin = 2007;
								for ($i=1940; $i <= $año_fin ; $i++) { 
									?>
									<option value="<?php echo $i;?>"><?php echo $i;?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['Nue_Perf'])){
				$val_nuevo -> m_Enacimiento();
			}
		?>
		<div class="grupo-form">
			<label for="lugar">Procedencia:</label>
			<input type="text" id="lugar" name="n_lugar" required <?php if(isset($_POST['Nue_Perf'])){$val_nuevo->r_lugar();}?> >
		</div>
		<?php
			if(isset($_POST['Nue_Perf'])){
				$val_nuevo -> m_Elugar();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="n_soy">Sobre Mi:</label>
			<textarea name="n_soy" id="soy"><?php if(isset($_POST['Nue_Perf'])){$val_nuevo->r_soy();}?></textarea>
		</div>
		<?php
			if(isset($_POST['Nue_Perf'])){
				$val_nuevo -> m_Esoy();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_perfil">
	<form method="POST" action="<?php echo PERFILES?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Perfil</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_perfI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('','X_perfil');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>

		<div class="grupo-form">
			<label>Fecha de Nacimiento:</label>
			<div class="grupo">
				<div class="parte">
					<div class="caja-select">
						<select name="cam_dia" id="ajax_dia_select">
							<option value="Vacio">Dias</option>
							<?php
							for ($i=1; $i <=31 ; $i++) {
								if($i < 10){
									$n ='0'.$i;
								}else{
									$n =$i;
								} 
								?>
								<option value="<?php echo $n;?>"><?php echo $n;?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="parte">
					<div class="caja-select">
						<select name="cam_mes" id="ajax_mes_select">
							<option value="Vacio">Meses</option>
							<option value="01">Enero</option>
							<option value="02">Febrero</option>
							<option value="03">Marzo</option>
							<option value="04">Abril</option>
							<option value="05">Mayo</option>
							<option value="06">Junio</option>
							<option value="07">Julio</option>
							<option value="08">Agosto</option>
							<option value="09">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
				</div>
				<div class="parte">
					<div class="caja-select">
						<select name="cam_anio" id="ajax_anio_select">
							<option value="Vacio">Años</option>
							<?php
								$año_fin = 2007;
								for ($i=1940; $i <= $año_fin ; $i++) { 
									?>
									<option value="<?php echo $i;?>"><?php echo $i;?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['Cam_Perf'])){
				$val_perfil -> m_Enacimiento();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_lugar">Procedencia:</label>
			<input type="text" id="ajax_lugar" name="cam_lugar" required <?php if(isset($_POST['Cam_Perf'])){$val_perfil->r_lugar();}?> >
		</div>
		<?php
			if(isset($_POST['Cam_Perf'])){
				$val_perfil -> m_Elugar();
			}
		?>
		<div class="grupo-form-WYSIWYG">
			<label for="ajax_soy">Sobre Mi:</label>
			<textarea name="cam_soy" id="ajax_soy"><?php if(isset($_POST['Cam_Perf'])){$val_perfil->r_soy();}?></textarea>
		</div>
		<?php
			if(isset($_POST['Cam_Perf'])){
				$val_perfil -> m_Esoy();
				$val_perfil -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_perfil_id" name="perfil_id" readonly <?php if(isset($_POST['Cam_Perf'])){$val_perfil->r_id();}?> >

		<div class="grupo-form">
			<button type="submit"  name="Cam_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_perfF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('','X_perfil');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_pfi">
	<form method="POST" action="<?php echo PERFILES; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Mi imagen</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Img_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_pfiI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('','X_pfi');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
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
					<input type="text" class="trozo ocultar" id="ajax_imagen" name="pfi_imagen" required readonly <?php if(isset($_POST['Img_Perf'])){$val_imagen->r_imagen();}?>>
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
			if (isset($_POST['Img_Perf'])) {
				$val_imagen -> m_Eimagen();
				$val_imagen -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_pfi_id" name="pfi_id" readonly <?php if(isset($_POST['Img_Perf'])){$val_imagen->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Img_Perf"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_pfiF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('','X_pfi');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo PERFILES?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Redes Sociales</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Soc_Per"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('','X_social');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="ajax_social1">Facebook:</label>
			<input type="text" id="ajax_social1" name="social1_perf" class="no-valid" <?php if(isset($_POST['Soc_Per'])){$val_social->r_social1();}?> >
		</div>
		<?php
			if (isset($_POST['Soc_Per'])) {
				$val_social -> m_Esocial1();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_social2">Twitter:</label>
			<input type="text" id="ajax_social2" name="social2_perf" class="no-valid" <?php if(isset($_POST['Soc_Per'])){$val_social->r_social2();}?> >
		</div>
		<?php
			if (isset($_POST['Soc_Per'])) {
				$val_social -> m_Esocial2();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_social3">Youtube:</label>
			<input type="text" id="ajax_social3" name="social3_perf" class="no-valid" <?php if(isset($_POST['Soc_Per'])){$val_social->r_social3();}?> >
		</div>
		<?php
			if (isset($_POST['Soc_Per'])) {
				$val_social -> m_Esocial3();
			}
		?>
		<div class="grupo-form">
			<label for="ajax_social4">Website:</label>
			<input type="text" id="ajax_social4" name="social4_perf" class="no-valid" <?php if(isset($_POST['Soc_Per'])){$val_social->r_social4();}?> >
		</div>
		<?php
			if (isset($_POST['Soc_Per'])) {
				$val_social -> m_Esocial4();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<label>Asignar fragmento:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="social_fragmento" id="mod_fragmento_select">
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
			if (isset($_POST['Soc_Per'])) {
				$val_social -> m_Efragmento();
				$val_social -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_social_id" name="social_id" readonly <?php if(isset($_POST['Soc_Per'])){$val_social->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Soc_Per"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('','X_social');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_detallado">
	<form method="POST" action="<?php echo PERFILES; ?>" class="form-modal">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Estado del Perfil</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Est_Per"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_detalleI" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('','X_estado');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
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
			<?php
				if (isset($_POST['Est_Per'])) {
					$val_estado -> m_Eestado();
				}
			?>
			<p style="color: red; font-size: 14px; font-weight: bold;">Una vez publicado ("Visible") no podrás volver a ponerlo en privado ("Oculto").</p>
		</div>
		<input type="hidden" id="ajax_estado_id" name="estado_id" readonly <?php if(isset($_POST['Est_Per'])){$val_estado->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Est_Per"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_detalleF" ><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('','X_estado');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>

<script>
function op_perf(id, accion){
	$('#el_principado').css('pointer-events' , 'none');
	switch(accion){
		case 'NUE_PERF':
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
		case 'CAM_PERF':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
            limpiador.limpiarPER();
            var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
			$('#el_perfil').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_perfil").offset().top  }, 1);
			break;
				case 'X_perfil':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_perfil').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		case 'CAM_IMG_PERF':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
			limpiador.limpiarP();
		 	var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id};
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
		case 'CAM_SOC_PERF':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
			var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
            $('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			break;
				case 'X_social':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_cambiado').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		case 'CAM_EST_PERF':
			bloquedarScroll.activo = true;
			bloquedarScroll.accion();
			var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id};
            ajax_global(ajax_H,accion);
            $('#el_detallado').css({'display': 'flex' , 'opacity':'1'});
			$("html,body").animate({ scrollTop : $("#el_detallado").offset().top  }, 1);
			break;
				case 'X_estado':
					bloquedarScroll.activo = false;
					bloquedarScroll.accion();
					$('#el_detallado').css({'display':'none', 'opacity': '0'});
					$('#el_principado').css('pointer-events' , 'auto');
					break;
		default:
			$('#el_principado').css('pointer-events' , 'auto');
	}
}
</script>


<?php
	if(isset($_POST['Nue_Perf'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				$('#n_dia_select option[value="<?php echo $val_nuevo -> pasar_dia();?>"]').prop('selected', true);
				$('#n_mes_select option[value="<?php echo $val_nuevo -> pasar_mes();?>"]').prop('selected', true);
				$('#n_anio_select option[value="<?php echo $val_nuevo -> pasar_anio();?>"]').prop('selected', true);

				op_perf('', 'NUE_PERF');
			</script>
			<?php
		}
	}

	if(isset($_POST['Cam_Perf'])){
		if(!$val_perfil -> v_perfil()){
			?>
			<script>
				$('#ajax_dia_select option[value="<?php echo $val_perfil -> pasar_dia();?>"]').prop('selected', true);
				$('#ajax_mes_select option[value="<?php echo $val_perfil -> pasar_mes();?>"]').prop('selected', true);
				$('#ajax_anio_select option[value="<?php echo $val_perfil -> pasar_anio();?>"]').prop('selected', true);

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_perfil').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_perfil").offset().top  }, 1);
			</script>
			<?php
		}
	}

	if(isset($_POST['Img_Perf'])){
		if(!$val_imagen -> v_img()){
			?>
			<script>
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

	if(isset($_POST['Soc_Per'])){
		if(!$val_social -> v_social()){
			?>
			<script>
				$('#mod_fragmento_select option[value="<?php echo $val_social -> pasar_fragmento();?>"]').prop('selected', true);
				if ($('#mod_fragmento_select').val() != "Vacio") {
					$('#mod_fragmento_select').css('background', '#755860');
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

<script>
	tinymce.init({ 
		selector: '#soy',
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
		selector: '#ajax_soy',
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