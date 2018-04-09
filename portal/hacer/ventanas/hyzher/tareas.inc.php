<?php
	use \realiza_tarea\tarea as VD;
	use \base_tarea\tarea as GD;
	use \base_planeacion\planeacion as GDP;
	use \crud_tarea\tarea as BD;

	$accion = new VD('', '', '', '', '', '', '', '', '');
	$Tabla_Tareas = $accion -> tabla_tareas('', $Hyzher_id, 't.tarea_programada');
	$Tareas_Contados = $accion -> tareas_contados();
	$Tareas_Permitidas = $accion -> tareas_permitidas($Hyzher_id);
	$Mis_Blogs = $accion -> mis_blogs($Hyzher_id);

	if(isset($_POST['Nue_Tar'])){
		$val_nuevo = new VD($_POST['n_blog'], '', $_POST['n_descripcion'], $_POST['n_dia'], $_POST['n_mes'], $_POST['n_anio'], '', '', $Hyzher_id);
		if($Tareas_Contados < $Tareas_Permitidas){
			if($val_nuevo -> v_nuevo()){
				$tarea = new GD('', $val_nuevo -> pasar_blog(), '', $val_nuevo -> pasar_descripcion(), $val_nuevo -> pasar_programada(), '');
				if(BD::nuevo($tarea, 'tarea')){
					redireccion::redirigir(TAREAS);
				}
			}
		}
	}

	if(isset($_POST['Cam_Tar'])){
		$val_cambiar = new VD('', '', $_POST['cam_descripcion'], $_POST['cam_dia'], $_POST['cam_mes'], $_POST['cam_anio'], $_POST['cam_estado'], $_POST['cam_id'], $Hyzher_id);
		if($val_cambiar -> v_cambiar()){
			$tarea = new GD($val_cambiar -> pasar_id(), '', '', $val_cambiar -> pasar_descripcion(), $val_cambiar -> pasar_programada(), $val_cambiar -> pasar_estado());
			if(BD::modificar($tarea, 'tarea')){
				redireccion::redirigir(TAREAS);
			}
		}
	}

	if(isset($_POST['Bor_Tar'])){
		$val_borrar = new VD('', '', '', '', '', '', '', $_POST['bor_id'], $Hyzher_id);
		if($val_borrar -> v_borrar()){
			$tarea = new GD($val_borrar -> pasar_id(), '', '', '', '', '');
			if(BD::eliminar($tarea, 'tarea')){
				redireccion::redirigir(TAREAS);
			}
		}
	}

