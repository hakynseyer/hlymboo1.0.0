<?php
	require_once 'portal/hacer/php/crud/crud_leyenda.inc.php';
	require_once 'portal/hacer/php/base/base_leyenda.inc.php';
	require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';

	use \crud_leyenda\leyenda as BD;

	// ********************************************************************************************* \\
			
			$numeroLeyendas = 3;	//Representa el numero de leyendas que se mostrarán al cargar la pagina.

	// ********************************************************************************************* \\

?>
<header>
	<div class="logo">
		<h2>HLYMBOO</h2>
	</div>
	<nav>
		<div id="header_toggle" class="header-toggle">
			<i class="fa fa-hand-o-down" aria-hidden="true"></i> Menu
		</div>
		<ul>
			<li>
				<a href="<?php echo HLYMBOO;?>"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
			</li>
			<li>
				<a href="Gracias"><i class="fa fa-paw" aria-hidden="true"></i> Gracias</a>
			</li>
			<li>
				<a href="Historia"><i class="fa fa-heartbeat" aria-hidden="true"></i> Historia</a>
			</li>
		</ul>
	</nav>
	<div class="leyenda">
		<?php
			$lasLeyendas = BD::mostrar('','mostrar_leyendas_activas',$numeroLeyendas);
			if(count($lasLeyendas)){
				for ($i=0; $i < count($lasLeyendas) ; $i++) {
					?>
						<div class="entrada-leyenda">
							<span>"<?php echo $lasLeyendas[$i] -> obtener_ESCRITO();?>"</span>
							<a href="<?php echo HIJOS.'/'.str_replace(' ', '-', $lasLeyendas[$i] -> obtener_PERSONAJE());?>">: <?php echo v_generales::resumir_texto($lasLeyendas[$i] -> obtener_PERSONAJE(), 12)?></a>
						</div>
					<?php 
				}
			}else{
				?>
				<div class="entrada-leyenda">
					<span>"Nunca menosprecies los errores... Los errores representan la esencia de tu verdadero yo, aprende a dominarlos."</span>
					<span>: Hakyn Seyer</span>
				</div>
				<div class="entrada-leyenda">
					<span>"Sin libertad eres igual a una roca... adios sueños, adios esperanzas, adios destino."</span>
					<span>: Hakyn Seyer</span>
				</div>
				<div class="entrada-leyenda">
					<span>"Solo podrás confiar en alguien cuando ambos conozcan las fallas del otro, esa es la verdadera amistad."</span>
					<span>: Hakyn Seyer</span>
				</div>
				<?php
			}
		?>
	</div>
</header>