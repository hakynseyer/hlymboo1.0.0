<?php
	use \realiza_perfil\perfil as VD;
	use \base_perfil\perfil as GD;
	use \crud_perfil\perfil as BD;

	$accion = new VD('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
	$Tabla_Perfil = $accion -> tabla_perfil2('', 'g.grado_tipo');
	$etiquetas_contados = $accion -> etiquetas_contados();

	if(isset($_POST['Eti_Perf'])){
		$val_etiqueta = new VD($_POST['cam_hyzher'], '', '', '', '', '', '', '', '', '', '', '', $_POST['cam_eti'], '', $_POST['cam_id']);
		if($val_etiqueta -> v_etiquetas()){
			$perfil = new GD($val_etiqueta -> pasar_id(), $val_etiqueta -> pasar_hyzher(), '', '', '', '', '', '', '', '', '', $val_etiqueta -> pasar_etiqueta(), '');
			if(BD::modificar($perfil, 'etiqueta')){
				redireccion::redirigir(ETIQUETAS);
			}
		}
	}

	if(isset($_POST['Bor_Perf'])){
		$val_borrar = new VD($_POST['bor_hyzher'], '', '', '', '', '', '', '', '', '', '', '', '', '', $_POST['bor_id']);
		if($val_borrar -> v_borrar()){
			$perfil = new GD($val_borrar -> pasar_id(), $val_borrar -> pasar_hyzher(), '', '', '', '', '', '', '', '', '', '', '');
			if(BD::eliminar($perfil, 'perfil')){
				redireccion::redirigir(ETIQUETAS);
			}
		}
	}
?>

<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<div class="detalles" style="margin: 1rem 0rem;">
			<span>Total: <?php echo $etiquetas_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Perfiles Hyzhers</caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Hyzhers</td>
				<td>Rango</td>
				<td>Etiqueta</td>
				<td>Estado</td>
				<td>Trabajo</td>
			</tr>
			<?php
				if(!empty($Tabla_Perfil)){
					foreach ($Tabla_Perfil as $tabla) {
						?>
						<tr class="cuerpo">
							<td><?php echo $tabla -> obtener_ID();?></td>
							<td><?php echo $tabla -> obtener_IMAGEN();?></td>
							<td><?php echo $tabla -> obtener_FRAGMENTO();?></td>
							<td><textarea class="super-escrito"><?php echo $tabla -> obtener_ETIQUETA();?></textarea></td>
							<?php
							if ($tabla -> obtener_ESTADO() == 1) {
								?>
									<td class="visible"><?php echo $accion -> nombre_estado($tabla -> obtener_ESTADO());?></td>
								<?php
							}else{
								?>
									<td class="oculto"><?php echo $accion -> nombre_estado($tabla -> obtener_ESTADO());?></td>
								<?php
							}
							?>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $tabla -> obtener_ID();?>', '<?php echo $tabla -> obtener_HYZHER();?>', 'ETI_PERF');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_perf('<?php echo $tabla -> obtener_ID();?>', '<?php echo $tabla -> obtener_HYZHER();?>', 'BOR_PERF');">
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
<div class="el-paquete" id="el_nuevo"></div>

<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo ETIQUETAS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Etiqueta Hyzher</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Eti_Perf"><i class="fa fa-floppy-o" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_perf('', '', 'X_etiqueta');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Nombre Hyzher:</label>
				<label class="col-md-9" id="ajax_hyzher"></label>
				<label class="col-md-3">Lugar Hyzher:</label>
				<label class="col-md-9" id="ajax_lugar"></label>
				<label class="col-md-3">Estado Perfil:</label>
				<label class="col-md-3" id="ajax_estado"></label>
				<label class="col-md-3">Sobre Mi:</label>
				<label class="col-md-3"><textarea id="ajax_soy" cols="15" rows="2" readonly></textarea></label>
			</div>
		</div>
		<div class="grupo-form">
			<label for="ajax_etiqueta">Etiqueta Hyzher:</label>
			<textarea name="cam_eti" id="ajax_etiqueta" cols="30" rows="12" required><?php if(isset($_POST['Eti_Perf'])){$val_etiqueta->r_etiqueta();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Eti_Perf'])) {
				$val_etiqueta -> m_Eetiqueta();
				$val_etiqueta -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Eti_Perf'])){$val_etiqueta->r_id();}?> >
		<input type="hidden" id="ajax_cam_hyzher" name="cam_hyzher" readonly <?php if(isset($_POST['Eti_Perf'])){$val_etiqueta->r_hyzher();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Eti_Perf"><i class="fa fa-floppy-o" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_perf('', '', 'X_etiqueta');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo ETIQUETAS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Perfil ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Perf"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_perf('', '', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Nombre Hyzher:</label>
				<label class="col-md-9" id="ajax_hyzher_borrar"></label>
				<label class="col-md-3">Lugar Hyzher:</label>
				<label class="col-md-9" id="ajax_lugar_borrar"></label>
				<label class="col-md-3">Estado Perfil:</label>
				<label class="col-md-3" id="ajax_estado_borrar"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Perf'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Perf'])){$val_borrar->r_id();}?> >
		<input type="hidden" id="ajax_bor_hyzher" name="bor_hyzher" readonly <?php if(isset($_POST['Bor_Perf'])){$val_borrar->r_hyzher();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Perf"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_perf('', '', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_perf(id, hyzher, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'ETI_PERF':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				console.log(id+" --- "+hyzher);
				var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id, 'dato2': hyzher};
				ajax_global(ajax_H, accion);
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
				break;
					case 'X_etiqueta':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#el_cambiado').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'BOR_PERF':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':id, 'dato2': hyzher};
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
	if(isset($_POST['Eti_Perf'])){
		if(!$val_etiqueta -> v_etiquetas()){
			?>
			<script>
				var ajax_H = {'atributo':'PERFIL', 'buscar':'id', 'dato':<?php echo $val_etiqueta -> pasar_id();?>, 'dato2': <?php echo $val_etiqueta -> pasar_hyzher();?>};
				ajax_global(ajax_H, 'ETI_PERF_ERROES');

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>