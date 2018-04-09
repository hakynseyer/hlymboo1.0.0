<?php
namespace construye_PUEntradas;

	if(isset($ajaxBuscar) && !empty($ajaxBuscar) && $ajaxBuscar === true){
		require_once '../validaciones_generales.inc.php';
	 	require_once '../../crud/crud_blog.inc.php';
	    require_once '../../base/base_blog.inc.php';
	    require_once '../../base/base_perfil.inc.php';
	    require_once '../../base/base_personaje.inc.php';
	    require_once '../../../../configuraciones/configurador/configurador_rutas.inc.php';
	}else{
		require_once 'portal/hacer/php/realiza/validaciones_generales.inc.php';
	}

use \crud_blog\blog as BD_Blog;

class entradas extends \v_generales{

	public static function general_panel($mostrar, $comienza, $tipo, $variable, $ajax){

		if(!empty($variable) && $variable > 0){
			switch ($tipo) {
				case 'Autores':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD_Blog::mostrar($parametros, 'obtenerEntrada_familiaGlobalOffset_Autor', $comienza);
					break;
				case 'Personajes':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD_Blog::mostrar($parametros, 'obtenerEntrada_familiaGlobalOffset_Personaje', $comienza);
					break;
				case 'Categorias':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD_Blog::mostrar($parametros, 'obtenerEntrada_familiaGlobalOffset_Categoria', $comienza);
					break;
				case 'Clasificaciones':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD_Blog::mostrar($parametros, 'obtenerEntrada_familiaGlobalOffset_Clasificacion', $comienza);
					break;
				default:
					$entradas = BD_Blog::mostrar($mostrar, 'obtenerEntradas_familiaGlobalOffset', $comienza);
					break;
			}
		}else if (!empty($variable) && is_string($variable)){
			switch ($tipo) {
				case 'Familias':
					$parametros = array(0 => $mostrar, 1 => "%".$variable."%");
					$entradas = BD_Blog::mostrar($parametros, 'obtenerEntrada_familiaGlobalOffset_Familias', $comienza);
					break;			
				default:
					$entradas = BD_Blog::mostrar($mostrar, 'obtenerEntradas_familiaGlobalOffset', $comienza);
					break;
			}
		}else{
			$entradas = BD_Blog::mostrar($mostrar, 'obtenerEntradas_familiaGlobalOffset', $comienza);
		}

		if(count($entradas)){

			if(isset($ajax) && !empty($ajax) && $ajax === true){

				$codigo = '';
				ob_start();
				foreach ($entradas as $entrada) {
					self::crear_panel($entrada);
				}
				$codigo = ob_get_clean();
				return $codigo;

			}else{
				foreach ($entradas as $entrada) {
					self::crear_panel($entrada);
				}
			}

		}

	}

