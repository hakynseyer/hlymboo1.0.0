<?php
	use \realiza_leyenda\leyenda as VD;
	use \base_leyenda\leyenda as GD;
	use \crud_leyenda\leyenda as BD;

	$accion = new VD('', '', '', '');
	$Tabla_Leyendas = $accion -> tabla_leyendas('', $Hyzher_id, 'l.id_leyenda DESC');
	$ley_contados = $accion -> leyendas_contados($Hyzher_id);
	$ley_permitidos = $accion -> detalles_leyendas($Hyzher_id);
	$Mis_personajes = $accion -> lista_personajes($Hyzher_id);

	if (isset($_POST['Nue_Ley'])) {
		$val_nuevo = new VD($_POST['n_personaje'], $_POST['n_escrito'], '', $Hyzher_id);
		if ($ley_contados < $ley_permitidos) {
			if ($val_nuevo -> v_nuevo()) {
				$leyenda = new GD('', $Hyzher_id, $val_nuevo -> pasar_personaje(), $val_nuevo -> pasar_escrito());
				if (BD::nuevo($leyenda, 'nuevo')) {
					redireccion::redirigir(LEYENDAS);
				}
			}
		}
	}

	if (isset($_POST['Bor_Ley'])) {
		$val_borrar = new VD('', '', $_POST['bor_id'], $Hyzher_id);
		if ($val_borrar -> v_borrar()) {
			$leyenda = new GD($val_borrar -> pasar_id(), $Hyzher_id, '', '');
			if (BD::eliminar($leyenda)) {
				redireccion::redirigir(LEYENDAS);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_ley('','NUE_LEY');">Nueva Leyenda</button>
		<div class="detalles">
			<span>Total: <?php echo $ley_contados;?></span>
			<span>Sobran: <?php echo $ley_permitidos - $ley_contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Leyendas <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Personaje</td>
				<td>Escrito</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Leyendas)) {
					foreach ($Tabla_Leyendas as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_PERSONAJE();?></td>
							<td><?php echo $t_fila -> obtener_ESCRITO();?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_ley('<?php echo $t_fila -> obtener_ID();?>','BOR_LEY');">
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
	<form method="POST" action="<?php echo LEYENDAS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nueva Leyenda</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Ley"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_ley('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<label>Leyenda Personaje:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="n_personaje" id="n_familia_select">
						<option value="Vacio">Mis Personajes [ <?php echo count($Mis_personajes);?> ]</option>
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
			if (isset($_POST['Nue_Ley'])) {
				$val_nuevo -> m_Epersonaje();
			}
		?>
		<div class="grupo-form">
			<label for="escrito">Leyenda Escrito:</label>
			<textarea name="n_escrito" id="escrito" cols="30" rows="12" required><?php if(isset($_POST['Nue_Ley'])){$val_nuevo->r_escrito();}?></textarea>
		</div>
		<?php
			if (isset($_POST['Nue_Ley'])) {
				$val_nuevo -> m_Eescrito();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Ley"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_ley('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete"></div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo LEYENDAS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Leyenda ?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Ley"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_ley('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Leyenda Personaje:</label>
				<label id="ajax_bor_personaje"></label>
				<label>Leyenda Escrito:</label>
				<label id="ajax_bor_escrito"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Ley'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Ley'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Ley"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_ley('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_ley(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_LEY':
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
			case 'BOR_LEY':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'LEYENDA', 'buscar':'id', 'dato':id};
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
	if (isset($_POST['Nue_Ley'])) {
		if (!$val_nuevo -> v_nuevo() || $ley_contados >= $ley_permitidos) {
			?>
			<script>
				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_personaje();?>"]').prop('selected', true);
				op_ley('','NUE_LEY');
			</script>
			<?php
		}
	}
?>