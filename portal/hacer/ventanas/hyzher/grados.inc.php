<?php
	use \realiza_grado\grado as VD;
	use \base_grado\grado as GD;
	use \crud_grado\grado as BD;

	$accion = new VD('', '');
	$Tabla_Grados = $accion -> tabla_grados('', 'id_grado DESC');
	$Grados_Contados = $accion -> grados_contados();

	if(isset($_POST['Nue_Grad'])){
		$val_nuevo = new VD($_POST['n_tipo'], '');
		if($val_nuevo -> v_nuevo()){
			$grado = new GD('', $val_nuevo -> pasar_tipo());
			if(BD::nuevo($grado, 'grado')){
				redireccion::redirigir(GRADOS);
			}
		}
	}
	if(isset($_POST['Bor_Grad'])){
		$val_borrar = new VD('', $_POST['bor_id']);
		if($val_borrar -> v_borrar()){
			$grado = new GD($val_borrar -> pasar_id(), '');
			if(BD::eliminar($grado, 'grado')){
				redireccion::redirigir(GRADOS);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_grad('', 'NUE_GRAD');">Nuevo Grado</button>
		<div class="detalles">
			<span>Total: <?php echo $Grados_Contados?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Grados <?php echo $Hyzher_usuario;?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Tipo</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if(count($Tabla_Grados)){
					foreach ($Tabla_Grados as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TIPO();?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_grad('<?php echo $t_fila -> obtener_ID();?>','BOR_GRAD');">
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
	<form method="POST" action="<?php echo GRADOS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Grado</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Nue_Grad"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_grad('', 'X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="tipo">Grado Usuario:</label>
			<input type="text" id="tipo" name="n_tipo" required <?php if(isset($_POST['Nue_Grad'])){$val_nuevo->r_tipo();}?>>
		</div>
		<?php
			if(isset($_POST['Nue_Grad'])){
				$val_nuevo -> m_Etipo();
			}
		?>
		<div class="grupo-form">
			<button type="submit" name="Nue_Grad"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_grad('', 'X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete"></div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo GRADOS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Grado ?</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Bor_Grad"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_grad('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Grado Usuario:</label>
				<label id="ajax_bor_grado"></label>
			</div>
		</div>
		<?php
			if(isset($_POST['Bor_Grad'])){
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Grad'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit" name="Bor_Grad"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_grad('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_grad(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_GRAD':
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
			case 'BOR_GRAD':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'GRADO', 'buscar':'id', 'dato':id};
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
	if(isset($_POST['Nue_Grad'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				op_grad('','NUE_GRAD');
			</script>
			<?php
		}
	}
?>