	public static function crear_panel($entrada){

		if(isset($entrada)){
			?>
			<div class="panelUE" id="panelesFuturos">
				<div class="laFamilia">
					<?php 
						$parametros = array(0 => $entrada -> obtener_ID(), 1 => $entrada -> obtener_FAMILIA());
						$EntradaUno = BD_Blog::mostrar($parametros, 'Entrada_Uno', "");
					?>
					<button onclick="op_entradaFamiliar('<?php echo $EntradaUno;?>')"><?php echo $entrada -> obtener_FAMILIA();?></button>					
				</div>
				<div class="entrada">
					<?php
						if(!empty($entrada -> obtener_FAMILIA())){
							$TitulosFamilias = BD_Blog::mostrar($entrada -> obtener_FAMILIA(), 'obtenerEntradaFamilias', 'blog_modificado DESC');
						}

						if($entrada -> obtener_INTENTOS() > 1){
							?>
							<div class="estado">Actualizado</div>
							<?php
						}else{
							?>
							<span class="estado">Nuevo</span>
							<?php
						}

					?>
					<a class="casillaIzquierda" href="<?php echo $entrada -> obtener_URL();?>">
						<?php

							if($entrada -> obtener_IMAGEN() !== null){
								$rutaImagen = BD_Blog::mostrar($entrada -> obtener_IMAGEN(),'imagen_entrada', '');
								?>
								<div class="imagen">
									<img src="<?php echo self::componer_ruta_self($rutaImagen[1])?>" alt="<?php echo $rutaImagen[0]?>">
								</div>
								<?php
							}else{
								?>
								<div class="imagen sin-imagen">
									<?php echo $entrada -> obtener_TITULO();?>
								</div>
								<?php
							} 
						?>
						<div class="datos">
							<span><?php echo $entrada -> obtener_TITULO();?></span>
							<span>Categoria</span>
							<span>Clasificación</span>
							<span><?php echo $entrada -> obtener_CATEGORIA();?></span>
							<span><?php echo $entrada -> obtener_CLASIFICACION();?></span>
						</div>
					</a>
					<div class="casillaCentral">
						<div class="familiaPrincipal <?php if(count($TitulosFamilias) <= 1){echo 'pegar';}?>">
							<h2><?php echo $entrada -> obtener_TITULO()?></h2>
							<div class="texto">
								<?php echo self:: resumir_entrada($entrada -> obtener_TEXTO(), 300); ?>	
							</div>
							<div class="detalles">
								<div class="fecha"><?php echo self::componer_fecha2($entrada -> obtener_CREADO(), 'fecha_1');?></div>
								<div class="medallas">
									<?php $numComentarios = BD_Blog::mostrar($entrada -> obtener_ESTADO(), 'numero_comentarios', '');?>
									<span><b><?php echo $numComentarios;?></b></span>
								</div>
							</div>
						</div>
						<?php
							if(!empty($entrada -> obtener_FAMILIA())){

								for ($i=1; $i < count($TitulosFamilias) ; $i++) { 
									if ($i < 6) { //Restar en 1 y el resultado agregarlo en los estilos en $HL-MostrarFamiliasIndex, ejemplo de 6 -> $HL-MostrarFamiliasIndex = 5px;
										?>
											<div class="familia">
												<a href="<?php echo $TitulosFamilias[$i] -> obtener_URL();?>"><?php echo $TitulosFamilias[$i] -> obtener_TITULO();?></a>
												<div class="atributos">
													<?php
														if (!empty($TitulosFamilias[$i] -> obtener_PERSONAJE())) {
															?>
															<span><i class="fa fa-user-secret" aria-hidden="true"></i></span>
															<?php
														}
														$TFcomentarios = BD_Blog::mostrar($entrada -> obtener_ESTADO(), 'numero_comentarios', '');
													?>
													<span class="opiniones"><?php echo $TFcomentarios;?></span>
													<span><?php echo self::componer_fecha2($TitulosFamilias[$i] -> obtener_CREADO(), 'fecha_3');?></span>
												</div>
											</div>
										<?php
									}
								}

							}
						?>
					</div>
					<div class="casillaDerecha">
						<div class="autor">
							<?php echo $entrada -> obtener_HYZHER()?>
						</div>
						<?php
							if(!empty($entrada -> obtener_PERSONAJE())){
								$PersonajeHyzher = BD_Blog::mostrar($entrada -> obtener_PERSONAJE(), 'personajeX1', '');
								?>
								<a class="iconoPersonaje" href="<?php echo HIJOS.'/'.str_replace(' ', '-', $PersonajeHyzher -> obtener_NOMBRE());?>">
									<i class="fa fa-user-secret" aria-hidden="true"></i>
								</a>
								<?php
							}

							$PerfilHyzher = BD_Blog::mostrar($entrada -> obtener_ID(), 'perfil_hyzherX1', '');
							if(!empty($PerfilHyzher)){
								?>
								<a class="imagen" href="<?php echo AUTORES.'/'.str_replace(' ', '-', $entrada -> obtener_HYZHER())?>">
									<?php
									$imagenHyzher = BD_Blog::mostrar($PerfilHyzher -> obtener_IMAGEN(), 'imagen_entrada', '');
									if(count($imagenHyzher)){
										?>
										<img src="<?php echo self::componer_ruta_self($imagenHyzher[1])?>" alt="<?php echo $imagenHyzher[0]?>">
										<?php
									}else{
										?>
										<i class="fa fa-user-circle-o" aria-hidden="true"></i>
										<?php
									}

									if(!empty($PerfilHyzher -> obtener_ETIQUETA())){
										?>
										<div class="rango"><?php echo $PerfilHyzher -> obtener_ETIQUETA();?></div>
										<?php
									}else{
										?>
										<div class="rango">Autor</div>
										<?php
									}
									?>
								</a>
								<?php
							}else{
								?>
								<div class="imagen">
									<i class="fa fa-user-circle-o" aria-hidden="true"></i>
									<div class="rango">Autor</div>
								</div>
								<?php
							}
						?>
						<div class="social">
							<?php
								if(isset($PerfilHyzher) && !empty($PerfilHyzher)){
									if(!empty($PerfilHyzher -> obtener_SOCIAL1())){
										?>
										<a href="<?php echo $PerfilHyzher -> obtener_SOCIAL1()?>" target="_blank" class="icoFacebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
										<?php
									}
									if(!empty($PerfilHyzher -> obtener_SOCIAL2())){
										?>
										<a href="<?php echo $PerfilHyzher -> obtener_SOCIAL2()?>" target="_blank" class="icoTwitter"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a>
										<?php
									}
									if(!empty($PerfilHyzher -> obtener_SOCIAL3())){
										?>
										<a href="<?php echo $PerfilHyzher -> obtener_SOCIAL3()?>" target="_blank" class="icoYoutube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
										<?php
									}
									if(!empty($PerfilHyzher -> obtener_SOCIAL4())){
										?>
										<a href="<?php echo $PerfilHyzher -> obtener_SOCIAL4()?>" target="_blank" class="icoWeb"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
										<?php
									}
								}
							?>
						</div>
						<?php
							if(!empty($entrada -> obtener_PERSONAJE())){
								?>
								<div class="panelOculto">
									<div class="personaje">
									
									</div>
									<a class="imagen" href="<?php echo HIJOS.'/'.str_replace(' ', '-', $PersonajeHyzher -> obtener_NOMBRE());?>">
										<?php
										$imagenPersonaje = BD_Blog::mostrar($PersonajeHyzher -> obtener_IMAGEN(), 'imagen_entrada', '');
										if(count($imagenPersonaje)){
											?>
											<img src="<?php echo self::componer_ruta_self($imagenPersonaje[1])?>" alt="<?php echo $imagenPersonaje[0]?>">
											<?php
										}else{
											?>
											<i class="fa fa-user-circle-o" aria-hidden="true"></i>
											<?php
										}
										?>
										<div class="rango">Personaje</div>
									</a>
									<div class="social personaje"><?php echo $PersonajeHyzher -> obtener_NOMBRE();?></div>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
			<?php
		}

	}

	public static function resumir_entrada($texto, $maximo){
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
		$resultado = strip_tags($resultado,'<p>');
		return $resultado;
	}

}