<?php
	use \realiza_opinion\opinion as VD_O;
	use \base_opinion\opinion as GD_O;
	use \crud_blog\blog as BD;
	use \crud_spam\spam as BD_S;
	use \crud_opinion\opinion as BD_O;


	require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';

	$accion = new VD_O('', '', '', '', '', '', '');

	if(isset($_POST['Nue_Opi'])){
		if(isset($_POST['n_hyzh'])){
			$hyzh = $_POST['n_hyzh'];
		}else{
			$hyzh = null;
		}
		$val_nuevo = new VD_O($EntradaNormal -> obtener_ID(), $_POST['n_opinion'], $_POST['n_spam'], $hyzh, '0', '', $Hyzher_id);
		if($val_nuevo -> v_nuevo()){
			$opinion = new GD_O('', $Hyzher_id, $val_nuevo -> pasar_blog(), $val_nuevo -> pasar_texto(), $val_nuevo -> pasar_spam(), $val_nuevo -> pasar_hyzh(), '', '0');
			if(BD_O::nuevo($opinion, 'opinion')){
				redireccion::redirigir($ruta);
			}
		}
	}
	$IDAutor = BD::mostrar($EntradaNormal -> obtener_HYZHER(), 'hyzher_id', '');
	// ********************************************************************************************* \\

				?>
				<script>
					var MuestraSolo = 5;  //Mide el número de entradas que se mostrarán.
					var Pag = 0; //Mide la última entrada en la que se mostró en pantalla (Esto equivale al páginador)
					var Autor = <?php echo $IDAutor;?>;
					$(document).ready(function(){
						ajax(Autor, 'Autores', Pag, MuestraSolo);
					});
				</script>
				<?php
	

	// ********************************************************************************************* \\

	$lasOpiniones = BD_O::mostrar($EntradaNormal -> obtener_ID(), 'las_opiniones', 'o.opinion_creado DESC');
	$totalesOpiniones = BD_O::mostrar($EntradaNormal -> obtener_ID(), 'cantidad_comentarios', '');
	$familiasEntrada = BD::mostrar($EntradaNormal -> obtener_FAMILIA(), 'obtenerEntradaFamilias', 'blog_creado');

	$NumEntradas = BD::mostrar($EntradaNormal -> obtener_HYZHER(), 'BlogsHyzherAliasActivos', '');
?>
								

