<?php
	use \realiza_clasificacion\clasificacion as VD;
	use \base_clasificacion\clasificacion as GD;
	use \crud_clasificacion\clasificacion as BD;

	$accion = new VD('', '');
	$Tabla_Clasificaciones = $accion -> tabla_clasificaciones('', 'id_clasificacion DESC');
	$Clasificaciones_Contados = $accion -> clasificaciones_contados();

	if(isset($_POST['Nue_Cla'])){
		$val_nuevo = new VD($_POST['n_tipo'], '');
		if($val_nuevo -> v_nuevo()){
			$clasificacion = new GD('', $val_nuevo -> pasar_tipo());
			if(BD::nuevo($clasificacion, 'nuevo')){
				redireccion::redirigir(CLASIFICACIONES);
			}
		}
	}
	if(isset($_POST['Bor_Cla'])){
		$val_borrar = new VD('', $_POST['bor_id']);
		if($val_borrar -> v_borrar()){
			$clasificacion = new GD($val_borrar -> pasar_id(), '');
			if(BD::eliminar($clasificacion, 'clasificacion')){
				redireccion::redirigir(CLASIFICACIONES);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_cla('', 'NUE_CLA');">Nueva Clasificación</button>
		<div class="detalles">
			<span>Total: <?php echo $Clasificaciones_Contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Clasificaciones <?php echo $Hyzher_usuario; ?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Tipo</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if(count($Tabla_Clasificaciones)){
					foreach ($Tabla_Clasificaciones as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TIPO();?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_cla('<?php echo $t_fila -> obtener_ID();?>','BOR_CLA');">
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
	<form method="POST" action="<?php echo CLASIFICACIONES; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nueva Clasificacion</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Nue_Cla"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_cla('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="tipo">Clasificación Entrada:</label>
			<input type="text" id="tipo" name="n_tipo" required <?php if(isset($_POST['Nue_Cla'])){$val_nuevo->r_tipo();}?>>
		</div>
		<?php
			if(isset($_POST['Nue_Cla'])){
				$val_nuevo -> m_Etipo();
			}
		?>
		<div class="grupo-form">
			<button type="submit" name="Nue_Cla"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_cla('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete"></div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo CLASIFICACIONES; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Clasificación ?</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Bor_Cla"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_cla('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Clasificación Entrada:</label>
				<label id="ajax_bor_clasificacion"></label>
			</div>
		</div>
		<?php
			if(isset($_POST['Bor_Cla'])){
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Cla'])){$val_borrar -> r_id();}?> >
		<div class="grupo-form">
			<button type="submit" name="Bor_Cla"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_cla('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_cla(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_CLA':
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
			case 'BOR_CLA':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'CLASIFICACION', 'buscar':'id', 'dato':id};
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
	if(isset($_POST['Nue_Cla'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				op_cla('', 'NUE_CLA');
			</script>
			<?php
		}
	}
?>