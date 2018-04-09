<?php
	use \realiza_categoria\categoria as VD;
	use \base_categoria\categoria as GD;
	use \crud_categoria\categoria as BD;

	$accion = new VD('', '');
	$Tabla_Categorias = $accion -> tabla_categorias('', 'id_categoria DESC');
	$Categorias_Contados = $accion -> categorias_contados();

	if(isset($_POST['Nue_Cat'])){
		$val_nuevo = new VD($_POST['n_tipo'], '');
		if($val_nuevo -> v_nuevo()){
			$categoria = new GD('', $val_nuevo -> pasar_tipo());
			if(BD::nuevo($categoria, 'nuevo')){
				redireccion::redirigir(CATEGORIAS);
			}
		}
	}
	if(isset($_POST['Bor_Cat'])){
		$val_borrar = new VD('', $_POST['bor_id']);
		if($val_borrar -> v_borrar()){
			$categoria = new GD($val_borrar -> pasar_id(), '');
			if(BD::eliminar($categoria, 'categoria')){
				redireccion::redirigir(CATEGORIAS);
			}
		}
	}
?>
<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_cat('', 'NUE_CAT');">Nueva Categoria</button>
		<div class="detalles">
			<span>Total: <?php echo $Categorias_Contados;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Categorias <?php echo $Hyzher_usuario; ?></caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Tipo</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if(count($Tabla_Categorias)){
					foreach ($Tabla_Categorias as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_TIPO();?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_cat('<?php echo $t_fila -> obtener_ID();?>','BOR_CAT');">
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
	<form method="POST" action="<?php echo CATEGORIAS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nueva Categoria</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Nue_Cat"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_cat('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<label for="tipo">Categoria Entrada:</label>
			<input type="text" id="tipo" name="n_tipo" required <?php if(isset($_POST['Nue_Cat'])){$val_nuevo->r_tipo();}?>>
		</div>
		<?php
			if(isset($_POST['Nue_Cat'])){
				$val_nuevo -> m_Etipo();
			}
		?>
		<div class="grupo-form">
			<button type="submit" name="Nue_Cat"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_cat('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete"></div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo CATEGORIAS;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿ Borrar Categoria ?</h2>
			</div>
			<div class="grupo">
				<button type="submit" name="Bor_Cat"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_cat('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Categoria Entrada:</label>
				<label id="ajax_bor_categoria"></label>
			</div>
		</div>
		<?php
			if(isset($_POST['Bor_Cat'])){
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Cat'])){$val_borrar -> r_id();}?> >
		<div class="grupo-form">
			<button type="submit" name="Bor_Cat"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_cat('', 'X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_cat(id, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case 'NUE_CAT':
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
			case 'BOR_CAT':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				var ajax_H = {'atributo':'CATEGORIA', 'buscar':'id', 'dato':id};
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
	if(isset($_POST['Nue_Cat'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				op_cat('', 'NUE_CAT');
			</script>
			<?php
		}
	}
?>