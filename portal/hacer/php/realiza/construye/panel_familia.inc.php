<?php
namespace construye_Pfamilia;
	
	require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';

use \crud_blog\blog as BD_Blog;

class familia extends \v_generales{

	public static function generar_panel($NoPaneles, $modo){
		if((isset($modo) && !empty($modo) && (isset($NoPaneles) && $NoPaneles > 0)) ){
			switch ($modo) {
				case 'Global':
					$DatosBlog = BD_Blog::mostrar($NoPaneles, 'obtenerEntradas_familiaGlobal', '');
					break;
				default:
					$DatosBlog = BD_Blog::mostrar($NoPaneles, 'obtenerEntradas_familiaGlobal', '');
					break;
			}
		}else{
			$DatosBlog = BD_Blog::mostrar(9, 'obtenerEntradas_familiaGlobal', '');
		}

		$tamanioPaneles = count($DatosBlog);
		if($tamanioPaneles % 3 != 0){
			$decimalPanel = $tamanioPaneles / 3;
			$redondearPanel = round($decimalPanel);
			if($redondearPanel <= $decimalPanel){
				$widthPanel = ($redondearPanel + 1) * 100;
			}else{
				$widthPanel = $redondearPanel * 100;
			}
		}else{
			$widthPanel = ($tamanioPaneles / 3)*100;
		}
		if(isset($DatosBlog)){
			?>
			<div class="titular-modo1">
				<span id="panelAtras"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
				<div class="titulo">NUESTRAS FAMILIAS</div>
				<span id="panelAdelante"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
			</div>
			<div class="tablon-general" id="PanelesGenerales" style="<?php echo "width:".$widthPanel."%"?>" >
				<?php
					self::construir_panel($DatosBlog, $widthPanel);
				?>
			</div>
			<?php
		}

		if(isset($tamanioPaneles) && $tamanioPaneles > 3){
			?>
			<script>var MovimientoPanel = true;</script>
			<?php
		}else{
			?>
			<script>var MovimientoPanel = false;</script>
			<?php
		}

		?>
		<script>
			function op_entradaFamiliar(Entrada){
				$(document).ready(function(){
				    Galletas.createCookie("entradasFamiliares", "index", "");
				});
				window.location="/"+Entrada;
			}
		</script>
		<?php

	}

	public static function construir_panel($Panel, $Width){
		$panelActual = 0;
		$panelesTotales = count($Panel);
		$numeroCuadros = $Width/100;
		$anchoPanel = 100/($Width/100);

		if(isset($Panel)){
			for ($i=1; $i <= $numeroCuadros ; $i++) { 
				?>
				<span class="cuadros-familiares" style ="<?php echo "width:".$anchoPanel."%"?>">
					<?php
						$LimitePaneles = 0;
						for ($j=$panelActual; $j <$panelesTotales ; $j++) { 
							$LimitePaneles++;
							if($LimitePaneles < 4){
								$panelActual++;
								?>
								<div class="panel">
									<?php
									$parametros = array(0 => $Panel[$j] -> obtener_ID(), 1 => $Panel[$j] -> obtener_FAMILIA());
									$EntradaUno = BD_Blog::mostrar($parametros, 'Entrada_Uno', "");
									?>
									<div class="imagen" onclick="op_entradaFamiliar('<?php echo $EntradaUno;?>')">
										<?php
											if ($Panel[$j] -> obtener_IMAGEN() !== null) {
												$rutaImagen = BD_Blog::mostrar($Panel[$j] -> obtener_IMAGEN(),'imagen_entrada', '');
												?>
												<img src="<?php echo self::componer_ruta_self($rutaImagen[1])?>" alt="<?php echo $rutaImagen[0]?>">
												<?php
											}else{
												?>
												<div class="titulo-imagen">
													<?php
													echo $Panel[$j] -> obtener_FAMILIA();
													?>
												</div>
												<?php
											}
										?>
									</div>
									<div class="hyzher">
										<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $Panel[$j] -> obtener_HYZHER());?>"><?php echo $Panel[$j] -> obtener_HYZHER();?></a>
									</div>
									<div class="detalles">
										<div class="familia"><?php echo self::resumidor($Panel[$j] -> obtener_FAMILIA(),16);?></div>
										<div class="anexos">
											<div class="fecha"><?php echo self::componer_fecha2($Panel[$j] -> obtener_CREADO(), 'fecha_3');?></div>
											<?php $Paquete = BD_Blog::mostrar($Panel[$j]->obtener_FAMILIA(),'numero_paqueteFamiliar','')?>
											<div class="tamanio">"<?php echo $Paquete;?> Entradas"</div>
										</div>
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
