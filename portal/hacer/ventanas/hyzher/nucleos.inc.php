<?php
	use \realiza_nucleo\nucleo as VD;
	use \base_nucleo\nucleo as GD;
	use \crud_nucleo\nucleo as BD;

	$accion = new VD('', '', '', '', '');
	$Tabla_Nucleos = $accion -> tabla_nucleo('', 'n.nucleo_familia');
	$hyzhers_totales = $accion -> hyzhers_totales();
	$hyzhers_nucleo = $accion -> hyzhers_nucleo();
	$Mis_hyzhers = $accion -> hyzhers_faltantes();
	$Familia_Bruta = $accion -> familia_nucleo();

	if(isset($_POST['Nue_Nucleo'])){
		$val_nuevo = new VD($_POST['n_hyzher'], $_POST['n_familia'], '', '', '');
		if($val_nuevo -> v_nuevo()){
			$nucleo = new GD('', $val_nuevo -> pasar_hyzher(), $val_nuevo -> pasar_familia(), $val_nuevo -> pasar_cerradura(), '');
			if(BD::nuevo($nucleo, 'nuevo')){
				redireccion::redirigir(NUCLEOS);
			}
		}
	}

	if(isset($_POST['Fam_Nucleo_Uno'])){
		$val_cambiarF1 = new VD('', $_POST['cam_fam1'], '', $_POST['camF1_id'], '');
		if($val_cambiarF1 -> v_cambiar_familia_uno()){
			$nucleo = new GD($val_cambiarF1 -> pasar_ID(), '', $val_cambiarF1 -> pasar_familia(), $val_cambiarF1 -> pasar_cerradura(), '');
			if(BD::modificar($nucleo, 'familia_uno')){
				redireccion::redirigir(NUCLEOS);
			}
		}
	}

	if(isset($_POST['Fam_Nucleo_Todos'])){
		$val_cambiarFT = new VD('', $_POST['cam_famT'], '', $_POST['camFT_id'], $_POST['camFT_familia']);
		if($val_cambiarFT -> v_cambiar_familia_nucleo()){
			$nucleo = new GD($val_cambiarFT -> pasar_familia2(), '', $val_cambiarFT -> pasar_familia(), $val_cambiarFT -> pasar_cerradura(), '');
			if(BD::modificar($nucleo, 'familia_grupo')){
				redireccion::redirigir(NUCLEOS); 	
			}
		}
	}

	if(isset($_POST['Cerr_Nucleo_Todos'])){
		$val_cambiarCR = new VD('', '', '', $_POST['camCR_id'], $_POST['camCR_familia']);
		if($val_cambiarCR -> v_cambiar_cerradura()){
			$val_cambiarCR -> nueva_cerradura();
			$nucleo = new GD('', '', $val_cambiarCR -> pasar_familia2(), $val_cambiarCR -> pasar_cerradura(), '');
			if(BD::modificar($nucleo, 'cerradura_familia')){
				redireccion::redirigir(NUCLEOS);
			}
		}
	}

	if(isset($_POST['Bor_Nucleo'])){
		$val_borrar = new VD('', '', '', $_POST['bor_id'], '');
		if($val_borrar -> v_borrar()){
			$nucleo = new GD($val_borrar -> pasar_id(), '', '', '', '');
			if(BD::eliminar($nucleo, 'nucleo')){
				redireccion::redirigir(NUCLEOS);
			}
		}
	}

?>

