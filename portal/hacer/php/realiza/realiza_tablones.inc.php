<?php
namespace realiza_tablones;
	
	require_once 'validaciones_generales.inc.php';

use \crud_tarea\tarea as BD_Tarea;

class tablones extends \v_generales{

	public static function generar_tablones($numeroTablones){
	// ********************************************************************************************* \\

				//SE MOVIO A ENTRADAS

	// ********************************************************************************************* \\

		if(isset($_GET['Tab_Hyzh']) && !empty($_GET['Tab_Hyzh'])){
			if(password_verify('6UnMoradODelCieLO8', $_GET['Tab_Hyzh'])){
				if(isset($numeroTablones) && $numeroTablones > 0){
					$LosTablones = BD_Tarea::mostrar($numeroTablones,'tablon_tareas_vista','');
					?>
					<div class="advertencia-vista">
						Tablones en modo de vista para Hyzher:  "<?php echo $LosTablones[0] -> obtener_ALIAS();?>"... Estos tablones se encuentran en modo oculto.
					</div>
					<?php
				}else{
					$LosTablones = BD_Tarea::mostrar($numeroTablones, 'tablon_tareas', '');
				}
			}else{
				$LosTablones = BD_Tarea::mostrar($numeroTablones, 'tablon_tareas', '');
			}
		}else{
			$LosTablones = BD_Tarea::mostrar($numeroTablones, 'tablon_tareas', '');
		}

		$tamanioTareas = count($LosTablones);
		if($tamanioTareas % 3 != 0){
			$decimalTablon = $tamanioTareas / 3;
			$redondearTablon = round($decimalTablon);
			if($redondearTablon <= $decimalTablon){
				$widthTablon = ($redondearTablon + 1) * 100;
			}else{
				$widthTablon = $redondearTablon * 100;
			}
		}else{
			$widthTablon = ($tamanioTareas / 3)*100;
		}
		if(count($LosTablones)){
			?>
			<div class="titular-modo1">
				<span id="tablonAtras"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
				<div class="titulo">PRÓXIMAS ENTRADAS</div>
				<span id="tablonAdelante"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
			</div>
			<div class="tablon-general" id="TablonesGenerales" style="<?php echo "width:".$widthTablon."%"?>" >
				<?php
					self::construir_tablon($LosTablones, $widthTablon);
				?>
			</div>
			<?php
		}
		if(isset($tamanioTareas) && $tamanioTareas > 3){
			?>
			<script>var MovimientoTablon = true;</script>
			<?php
		}else{
			?>
			<script>var MovimientoTablon = false;</script>
			<?php
		}
	}

	public static function construir_tablon($tablones, $anchoTablones){
		$tablonActual = 0;
		$tablonesTotales = count($tablones);
		$numeroCuadros = $anchoTablones/100;
		$anchoCuadro = 100/($anchoTablones/100);
		
		if(isset($tablones)){
			for ($i=1; $i <= $numeroCuadros ; $i++) { 
				?>
				<span class="cuadros-tablones" style = "<?php echo "width:".$anchoCuadro."%"?>">
					<?php
						$LimiteTablones = 0;
						for ($j=$tablonActual; $j < $tablonesTotales ; $j++) { 
							$LimiteTablones++;
							if($LimiteTablones < 4){
								$tablonActual++;
								?>
								<div class="tablon">
									<div class="imagen" id="imagenTablon">
										<?php
											if($tablones[$j] -> obtener_IMAGEN() !== null){
												$rutaImagen = BD_Tarea::mostrar($tablones[$j] -> obtener_IMAGEN(), 'tablon_imagen', '');
												?>
												<img src="<?php echo self::componer_ruta_self($rutaImagen[1]);?>" alt="<?php echo $rutaImagen[0];?>">
												<?php
											}else{
												?>
												<div class="titulo-imagen" id="#tituloImagen">
													<?php
														echo $tablones[$j] -> obtener_TITULO();
													?>
												</div>
												<?php
											}
										?>
									</div>	
									<div class="hyzher" id="#hyzherTablon">
										<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $tablones[$j] -> obtener_ALIAS());?>"><?php echo $tablones[$j] -> obtener_ALIAS();?></a>
									</div>					
									<div class="autor">
										<div class="fuente" id="#fuenteTablon"><?php if(isset($rutaImagen) && !empty($tablones[$j] -> obtener_IMAGEN())){echo "Fuente: ".$rutaImagen[2];}?></div>
									</div>
									<div class="detalles" id="detalleTablon">
										<div class="subdetalles">
											<div class="sub">Categoria</div>
											<div class="sub"><?php echo $tablones[$j] -> obtener_CATEGORIA();?></div>
										</div>
										<div class="subdetalles">
											<div class="sub">Clasificación</div>
											<div class="sub"><?php echo $tablones[$j] -> obtener_CLASIFICACION();?></div>
										</div>
										<div class="subdetalles">
											<div class="sub2">" <?php echo $tablones[$j] -> obtener_TITULO();?> "</div>
											<div class="sub2"><?php echo $tablones[$j] -> obtener_DESCRIPCION();?></div>
											<div class="sub2"><?php echo self::resumidor($tablones[$j] -> obtener_FAMILIA(),16);?></div>
										</div>
									</div>
									<div class="fecha">
										<div class="cuadrito-derecha"></div>
										<?php
											if($tablones[$j] -> obtener_PERSONAJE() !== null){
												$NomPersonaje =  BD_Tarea::mostrar($tablones[$j] -> obtener_PERSONAJE(),'tablon_personaje', '');
												?>
													<a href="<?php echo HIJOS.'/'.str_replace(' ', '-', $NomPersonaje);?>" class="cuadrito-izquierda"></a>
												<?php
											}
										?>
										<div class="publicado">
											<?php 
												echo self::componer_fecha2($tablones[$j] -> obtener_PROGRAMADA().' 00:00:00', 'fecha_1');
											?>
										</div>
										<?php
											switch ($tablones[$j] -> obtener_PROCESO()) {
												case '20':
													$elProceso = "Las Ideas";
													$colorProceso = "#E0221F";
													break;
												case '40':
													$elProceso = "Lapiz y Goma";
													$colorProceso = "#FF3F05";
													break;
												case '60':
													$elProceso = "Al Público";
													$colorProceso = "#493922";
													break;
												case '80':
													$elProceso = "Actualización 1";
													$colorProceso = "#B08B1C";
													break;
												case '100':
													$elProceso = "Actualización 2";
													$colorProceso = "#07748D";
													break;
												case '120':
													$elProceso = "Actualización 3";
													$colorProceso = "#24A324";
													break;
												default:
													$elProceso = "Mente Privada";
													$colorProceso = "#281123";
											}
										?>
										<div class="proceso" style="<?php echo "background: ".$colorProceso;?>">
											<?php echo $elProceso; ?>
										</div>
										<?php
											if($tablones[$j] -> obtener_PERSONAJE() !== null){
												?>
												<div class="personaje"><?php echo $NomPersonaje;?></div>
												<?php
											}
										?>
									</div>
								</div>
								<?php
							}
						}
					?>
				</span>
				<?php
			}
		}
		return;
	}

	public static function resumidor($texto, $maximo){
		$l_max = $maximo;
		$resultado = null;
		if(strlen($texto) > $l_max){
			for($i = 0; $i <= $l_max; $i++){
				$resultado .= substr($texto, $i, 1);
			}
			$resultado .= "...";
		}else{
			$resultado = $texto;
		}
		$resultado = strip_tags($resultado);
		return $resultado;
	}

}