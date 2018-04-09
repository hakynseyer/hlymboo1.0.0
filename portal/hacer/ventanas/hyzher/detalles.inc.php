<?php
	use \realiza_detalles\detalles as VD;
	use \base_detalles\detalles as GD;
	use \crud_detalles\detalles as BD;

	$accion = new VD('', '', '', '', '', '', '');
	$Tabla_Detalles = $accion -> tabla_detalles('', 'h.hyzher_alias');
	$detalles_contados = $accion -> detalles_contados();

	if(isset($_POST['Cam_Deta'])){
		$val_detalles = new VD($_POST['cam_fragmento'], $_POST['cam_personaje'], $_POST['cam_tarea'], $_POST['cam_leyenda'], $_POST['cam_id'], '', '');
		if($val_detalles -> v_cambiar_detalles()){
			$detalles = new GD($val_detalles -> pasar_id(), '', $val_detalles -> pasar_fragmento(), $val_detalles -> pasar_personaje(), $val_detalles -> pasar_tarea(), $val_detalles -> pasar_leyenda(), '');
			if(BD::modificar($detalles, 'cambiar_detalles')){
				redireccion::redirigir(DETALLES);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<div class="detalles" style="margin: 1rem 0rem;">
			<span>Total: <?php echo $detalles_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Detalles Hyzhers</caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Hyzher</td>
				<td>Fragmentos</td>
				<td>Personajes</td>
				<td>Tareas</td>
				<td>Leyendas</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Detalles)) {
					foreach ($Tabla_Detalles as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_HYZHER();?></td>
							<td><?php echo $t_fila -> obtener_FRAGMENTOS();?></td>
							<td><?php echo $t_fila -> obtener_PERSONAJES();?></td>
							<td><?php echo $t_fila -> obtener_TAREAS();?></td>
							<td><?php echo $t_fila -> obtener_LEYENDAS();?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_detalles('<?php echo $t_fila -> obtener_ID();?>','CAM_DETA');">
									<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
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


<div class="el-paquete" id="el_cambiado">
	<form method="POST" action="<?php echo DETALLES;?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Detalles</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cam_Deta"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
				<button type="button" id="Lim_cambiadoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_detalles('', 'X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Hyzher Alias:</label>
				<label class="col-md-9" id="ajax_hyzher"></label>
				<label class="col-md-3">Fragmentos:</label>
				<label class="col-md-9" id="ajax_fragmentos"></label>
				<label class="col-md-3">Personajes:</label>
				<label class="col-md-9" id="ajax_personajes"></label>
				<label class="col-md-3">Tareas:</label>
				<label class="col-md-9" id="ajax_tareas"></label>
				<label class="col-md-3">Leyendas:</label>
				<label class="col-md-9" id="ajax_leyendas"></label>
			</div>
		</div>
		<?php
			if(isset($_POST['Cam_Deta'])){
				$val_detalles -> m_Efragmento();
				$val_detalles -> m_Epersonaje();
				$val_detalles -> m_Etarea();
				$val_detalles -> m_Eleyenda();
				$val_detalles -> m_Eid();
			}
		?>
		<div class="grupo-form">
			<label for="fragmentos">Número Fragmentos:</label>
			<input type="text" id="fragmentos" name="cam_fragmento" required <?php if(isset($_POST['Cam_Deta'])){$val_detalles->r_fragmento();}?>>
		</div>
		<div class="grupo-form">
			<label for="personajes">Número Personajes:</label>
			<input type="text" id="personajes" name="cam_personaje" required <?php if(isset($_POST['Cam_Deta'])){$val_detalles->r_personaje();}?>>
		</div>
		<div class="grupo-form">
			<label for="tareas">Número Tareas:</label>
			<input type="text" id="tareas" name="cam_tarea" required <?php if(isset($_POST['Cam_Deta'])){$val_detalles->r_tarea();}?>>
		</div>
		<div class="grupo-form">
			<label for="leyendas">Número Leyendas:</label>
			<input type="text" id="leyendas" name="cam_leyenda" required <?php if(isset($_POST['Cam_Deta'])){$val_detalles->r_leyenda();}?>>
		</div>
		<input type="hidden" id="ajax_cam_id" name="cam_id" readonly <?php if(isset($_POST['Cam_Deta'])){$val_detalles->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cam_Deta"><i class="fa fa-floppy-o" aria-hidden="true"> Cambiar</i></button>
			<button type="button" id="Lim_cambiadoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_detalles('', 'X_cambiar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_detalles(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'CAM_DETA':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				limpiador.limpiarC();
				var ajax_H = {'atributo':'DETALLES', 'buscar':'id', 'dato':id};
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
			default:
				$('#el_principado').css('pointer-events' , 'auto');
		}
	};
</script>


<?php
	if(isset($_POST['Cam_Deta'])){
		if(!$val_detalles -> v_cambiar_detalles()){
			?>
			<script>
				var ajax_H = {'atributo':'DETALLES', 'buscar':'id', 'dato':<?php echo $val_detalles -> pasar_id();?>};
				ajax_global(ajax_H, 'DETALLES_ERRORES');

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#el_cambiado').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#el_cambiado").offset().top  }, 1);
			</script>
			<?php
		}
	}
?>