<div class="el-paquete" id="el_principado">
	<div class="f-nuevo">
		<button onclick="op_nucleo('','NUE_NUCLEO');">Nuevo Núcleo</button>
		<div class="detalles">
			<span>Hyzhers: <?php echo $hyzhers_totales;?></span>
			<span>Nucleos: <?php echo $hyzhers_nucleo;?></span>
		</div>
	</div>
	<div class="tabla">
		<table>
			<caption>Núcleos Hyzhers</caption>
			<tr class="cabecera">
				<td>Id</td>
				<td>Hyzher</td>
				<td>Familia</td>
				<td>Creado</td>
				<td>Trabajos</td>
			</tr>
			<?php
				if (count($Tabla_Nucleos)) {
					foreach ($Tabla_Nucleos as $t_fila) {
						?>
						<tr class="cuerpo">
							<td><?php echo $t_fila -> obtener_ID();?></td>
							<td><?php echo $t_fila -> obtener_HYZHER();?></td>
							<td><?php echo $t_fila -> obtener_FAMILIA();?></td>
							<td><?php echo $accion -> componer_fecha($t_fila -> obtener_CREADO(), 'fecha_hora');?></td>
							<td>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_nucleo('<?php echo $t_fila -> obtener_ID();?>','CAM_NUCLEO_FAM1');">
									<i class="fa fa-user-secret fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_nucleo('<?php echo $t_fila -> obtener_ID();?>','CAM_NUECLEO_FAMT');">
									<i class="fa fa-users fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_nucleo('<?php echo $t_fila -> obtener_ID();?>','CAM_CERRADURA');">
									<i class="fa fa-key fa-2x" aria-hidden="true"></i>
								</label>
								<label>
									<input type="radio" name="trabajo" class="qc-radio" onclick="op_nucleo('<?php echo $t_fila -> obtener_ID();?>','BOR_NUCLEO');">
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
	<form method="POST" action="<?php echo NUCLEOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Nuevo Núcleo</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Nue_Nucleo"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_nuevoI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_nucleo('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<label>Hyzher:</label>
			</div>
			<div class="grupo">
				<div class="caja-select">
					<select name="n_hyzher" id="n_hyzher_select">
						<option value="Vacio">Hyzhers [ <?php echo count($Mis_hyzhers);?> ]</option>
						<?php
						if (count($Mis_hyzhers)) {
							foreach ($Mis_hyzhers as $Mis_hyz) {
								?>
								<option value="<?php echo $Mis_hyz -> obtener_ID();?>"><?php echo $Mis_hyz -> obtener_ALIAS();?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['Nue_Nucleo'])) {
				$val_nuevo -> m_Ehyzher();
			}
		?>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="familia">Familia Núcleo:</label>
					<input type="text" id="familia" name="n_familia" required <?php if(isset($_POST['Nue_Nucleo'])){$val_nuevo->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="n_familia_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Nucleos = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Nucleos)){echo count($Familia_Nucleos);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Nucleos)) {
									foreach ($Familia_Nucleos as $f_nucleo) {
										?>
										<option value="<?php echo $f_nucleo;?>"><?php echo $f_nucleo;?></option>
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
			if (isset($_POST['Nue_Nucleo'])) {
				$val_nuevo -> m_Efamilia();
			}
		?>
		<div class="grupo-form">
			<button type="submit"  name="Nue_Nucleo"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_nuevoF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_nucleo('','X_nuevo');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="la_familia1">
	<form method="POST" action="<?php echo NUCLEOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Familia Uno</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Fam_Nucleo_Uno"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_fam1I"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_nucleo('','X_familia1');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Hyzher:</label>
				<label class="col-md-9" id="ajax_hyzherF1"></label>
				<label class="col-md-3">Familia:</label>
				<label class="col-md-3" id="ajax_familiaF1"></label>
				<label class="col-md-3">Ingreso:</label>
				<label class="col-md-3" id="ajax_creadoF1"></label>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familia1">Familia Núcleo:</label>
					<input type="text" id="ajax_familia1" name="cam_fam1" required <?php if(isset($_POST['Fam_Nucleo_Uno'])){$val_cambiarF1->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familia1_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Nucleos = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Nucleos)){echo count($Familia_Nucleos);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Nucleos)) {
									foreach ($Familia_Nucleos as $f_nucleo) {
										?>
										<option value="<?php echo $f_nucleo;?>"><?php echo $f_nucleo;?></option>
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
			if (isset($_POST['Fam_Nucleo_Uno'])) {
				$val_cambiarF1 -> m_Efamilia();
				$val_cambiarF1 -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_camF1_id" name="camF1_id" readonly <?php if(isset($_POST['Fam_Nucleo_Uno'])){$val_cambiarF1->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Fam_Nucleo_Uno"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_fam1F"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_nucleo('','X_familia1');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="la_familiaT">
	<form method="POST" action="<?php echo NUCLEOS; ?>" class="form-modal modal-ch">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Familia Todos</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Fam_Nucleo_Todos"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" id="Lim_famTI"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
				<button type="button" onclick="op_nucleo('','X_familia2');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label class="col-md-3">Hyzher:</label>
				<label class="col-md-9" id="ajax_hyzherFT"></label>
				<label class="col-md-3">Familia:</label>
				<label class="col-md-3" id="ajax_familiaFT"></label>
				<label class="col-md-3">Ingreso:</label>
				<label class="col-md-3" id="ajax_creadoFT"></label>
			</div>
		</div>
		<div class="grupo-form">
			<div class="grupo">
				<div class="parte">
					<label for="ajax_familiaT">Familia Núcleo:</label>
					<input type="text" id="ajax_familiaT" name="cam_famT" required <?php if(isset($_POST['Fam_Nucleo_Todos'])){$val_cambiarFT->r_familia();}?> >
				</div>
				<div class="parte">
					<div class="caja-select">
						<select id="cam_familiaT_select">
							<?php
								if (count($Familia_Bruta)) {
									foreach ($Familia_Bruta as $fam) {
										$Fam_B[] = $fam -> obtener_FAMILIA();
									}
									$Familia_Nucleos = array_unique($Fam_B);
								}
							?>
							<option value="Vacio">Familias Creadas [ <?php if(isset($Familia_Nucleos)){echo count($Familia_Nucleos);}else{echo '0';}?> ]</option>
							<?php
								if (count($Familia_Nucleos)) {
									foreach ($Familia_Nucleos as $f_nucleo) {
										?>
										<option value="<?php echo $f_nucleo;?>"><?php echo $f_nucleo;?></option>
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
			if (isset($_POST['Fam_Nucleo_Todos'])) {
				$val_cambiarFT -> m_Efamilia();
				$val_cambiarFT -> m_EfamiliaBuscar();
			}
		?>
		<input type="hidden" id="ajax_camFT_familia" name="camFT_familia" readonly <?php if(isset($_POST['Fam_Nucleo_Todos'])){$val_cambiarFT->r_familia2();}?> >
		<input type="hidden" id="ajax_camFT_id" name="camFT_id" readonly <?php if(isset($_POST['Fam_Nucleo_Todos'])){$val_cambiarFT->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Fam_Nucleo_Todos"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" id="Lim_famTF"><i class="fa fa-eraser" aria-hidden="true"> Limpiar</i></button>
			<button type="button" onclick="op_nucleo('','X_familia2');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="la_cerradura">
	<form method="POST" action="<?php echo NUCLEOS; ?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>Cambiar Cerradura Familia</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Cerr_Nucleo_Todos"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
				<button type="button" onclick="op_nucleo('','X_cerradura');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Hyzher:</label>
					<label id="ajax_hyzherCR"></label>
				<label>Familia:</label>
					<label id="ajax_familiaCR"></label>
				<label>Cerradura</label>
					<label id="ajax_cerraduraCR"></label>
				<label>Ingreso:</label>
					<label id="ajax_creadoCR"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Cerr_Nucleo_Todos'])) {
				$val_cambiarCR -> m_EfamiliaBuscar();
			}
		?>
		<input type="hidden" id="ajax_camCR_familia" name="camCR_familia" readonly <?php if(isset($_POST['Cerr_Nucleo_Todos'])){$val_cambiarCR->r_familia2();}?> >
		<input type="hidden" id="ajax_camCR_id" name="camCR_id" readonly <?php if(isset($_POST['Cerr_Nucleo_Todos'])){$val_cambiarCR->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Cerr_Nucleo_Todos"><i class="fa fa-briefcase" aria-hidden="true"> Archivar</i></button>
			<button type="button" onclick="op_nucleo('','X_cerradura');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<div class="el-paquete" id="el_borrado">
	<form method="POST" action="<?php echo NUCLEOS;?>" class="form-modal modal-ch-b">
		<div class="grupo-form">
			<div class="grupo">
				<h2>¿Borrar Núcleo?</h2>
			</div>
			<div class="grupo">
				<button type="submit"  name="Bor_Nucleo"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
				<button type="button" onclick="op_nucleo('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
			</div>
		</div>
		<div class="grupo-form">
			<div class="informativo">
				<label>Hyzher:</label>
					<label id="ajax_bor_hyzherCR"></label>
				<label>Familia:</label>
					<label id="ajax_bor_familiaCR"></label>
				<label>Ingreso:</label>
					<label id="ajax_bor_creadoCR"></label>
			</div>
		</div>
		<?php
			if (isset($_POST['Bor_Nucleo'])) {
				$val_borrar -> m_Eid();
			}
		?>
		<input type="hidden" id="ajax_bor_id" name="bor_id" readonly <?php if(isset($_POST['Bor_Nucleo'])){$val_borrar->r_id();}?> >
		<div class="grupo-form">
			<button type="submit"  name="Bor_Nucleo"><i class="fa fa-trash" aria-hidden="true"> Borrar</i></button>
			<button type="button" onclick="op_nucleo('','X_borrar');"><i class="fa fa-minus-circle" aria-hidden="true"> Cancelar</i></button>
		</div>
	</form>
</div>


<script>
	function op_nucleo(valor, accion){
		$('#el_principado').css('pointer-events' , 'none');
		switch(accion){
			case'NUE_NUCLEO':
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
			case 'CAM_NUCLEO_FAM1':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
	            limpiador.limpiarFAM1();
	            var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':valor};
	            ajax_global(ajax_H,accion);
				$('#la_familia1').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_familia1").offset().top  }, 1);
				break;
					case 'X_familia1':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#la_familia1').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'CAM_NUECLEO_FAMT':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
	            limpiador.limpiarFAMT();
	            var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':valor};
	            ajax_global(ajax_H,accion);
				$('#la_familiaT').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_familiaT").offset().top  }, 1);
				break;
					case 'X_familia2':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#la_familiaT').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'CAM_CERRADURA':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
	            var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':valor};
	            ajax_global(ajax_H,accion);
				$('#la_cerradura').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_cerradura").offset().top  }, 1);
				break;
					case 'X_cerradura':
						bloquedarScroll.activo = false;
						bloquedarScroll.accion();
						$('#la_cerradura').css({'display':'none', 'opacity': '0'});
						$('#el_principado').css('pointer-events' , 'auto');
						break;
			case 'BOR_NUCLEO':
				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
	            var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':valor};
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
	if (isset($_POST['Nue_Nucleo'])) {
		if (!$val_nuevo -> v_nuevo()) {
			?>
			<script>
				$('#n_hyzher_select option[value="<?php echo $val_nuevo -> pasar_hyzher();?>"]').prop('selected', true);
				$('#n_familia_select option[value="<?php echo $val_nuevo -> pasar_familia();?>"]').prop('selected', true);
				op_nucleo('','NUE_NUCLEO');
			</script>
			<?php
		}
	}

	if(isset($_POST['Fam_Nucleo_Uno'])){
		if(!$val_cambiarF1 -> v_cambiar_familia_uno()){
			?>
			<script>
				var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':<?php echo $val_cambiarF1 -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_NUCLEO_FAM1_ERRORES');

				$('#cam_familia1_select option[value="<?php echo $val_cambiarF1 -> pasar_familia();?>"]').prop('selected', true);

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#la_familia1').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_familia1").offset().top  }, 1);
			</script>
			<?php
		}
	}

	if(isset($_POST['Fam_Nucleo_Todos'])){
		if(!$val_cambiarFT -> v_cambiar_familia_nucleo()){
			?>
			<script>
				var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':<?php echo $val_cambiarFT -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_NUCLEO_FAMT_ERRORES');

				$('#cam_familiaT_select option[value="<?php echo $val_cambiarFT -> pasar_familia();?>"]').prop('selected', true);

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#la_familiaT').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_familiaT").offset().top  }, 1);
			</script>
			<?php
		}
	}

	if(isset($_POST['Cerr_Nucleo_Todos'])){
		if(!$val_cambiarCR -> v_cambiar_cerradura()){
			?>
			<script>
				var ajax_H = {'atributo':'NUCLEOS', 'buscar':'id', 'dato':<?php echo $val_cambiarCR -> pasar_id();?>};
				ajax_global(ajax_H, 'CAM_CERRADURA_ERRORES');

				bloquedarScroll.activo = true;
				bloquedarScroll.accion();
				$('#la_cerradura').css({'display': 'flex' , 'opacity':'1'});
				$("html,body").animate({ scrollTop : $("#la_cerradura").offset().top  }, 1);
			</script>
			<?php
		}
	}

?>