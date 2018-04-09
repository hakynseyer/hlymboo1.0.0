<?php
	use crud_personaje\personaje as BDP;
	use \crud_blog\blog as BD;

	require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';

	if(!isset($Accion_Hijos) || empty($Accion_Hijos)){
		redireccion::redirigir(HOME);
	}

	$ElPersonaje = str_replace("-", " ", $Accion_Hijos);
	$IDPersonaje = BD::mostrar($ElPersonaje, 'personaje_id', '');
	$delPersonaje = BDP::mostrar('%'.$ElPersonaje.'%', 'hoja_personaje', '');

	if(!isset($delPersonaje) || empty($delPersonaje)){
		redireccion::redirigir(HOME);
	}

	// ********************************************************************************************* \\

			?>
			<script>
				var MuestraSolo = 5;  //Mide el número de entradas que se mostrarán.
				var Pag = 0; //Mide la última entrada en la que se mostró en pantalla (Esto equivale al páginador)
				var Personaje = <?php echo $IDPersonaje;?>;
				$(document).ready(function(){
					ajax(Personaje, 'Personajes', Pag, MuestraSolo);
				});
			</script>
			<?php

	// ********************************************************************************************* \\
	
	$familiares = BDP::mostrar($delPersonaje -> obtener_FAMILIA(), 'personajes_familiares', '');

	if(!empty($delPersonaje)){
		?>
		<article class="entrada-normal">
			<div class="perfil">
				<div class="informacion">
					<div class="entradas-familiares" id="entradasFamiliares">
						<div class="superior-familiares">
							<h2>
								<i class="fa fa-window-close salir" aria-hidden="true" onclick="op_familia('Ocultar')"></i>
								<div class="titulo-familia"><?php echo $delPersonaje -> obtener_FAMILIA();?></div>		
							</h2>
						</div>
						<?php
							$numPE = 1;
							foreach ($familiares as $FaPe) {
								?>
								<div class="familia-entrada">
									<button onclick="menuFamilia('<?php echo str_replace(" ", "-", $FaPe -> obtener_NOMBRE());?>')"><?php echo $numPE.'.- '.$FaPe -> obtener_NOMBRE();?></button>
								</div>
								<?php
								$numPE++;
							}
						?>
					</div>
					<div class="personal">
						<span>"<?php echo $ElPersonaje?>"</span>
						<div class="espacio">
							<span>
								Identidad: 
								<b><?php echo $delPersonaje -> obtener_SEXO();?></b>
							</span>
							<span>
								Edad: 
								<b><?php echo $delPersonaje -> obtener_EDAD();?></b>
							</span>
							<span>
								Creador: 
								<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $delPersonaje -> obtener_HYZHER());?>">
									<?php echo $delPersonaje -> obtener_HYZHER();?>
								</a>
							</span>			
							<span>
								Familia: 
								<button onclick="op_familia(Galletas.readCookie('personajesFamiliares'), false)" class="botonFam"><?php echo $delPersonaje -> obtener_FAMILIA();?></button>
							</span>
							<span>
								Nací: 
								<b><?php echo v_generales::componer_fecha2($delPersonaje -> obtener_CREADO(), 'fecha_1');?></b>
							</span>
						</div>
					</div>
				</div>
				<?php
					if(!empty($delPersonaje -> obtener_IMAGEN())){
						$LaImagen = BDP::mostrar($delPersonaje -> obtener_IMAGEN(), 'imagen_personaje', '');
						?>
						<div class="imagen">
							<img src="<?php echo v_generales::componer_ruta_self($LaImagen[0]);?>" alt="<?php echo $LaImagen[1]?>">
						</div>
						<?php
					}
				?>
				<div class="contenido">
					<h3>Relacion... </h3>
					<?php echo $delPersonaje -> obtener_RELACION(); ?>
					<h3>Personalidad... </h3>
					<?php echo $delPersonaje -> obtener_PERSONALIDAD(); ?>
					<h3>Historia... </h3>
					<?php echo $delPersonaje -> obtener_HISTORIA(); ?>
					<h3>Metas... </h3>
					<?php echo $delPersonaje -> obtener_METAS(); ?>
					<h3>Extras... </h3>
					<?php echo $delPersonaje -> obtener_EXTRAS(); ?>
				</div>
			</div>
		</article>
		<?php
	}
?>

<div class="ultimas-entradas" id="entradasPaginador">
	<div class="titular-modo2">
		<div class="titulo">Familias de <?php echo $ElPersonaje; ?></div>
		<span><?php echo BD::mostrar($IDPersonaje,'BlogsFamiliasTotalesActivos_Personajes','');?> Familia</span>
	</div>
	
	<div class="botones" id="botones">
		<button type="button" name="paginasPersonajes">Mostrar más</button>
		<button type="button" name="reiniciarPersonajes"><i class="fa fa-refresh" aria-hidden="true"></i></button>
	</div>
</div>

<script>
	function menuFamilia(Entrada){
		// $(document).ready(function(){
		//     Galletas.createCookie("personajesFamiliares", "personaje", "");
		// });
		window.location="/hlymboo/hijos/"+Entrada;
	}
</script>