<article class="entrada-blog">
	<?php
		$laCategoria = BD::mostrar($EntradaNormal -> obtener_CATEGORIA(), 'Categoria_Blog', '');
		$laClasificacion = BD::mostrar($EntradaNormal -> obtener_CLASIFICACION(), 'Clasificacion_Blog', '');
		$Mis_spams = BD_S::mostrar('%%', 'tabla_spams', 'id_spam');
	?>
	<div class="cuerpo-blog">
		<div class="entradas-familiares" id="entradasFamiliares">
			<div class="superior-familiares">
				<h2>
					<i class="fa fa-window-close salir" aria-hidden="true" onclick="op_familia('Ocultar')"></i>
					<div class="titulo-familia"><?php echo $EntradaNormal -> obtener_FAMILIA();?></div>		
				</h2>
			</div>
			<?php
			$numFE = 1;
			foreach ($familiasEntrada as $FE) {
				?>
				<div class="familia-entrada">
					<button onclick="menuFamilia('<?php echo $FE -> obtener_URL();?>')"><?php echo $numFE.'.- '.$FE -> obtener_TITULO();?></button>
				</div>
				<?php
				$numFE++;
			}
			?>
		</div>
		<div class="complementos">
			<?php
				if(!empty($laCategoria)){
					?>
					<span><?php echo $laCategoria;?></span>
					<?php
				}else{
					?>
					<span>Sin Categoria</span>
					<?php
				}

				if(!empty($laClasificacion)){
					?>
					<span><?php echo $laClasificacion;?></span>
					<?php
				}else{
					?>
					<span> Sin Clasificacion</span>
					<?php				
				}
			?>
		</div>
		<div class="remitente">
			<button onclick="op_familia(Galletas.readCookie('entradasFamiliares'), false)"><?php echo $EntradaNormal -> obtener_FAMILIA();?></button>
			<span>
				Fecha: 
				<?php echo v_generales::componer_fecha2($EntradaNormal -> obtener_CREADO(), 'fecha_2');?>
			</span>
		</div>
		<div class="redes-sociales">
				<span>
					<a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</span>
				<span>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
				</span>
		</div>
		<div class="titulo">
			<div class="titular"><?php echo $EntradaNormal -> obtener_TITULO(); ?></div>
			<?php
				if(!empty($EntradaNormal -> obtener_IMAGEN())){
					$ImagenEntrada = BD::mostrar($EntradaNormal -> obtener_IMAGEN(), 'imagen_entrada', '');
					if(count($ImagenEntrada)){
						?>
						<div class="imagen">
							<img src="<?php echo v_generales::componer_ruta_self($ImagenEntrada[1]);?>" alt="<?php echo $ImagenEntrada[0]?>">
							<span>Fuente: <?php echo $ImagenEntrada[2];?></span>
							<?php
								$EntradaPlaneacion = BD::mostrar($EntradaNormal -> obtener_ID(), 'planeacion_entrada', '');
								if(!empty($EntradaPlaneacion)){
									?>
									<div class="planeacion">
										<div class="contenidoP">
											<span>Las Ideas</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA1(), 'fecha_3');?></span>
										</div>
										<div class="contenidoP">
											<span>Lapiz y Goma</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA2(), 'fecha_3');?></span>
										</div>
										<div class="contenidoP">
											<span>Al Público</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA3(), 'fecha_3');?></span>
										</div>
										<div class="contenidoP">
											<span>Actualización 1</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA4(), 'fecha_3');?></span>
										</div>
										<div class="contenidoP">
											<span>Actualización 2</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA5(), 'fecha_3');?></span>
										</div>
										<div class="contenidoP">
											<span>Actualización 3</span>
											<span><?php echo v_generales::componer_fecha2($EntradaPlaneacion -> obtener_ETAPA6(), 'fecha_3');?></span>
										</div>
									</div>
									<?php
								}
							?>
						</div>
						<?php
					}
				}
			?>
		</div>
		<?php
			if($EntradaNormal -> obtener_PERSONAJE() != null){
				$NomPersonaje = BD::mostrar($EntradaNormal -> obtener_PERSONAJE(), 'Nombre_Personaje', '');
				?>
				<div class="personaje">
					<span><a href="<?php echo HIJOS.'/'.str_replace(' ', '-', $NomPersonaje);?>"><?php echo " ".$NomPersonaje;?></a></span>
					<span>[ Personaje creado por 
						<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $EntradaNormal -> obtener_HYZHER());?>" class="hijo-hyzher"><?php echo $EntradaNormal -> obtener_HYZHER();?></a>
					 ]</span>
				</div>
				<?php
			}
		?>
		<div class="contenido">
			<?php echo $EntradaNormal -> obtener_TEXTO(); ?>
		</div>
		<?php
			if($Fragmento && !empty($EntradaNormal -> obtener_FRAGMENTO())){
				$ParametrosFragmento = array(0 => $EntradaNormal -> obtener_FRAGMENTO(), 1 => $EntradaNormal -> obtener_HYZHER());
				$ElFragmento = BD::mostrar($ParametrosFragmento, 'Fragmento_Entrada', '');
				if(!empty($ElFragmento)){
					?>
					<div class="fragmento">
						<div class="frontal" id="frag_Frontal" onclick="fragmentoPosterior.main(true)"><?php echo $ElFragmento -> obtener_LADO1();?></div>
						<div class="posterior" id="frag_Posterior" onclick="fragmentoPosterior.main(false)"><?php echo $ElFragmento -> obtener_LADO2();?></div>
					</div>
					<?php	
				}
			}
		?>
		<div class="autor">
			<span class="inicio">Entrada original de</span>
			<span><a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $EntradaNormal -> obtener_HYZHER());?>"><?php echo " ".$EntradaNormal -> obtener_HYZHER();?></a></span>
			<?php
				$EtiqHyzher = BD::mostrar($EntradaNormal -> obtener_HYZHER(), 'etiqueta_hyzher', '');
				if(!empty($EtiqHyzher)){
					?>
					<span>"<?php echo $EtiqHyzher;?>"</span>
					<?php
				}
			?>
			<div class="logo"></div>
			<div class="derechos"><?php echo $EntradaNormal -> obtener_DERECHOS();?></div>
		</div>

		<div class="redes-sociales">
				<span>
					<a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</span>
				<span>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
				</span>
		</div>

		<div class="complementos">
			<?php
				if(!empty($laCategoria)){
					?>
					<span><?php echo $laCategoria;?></span>
					<?php
				}else{
					?>
					<span>Sin Categoria</span>
					<?php
				}
				if(!empty($laClasificacion)){
					?>
					<span><?php echo $laClasificacion;?></span>
					<?php
				}else{
					?>
					<span> Sin Clasificacion</span>
					<?php				
				}
			?>
		</div>
		<div class="remitente">
			<button onclick="op_familia(Galletas.readCookie('entradasFamiliares'), true)"><?php echo $EntradaNormal -> obtener_FAMILIA();?></button>
			<span>
				Fecha: 
				<?php echo v_generales::componer_fecha2($EntradaNormal -> obtener_CREADO(), 'fecha_2');?>
			</span>
		</div>

	</div>
