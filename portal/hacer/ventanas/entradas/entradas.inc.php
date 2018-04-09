<?php
	use \realiza_tablones\tablones as Tablon;
	use \construye_Pfamilia\familia as Pfamilia;
	use \crud_blog\blog as BD;

	// ********************************************************************************************* \\

				$numeroPfamilia = 9; //Mide el numero de paneles familiares que se van a mostrar por pagina

				$numeroTablones = 9;	//Mide el numero de tablones que serán mostrados.

				?>
				<script>
					var MuestraSolo = 15;  //Mide el número de entradas que se mostrarán.
					var Pag = 0; //Mide la última entrada en la que se mostró en pantalla (Esto equivale al páginador)
					$(document).ready(function(){
						ajaxBotones();
					});
				</script>
				<?php
	

	// ********************************************************************************************* \\

?>

<div class="tablon-pfamilias">
	<?php
		Pfamilia::generar_panel($numeroPfamilia, 'Global');
	?>
</div>

<div class="ultimas-entradas" id="entradasPaginador">
	<div class="titular-modo2 titulo-UE">
		<div class="titulo">Últimas Familias</div>
		<span><?php echo BD::mostrar('','BlogsFamiliasTotalesActivos','');?> Familias Totales</span>
	</div>
	<div class="menu-busqueda">
		<form method="POST" id="FormBuscador">
			<div class="modulo">
				<span>Buscar Categorias</span>
				<div class="caja-select">
					<select name="categorias">
						<option value="0">Todas</option>
						<?php
							$Categorias = BD::mostrar('', 'categoriasDisponibles', '');
							foreach ($Categorias as $categoria) {
								?>
								<option value="<?php echo $categoria -> obtener_ID();?>"><?php echo $categoria -> obtener_CATEGORIA();?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="modulo">
				<span>Buscar Autores</span>
				<div class="caja-select">
					<select name="autores">
						<option value="0">Todos</option>
						<?php
							$Autores = BD::mostrar('', 'autoresDisponibles', '');
							foreach ($Autores as $autor) {
								?>
								<option value="<?php echo $autor -> obtener_ID();?>"><?php echo $autor -> obtener_HYZHER();?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="modulo">
				<span>Buscar Clasificaciones</span>
				<div class="caja-select">
					<select name="clasificaciones">
						<option value="0">Todas</option>
						<?php
							$Clasificaciones = BD::mostrar('', 'clasificacionesDisponibles', '');
							foreach ($Clasificaciones as $clasificacion) {
								?>
								<option value="<?php echo $clasificacion -> obtener_ID();?>"><?php echo $clasificacion -> obtener_CLASIFICACION();?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="modulo">
				<span>Buscar Familia</span>
				<div class="buscador-manual">
					<input type="text" name="familias">
					<button type="button" name="buscar"><i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</div>
		</form>
	</div>
	<div class="botones" id="botones">
		<button type="button" name="paginas">Mostrar más</button>
		<button type="button" name="reiniciar"><i class="fa fa-refresh" aria-hidden="true"></i></button>
	</div>
</div>

<div class="tablon-tareas">
	<?php
		Tablon::generar_tablones($numeroTablones);
	?>
</div>