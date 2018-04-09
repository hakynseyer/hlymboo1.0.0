<?php
	use \realiza_opinion\opinion as VD;
	use \base_opinion\opinion as GD;
	use \crud_opinion\opinion as BD;
	use \crud_spam\spam as BD_S;

	$accion = new VD('', '', '', '', '', '', '');
	$Blogs = $accion -> blogs_opinados($Hyzher_id, 'o.opinion_creado DESC');

	$Mis_spams = BD_S::mostrar('%%', 'tabla_spams', 'id_spam');

	if(isset($_POST['Nue_Opi'])){
		if(isset($_POST['n_hyzh'])){
			$hyzh = $_POST['n_hyzh'];
		}else{
			$hyzh = null;
		}
		$val_nuevo = new VD($_POST['n_blog'], $_POST['n_opinion'], $_POST['n_spam'], $hyzh, '0', '', $Hyzher_id);
		if($val_nuevo -> v_nuevo()){
			$opinion = new GD('', $Hyzher_id, $val_nuevo -> pasar_blog(), $val_nuevo -> pasar_texto(), $val_nuevo -> pasar_spam(), $val_nuevo -> pasar_hyzh(), '', '0');
			if(BD::nuevo($opinion, 'opinion')){
				?>
				<script>
					window.onload = esperarRecarga;
					function esperarRecarga(){
						$('#LaOpinion').css('display','none');
						actualizarSelect(<?php echo $_POST['n_blog']?>);
						$('#formOpiniones').click();
					}
				</script>
				<?php
			}
		}
	}

	if(isset($_POST['tabla'])){
		$parametros = $accion -> tabla_opiniones($_POST['id'], 'o.opinion_creado DESC');
		if (count($parametros)) {
			?>
				<div class="tabla t-opiniones">
					<table>
						<caption>Fragmentos <?php echo $Hyzher_usuario;?></caption>
						<tr class="cabecera">
							<td>Id</td>
							<td>Opinion</td>
							<td>Madre</td>
							<td>Hyzher</td>
							<td>Creado</td>
							<td>Estado</td>
							<td>Trabajos</td>
						</tr>
						<?php	
							foreach ($parametros as $t_fila) {
								$elAutor = "Anónimo";
								$laGradiente = "-----";
								if ($t_fila -> obtener_HYZH() !== null) {
									$laGradiente = $accion -> obtener_respuesta($t_fila -> obtener_HYZH());
								}
								if($t_fila -> obtener_HYZHER() !== null){
									$elAutor = $accion -> obtener_hyzher($t_fila -> obtener_HYZHER());
								}
							?>
								<tr class="cuerpo">
									<td><?php echo $t_fila -> obtener_ID();?></td>
									<td><textarea class="super-escrito"><?php echo $t_fila -> obtener_TEXTO();?></textarea></td>
									<td><textarea class="super-escrito"><?php echo $laGradiente;?></textarea></td>
									<td><?php echo $elAutor;?></td>
									<td><?php echo $accion -> componer_fecha($t_fila -> obtener_CREADO(), 'fecha_1')?></td>
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
											<input type="radio" name="trabajo" class="qc-radio" onclick="op_opinion('<?php echo $t_fila -> obtener_ID();?>', '', '', '', '', 'EST_OPI');">
											<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>
										</label>
										<label>
											<input type="radio" name="trabajo" class="qc-radio" onclick="op_opinion('<?php echo $t_fila -> obtener_ID();?>', '', '', '', '', 'BOR_OPI');">
											<i class="fa fa-trash fa-2x" aria-hidden="true"></i>
										</label>
										<?php
											if($t_fila -> obtener_HYZH() === null){
												?>
												<label>
													<input type="radio" name="trabajo" class="qc-radio" onclick="op_opinion('<?php echo $t_fila -> obtener_ID();?>','<?php echo $t_fila -> obtener_TEXTO();?>','<?php echo $elAutor?>', '<?php echo $accion -> componer_fecha($t_fila -> obtener_CREADO(), 'fecha_1')?>', '<?php echo $_POST['id'];?>','RES_OPI');">
													<i class="fa fa-external-link-square fa-2x" aria-hidden="true"></i>
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
				<script>
					window.onload = esperarRecarga;
					function esperarRecarga(){
						actualizarSelect(<?php echo $_POST['id']?>);
					}
				</script>
			<?php
		}
	}
?>

<form method="POST" action="<?php echo OPINIONES;?>" class="form-solitario">
	<div class="caja-select">
		<select id="blogOpiniones" name="id">
			<option value="Vacio">Seleccione Entrada</option>
			<?php
				if (count($Blogs)) {
					foreach ($Blogs as $BlogN) {
						$IdBlog[] = $BlogN -> obtener_ID();
						$TiBlog[] = $BlogN -> obtener_BLOG();
					}
					$id_blogs = array_unique($IdBlog);
					$TiBlog = array_unique($TiBlog);
					if (count($id_blogs) && count($TiBlog)) {
						for ($i=0; $i <count($id_blogs) ; $i++) { 
							?>
							<option value="<?php echo $id_blogs[$i]?>"><?php echo $TiBlog[$i]?></option>
							<?php
						}
					}
				}
			?>
		</select>
	</div>
	<button type="submit" name="tabla" id="formOpiniones">Cargar</button>
</form>

<form method="POST" action="<?php echo $ruta?>" id="LaOpinion" class="form-opinion form-ocultar">
	<div class="grupo-form2">
		<div class="grupo">
			<h2>Nueva Opinion</h2>
		</div>
	</div>
	<div class="grupo-form2">
		<div id="opinionMadre" class="opinion-madre"></div>
		<input type="hidden" id= "opinionMadreOculto" name="opinion_madre">
	</div>
	<div class="grupo-form2">
		<div class="caja-select">
			<select name="n_spam" id="n_spam_select">
				<option value="Vacio">Tipo de Opinion [ <?php echo count($Mis_spams);?> ]</option>
				<?php
				if (count($Mis_spams)) {
					foreach ($Mis_spams as $spams) {
						?>
						<option value="<?php echo $spams -> obtener_ID();?>"><?php echo $spams -> obtener_TIPO();?></option>
						<?php
					}
				}
				?>
			</select>
		</div>
		<p>Los comentarios creados serán validados por un Hyzher autorizado antes de que puedan ser publicados, esto es por motivos de control de spam</p>
	</div>
	<?php
		if (isset($_POST['Nue_Opi'])) {
			$val_nuevo -> m_Espam();
			$val_nuevo -> m_Eblog();
		}
	?>
	<div class="grupo-form2">
		<textarea name="n_opinion" cols="30" rows="5" id="escribirOpinion" required id="nOpinion"><?php if(isset($_POST['Nue_Opi'])){$val_nuevo->r_texto();}?></textarea>
		<button type="submit" name="Nue_Opi"><i class="fa fa-briefcase" aria-hidden="true"> Opinar</i></button>
	</div>
	<?php
		if (isset($_POST['Nue_Opi'])) {
			$val_nuevo -> m_Etexto();
			$val_nuevo -> m_Ehyzh();
		}
	?>
	<input type="hidden" name="n_hyzh" id="hyzh" readonly <?php if(isset($_POST['Nue_Opi'])){$val_nuevo->r_hyzh();}?> >
	<input type="hidden" name="n_blog" id="blog" readonly <?php if(isset($_POST['Nue_Opi'])){$val_nuevo->r_blog();}?> >
</form>

<?php
	if(isset($_POST['Nue_Opi'])){
		if(!$val_nuevo -> v_nuevo()){
			?>
			<script>
				$('#n_spam_select option[value="<?php echo $val_nuevo -> pasar_spam();?>"]').prop('selected', true);
				$('#LaOpinion').css('display','block');	
				$('#opinionMadre').html('<?php echo $_POST['opinion_madre']?>');
				$('#opinionMadreOculto').val('<?php echo $_POST['opinion_madre']?>');
			</script>
			<?php
		}
	}
?>
<script>
	function op_opinion(id, texto, hyzher, fecha, blog, accion){
		switch(accion){
			case 'EST_OPI':
				var ajax_H = {'atributo':'OPINION_ESTADO', 'id':id};
				ajax_global(ajax_H, accion);
				break;
			case 'BOR_OPI':
				var ajax_H = {'atributo':'OPINION_BORRAR', 'id':id};
				ajax_global(ajax_H, accion);
				break;
			case 'RES_OPI':
				$('#LaOpinion').css('display','block');
				$('#hyzh').val(id);
				$('#blog').val(blog);
				var texto = '<div class="texto">\"'+texto+'\"</div>';
				var superior = '<div class="superior"><div class="autor">'+hyzher+'</div><div class="fecha">'+fecha+'</div></div>';
				$('#opinionMadre').html(texto+superior);
				$('#opinionMadreOculto').val(texto+superior);
				$('#escribirOpinion').focus();
				break;
		}
	}
	function actualizarSelect(id){
		$('#blogOpiniones option[value="'+id+'"]').prop('selected', true);
	}
</script>