</article>

<?php
	if($EntSimilar){
		?>
		<div class="ultimas-entradas" id="entradasPaginador" style="margin-top: 2rem;">
			<div class="titular-modo2">
				<div class="titulo">Más entradas de <?php echo $EntradaNormal -> obtener_HYZHER(); ?></div>
				<span><?php echo BD::mostrar($IDAutor,'BlogsFamiliasTotalesActivos_Alias','');?> Familias Totales</span>
			</div>
			<div class="botones" id="botones">	
				<button type="button" name="paginasAutores">Mostrar más</button>
				<button type="button" name="reiniciarAutores"><i class="fa fa-refresh" aria-hidden="true"></i></button>
			</div>
		</div>
		<?php
	}
?>

<?php
if($Opiniones){
	?>
	<form method="POST" action="<?php echo $ruta?>" id="LaOpinion" class="form-opinion">
		<div class="grupo-form2">
			<div class="grupo">
				<h2>Nueva Opinión</h2>
			</div>
		</div>
		<div class="grupo-form2">
			<div id="opinionMadre" class="opinion-madre"></div>
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
	</form>

	<?php
		if(isset($_POST['Nue_Opi'])){
			if(!$val_nuevo -> v_nuevo()){
				?>
				<script>
					$('#n_spam_select option[value="<?php echo $val_nuevo -> pasar_spam();?>"]').prop('selected', true);
					lanzar = true;
					if($('#hyzh').val() > 0){
						$(document).ready(function(){
							nuevoHyzh($('#hyzh').val());
						});
					}
				</script>
				<?php
			}
		}
	?>
	
	<?php
		if(count($lasOpiniones)){
			?>
				<div class="las-opiniones">
					<h2>Opiniones Encontradas [ <?php echo $totalesOpiniones; ?> ]</h2>
					<?php	
						foreach ($lasOpiniones as $opi) {
							?>
							<div class="opinion-principal" id="<?php echo $opi -> obtener_ID();?>">
								<div class="superior">
									<div class="autor">
										<i class="fa fa-user-secret icono" aria-hidden="true"></i>
										<?php
											$aut = $opi -> obtener_HYZHER();
											if($aut === null){
												$autor = "Anónimo";
											}else{
												$autor = $accion -> obtener_hyzher($aut);
											}
											echo $autor;
										?>
									</div>
									<div class="fecha">
										<?php echo $accion -> componer_fecha($opi -> obtener_CREADO(), 'fecha_1')?>
									</div>
								</div>
								<div class="texto">
									<?php echo $opi -> obtener_TEXTO();?>
								</div>
								<div class="inferior">
									<div class="responder">
										<button onclick="nuevoHyzh(<?php echo $opi -> obtener_ID();?>)">Responder</button>
									</div>
									<div class="mostrar">
										<?php
											$parametros = array(0 => $EntradaNormal -> obtener_ID(), 1 => $opi -> obtener_ID());
											$Respuestas = BD_O::mostrar($parametros, 'opiniones_respuesta', 'NO SIRVE LIMIT');
											if(count($Respuestas)-2 < 0){
												$contadorOcultos = 0;	
											}else{
												$contadorOcultos = count($Respuestas)-2;	
											}
										?>
										<button id="Mos" onclick="mostrarOcultos(<?php echo $opi -> obtener_ID();?>, <?php echo $contadorOcultos;?>)">Mostrar <?php echo $contadorOcultos;?></button>
									</div>
								</div>
									<?php
									if(count($Respuestas)){
										$rompedor = 0;
										foreach ($Respuestas as $res) {		
											?>
												<div class="respuesta <?php if($rompedor < 2){echo 'visible';}else{ echo 'oculto';}?>" id="<?php if($rompedor < 2){echo 'visible';}else{ echo 'oculto';}?>">
													<div class="superior">
														<div class="autor">
															<i class="fa fa-hand-o-right icono" aria-hidden="true"></i>
															<?php
																$aut = $res -> obtener_HYZHER();
																if($aut === null){
																	$autor = "Anónimo";
																}else{
																	$autor = $accion -> obtener_hyzher($aut);
																}
																echo $autor;
															?>
														</div>
														<div class="fecha">
															<?php echo $accion -> componer_fecha($res -> obtener_CREADO(), 'fecha_1')?>
														</div>
													</div>
													<div class="texto">
														<?php echo $res -> obtener_TEXTO();?>
													</div>
												</div>
											<?php
											$rompedor++;
										}
									}
								?>
								<input type="hidden" value="0" id="MosAct" readonly>
							</div>
							<?php
						}	
					?>
				</div>
			<?php
		}
}
	?>
