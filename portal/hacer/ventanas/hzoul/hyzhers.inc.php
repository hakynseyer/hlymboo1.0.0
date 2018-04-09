<?php	
	use crud_perfil\perfil as BDP;
	use \crud_blog\blog as BD;

	require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';

	if(!isset($Accion_Autores) || empty($Accion_Autores)){
		redireccion::redirigir(HOME);
	}

	$ElAutor = str_replace("-", " ", $Accion_Autores);
	$IDAutor = BD::mostrar($ElAutor, 'hyzher_id', '');
	$parametros = BDP::mostrar('%'.$ElAutor.'%', 'hoja_autor', '');
	$parametros2 = BDP::mostrar('%'.$ElAutor.'%', 'hoja_autor2', '');

	if(empty($parametros) || empty($parametros2)){
		redireccion::redirigir(HOME);
	}

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

	//Datos de debajo de la imagen principal
	$NumEntradas = BDP::mostrar($parametros2 -> obtener_ID(), 'num_entradas', '');
	$NumOpiniones = BDP::mostrar($parametros2 -> obtener_ID(), 'num_opiniones', '');
	$NumHijos = BDP::mostrar($parametros2 -> obtener_ID(), 'num_hijos', '');
	$familiasPer = BDP::mostrar($parametros2 -> obtener_ID(), 'familia_personajes', '');

	if(!empty($parametros)){
		?>
		<article class="entrada-normal">
			<div class="perfil">
				<?php
					if(!empty($parametros -> obtener_IMAGEN())){
						$LaImagen = BDP::mostrar($parametros -> obtener_IMAGEN(), 'imagen_perfil', '');
						?>
						<div class="imagen">
							<?php
								if(count($LaImagen)){
									?>
									<img src="<?php echo v_generales::componer_ruta_self($LaImagen[0]);?>" alt="<?php echo $LaImagen[1]?>">
									<?php echo $LaImagen[2];?>
									<?php
								}
							?>
							<div class="detalles">
								<span><?php echo $NumEntradas?></span>
								<span><?php echo $NumOpiniones?></span>
								<span>
									<button onclick="op_familia(Galletas.readCookie('personajesFamiliares'),false)" class="botonFam"><?php echo $NumHijos;?></button>
								</span>
							</div>
						</div>
						<?php
					}
				?>
				<div class="informacion">
					<div class="entradas-familiares" id="entradasFamiliares">
						<div class="superior-familiares">
							<h2>
								<i class="fa fa-window-close salir" aria-hidden="true" onclick="op_familia('Ocultar')"></i>
								<div class="titulo-familia">Grupos de hijos</div>		
							</h2>
						</div>
						<?php
							$numPE = 1;
							foreach ($familiasPer as $FaPe) {
								?>
								<div class="familia-entrada">
									<button onclick="menuFamilia('<?php echo str_replace(" ", "-", $FaPe -> obtener_NOMBRE());?>')"><?php echo $numPE.'.- '.$FaPe -> obtener_FAMILIA();?></button>
								</div>
								<?php
								$numPE++;
							}
						?>
					</div>
					<div class="personal">
						<span>"<?php echo $ElAutor;?>"</span>
						<div class="espacio">
							<span>
								De:
								<b><?php echo $parametros -> obtener_LUGAR();?></b>
							</span>
							<span>
								Nací: 
								<b><?php echo v_generales::componer_fecha2($parametros -> obtener_NACIMIENTO().' 00:00:00', 'fecha_1');?></b>
							</span>
							<span>
								Nombre: 
								<b><?php echo $parametros2 -> obtener_NOMBRE();?></b>
							</span>
							<span>Ingreso: 
								<b><?php echo v_generales::componer_fecha2($parametros2 -> obtener_CREADO(), 'fecha_1');?></b>
							</span>
							<span>Rango: 
								<b><?php echo $parametros2 -> obtener_GRADO();?></b>
							</span>
						</div>
					</div>
					<?php
						if(!empty($parametros -> obtener_SOCIAL1())){
							$social[0] = $parametros -> obtener_SOCIAL1();
						}
						if(!empty($parametros -> obtener_SOCIAL2())){
							$social[1] = $parametros -> obtener_SOCIAL2();
						}
						if(!empty($parametros -> obtener_SOCIAL3())){
							$social[2] = $parametros -> obtener_SOCIAL3();
						}
						if(!empty($parametros -> obtener_SOCIAL4())){
							$social[3] = $parametros -> obtener_SOCIAL4();
						}

						if(isset($social)){
					?>
						<div class="social">
							<?php 
								if(!empty($social[0])){
									?>
									<a href="<?php echo $social[0]?>" target="_blank" class="icoFacebook"><i class="fa fa-facebook-official  fa-3x" aria-hidden="true"></i></a>
									<?php
								}
								if(!empty($social[1])){
									?>
									<a href="<?php echo $social[1]?>" target="_blank" class="icoTwitter"><i class="fa fa-tumblr-square  fa-3x" aria-hidden="true"></i></a>
									<?php
								}
								if(!empty($social[2])){
									?>
									<a href="<?php echo $social[2]?>" target="_blank" class="icoYoutube"><i class="fa fa-youtube  fa-3x" aria-hidden="true"></i></a>										
									<?php
								}
								if(!empty($social[3])){
									?>
									<a href="<?php echo $social[3]?>" target="_blank" class="icoWeb"><i class="fa fa-window-restore  fa-3x" aria-hidden="true"></i></a>									
									<?php
								}
							?>
						</div>
					<?php
						}
					?>
				</div>
				<div class="contenido">
					<h3>Sobre Mi... </h3>
					<?php echo $parametros -> obtener_SOY(); ?>
				</div>
			</div>
		</article>
		<?php
	}
?>

<div class="ultimas-entradas" id="entradasPaginador">
	<div class="titular-modo2">
		<div class="titulo">Familias de <?php echo $ElAutor; ?></div>
		<span><?php echo BD::mostrar($IDAutor,'BlogsFamiliasTotalesActivos_Alias','');?> Familias Totales</span>
	</div>

	<div class="botones" id="botones">
		<button type="button" name="paginasAutores">Mostrar más</button>
		<button type="button" name="reiniciarAutores"><i class="fa fa-refresh" aria-hidden="true"></i></button>
	</div>
</div>

<script>
	function menuFamilia(Entrada){
		$(document).ready(function(){
		    Galletas.createCookie("personajesFamiliares", "personaje", "");
		});
		window.location="/hlymboo/hijos/"+Entrada;
	}
</script>