?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_tar('','NUE_TAR');">Nueva Tarea</button>
		<div class="detalles">
			<span>Total: <?php echo $Tareas_Contados;?></span>
			<span>Sobran: <?php echo $Tareas_Permitidas - $Tareas_Contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Tareas <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Blog</td>
				<td>Programada</td>
				<td>Estado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if(count($Tabla_Tareas)){
					foreach ($Tabla_Tareas as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_BLOG();?></td>
							<td><?php echo $t_fila -> obtener_PROGRAMADA();?></td>
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
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_tar('<?php echo $t_fila -> obtener_ID();?>','CAM_TAR');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_tar('<?php echo $t_fila -> obtener_ID();?>','BOR_TAR');">
									<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
								</label>
								<?php
								if ($t_fila -> obtener_ESTADO() == 0) {
									?>
										<label>
											<?php $PassVista = password_hash('6UnMoradODelCieLO8',PASSWORD_DEFAULT);?>
											<a href="<?php echo TABLONES_ENTRADAS.'?Tab_Hyzh='.$PassVista; ?>" target="_blank">
												<i class="fa fa-file fa-2x" aria-hidden="true"></i>
											</a>
										</label>
									<?php
								}
								?>
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
	<form method="POST" action="<?php echo TAREAS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nueva Tarea</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Tar"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_tar('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<div class="caja-select">
					<select name="n_blog" id="n_blog_select">
						<option value="Vacio">Mis Blogs [ <?php echo count($Mis_Blogs);?> ]</option>
						<?php
						if (count($Mis_Blogs)) {
							foreach ($Mis_Blogs as $Mis_blo) {
								?>
								<option value="<?php echo $Mis_blo -> obtener_ID();?>"><?php echo $Mis_blo -> obtener_TITULO().' de '.$Mis_blo -> obtener_FAMILIA();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['Nue_Tar'])){
				$val_nuevo -> m_Eblog();
			}
		?>
		<div class="grupo-form">
			<label for="descripcion">Descripción:</label>
			<textarea name="n_descripcion" id="descripcion" cols="30" rows="12" required><?php if(isset($_POST['Nue_Tar'])){$val_nuevo->r_descripcion();}?></textarea>
		</div>
		<?php
			if(isset($_POST['Nue_Tar'])){
				$val_nuevo -> m_Edescripcion();
			}
		?>
		<div class="grupo-form">
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
								$año_fin = 2020;
								for ($i=2017; $i <= $año_fin ; $i++) { 
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
			if(isset($_POST['Nue_Tar'])){
				$val_nuevo -> m_Eprogramada();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Tar"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_tar('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo TAREAS;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Tarea</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Tar"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_tar('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Entrada:</label>
				<label class="col-md-9" id="ajax_titulo"></label>
				<label class="col-md-3">Familia Entrada:</label>
				<label class="col-md-3" id="ajax_familia"></label>
				<label class="col-md-3">Fecha Publicación:</label>
				<label class="col-md-3" id="ajax_publicacion"></label>
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
			if(isset($_POST['Cam_Tar'])){
				$val_cambiar -> m_Eestado();
			}
		?>
		<div class="grupo-form">
			<label for="descripcion">Descripción:</label>
			<textarea name="cam_descripcion" id="ajax_descripcion" cols="30" rows="12" required><?php if(isset($_POST['Cam_Tar'])){$val_cambiar->r_descripcion();}?></textarea>
		</div>
		<div class="grupo-form">
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
								$año_fin = 2020;
								for ($i=2017; $i <= $año_fin ; $i++) { 
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
			if(isset($_POST['Cam_Tar'])){
				$val_cambiar -> m_Eprogramada();
				$val_cambiar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Tar'])){$val_cambiar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Tar"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_tar('','X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo TAREAS;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Tarea ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Tar"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_tar('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Titulo Entrada:</label>
				<label class="col-md-9" id="ajax_bor_titulo"></label>
				<label class="col-md-3">Familia Entrada:</label>
				<label class="col-md-3" id="ajax_bor_familia"></label>
				<label class="col-md-3">Fecha Publicación:</label>
				<label class="col-md-3" id="ajax_bor_publicacion"></label>
			</div>
		</div>
		<?php
			if(isset($_POST['Bor_Tar'])){
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Tar'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Tar"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_tar('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_tar(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_TAR':
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
			case 'CAM_TAR':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'TAREA', 'buscar':'id', 'dato':id};
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
			case 'BOR_TAR':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'TAREA', 'buscar':'id', 'dato':id};
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
	if(isset($_POST['Nue_Tar'])){
		if(!$val_nuevo -> v_nuevo() || $Tareas_Contados >= $Tareas_Permitidas){
			?>
			<script>
				$('#n_blog_select option[value="<?php echo $val_nuevo -> pasar_blog();?>"]').prop('selected', true);
				$('#n_dia_select option[value="<?php echo $val_nuevo -> pasar_dia();?>"]').prop('selected', true);
				$('#n_mes_select option[value="<?php echo $val_nuevo -> pasar_mes();?>"]').prop('selected', true);
				$('#n_anio_select option[value="<?php echo $val_nuevo -> pasar_anio();?>"]').prop('selected', true);
				op_tar('', 'NUE_TAR');
			</script>
			<?php
		}
	}
	if(isset($_POST['Cam_Tar'])){
		if(!$val_cambiar -> v_cambiar()){
			?>
			<script>
				var ajax_H = {'atributo':'TAREA', 'buscar':'id', 'dato':<?php echo $val_cambiar -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_TAR_ERRORES');

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

				$('#ajax_dia_select option[value="<?php echo $val_cambiar -> pasar_dia();?>"]').prop('selected', true);
				$('#n_mes_select option[value="<?php echo $val_cambiar -> pasar_mes();?>"]').prop('selected', true);
				$('#n_anio_select option[value="<?php echo $val_cambiar -> pasar_anio();?>"]').prop('selected', true);

				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>