<script>
	window.onload= lanzarScroll(lanzar);
	window.onunload=function(){
		window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
	}
	function lanzarScroll(lanzar){
		if(lanzar){
			var pos=window.name || 0;
			window.scrollTo(0,pos);
		}else{
			ceroScroll();
		}	
	}
	function ceroScroll(){
		window.scrollTo(0,0);
	}

	function mostrarOcultos(id, cantidad){
		if(cantidad > 0){
			activo = $('#'+id).find('#MosAct').val();
			if (activo === '0') {
				$('#'+id).find('#oculto').removeClass('oculto');
				$('#'+id).find('#oculto').addClass('visible');
				$('#'+id).find('#Mos').text("Mostrar "+cantidad);
				$('#'+id).find('#MosAct').val('1');
			}else{
				$('#'+id).find('#oculto').removeClass('visible');
				$('#'+id).find('#oculto').addClass('oculto');
				$('#'+id).find('#Mos').text("Ocultar "+cantidad);
				$('#'+id).find('#MosAct').val('0');
			}
		}
	}
	function nuevoHyzh(id){
		$('#hyzh').val(id);
		var texto = '<div class="texto">\"'+$('#'+id).find('.texto').html()+'\"</div>';
		var superior = '<div class="superior">'+$('#'+id).find('.superior').html()+'</div>';
		$('#opinionMadre').html(texto+superior);
		$('#escribirOpinion').focus();
		$("html,body").animate({ scrollTop : $("#LaOpinion").offset().top  }, 1);
	}
	function menuFamilia(Entrada){
		$(document).ready(function(){
		    Galletas.createCookie("entradasFamiliares", "index", "");
		});
		window.location="/"+Entrada;
	}
</script>