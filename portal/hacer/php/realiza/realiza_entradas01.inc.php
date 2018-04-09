<?php
	namespace realiza_entradas01;

		require_once 'validaciones_generales.inc.php';

use \crud_blog\blog as BD;

class ObtenerEntradas extends \v_generales{

	public static function generar_entrada($mostrar, $comienza, $tipo, $variable){
		if(!empty($variable) && $variable > 0){
			switch ($tipo) {
				case 'Autores':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD::mostrar($parametros, 'obtenerEntradas_autor', $comienza);
					break;
				case 'AutoresXNum':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD::mostrar($parametros, 'obtenerEntradas_autor_XNum', '');
					break;
				case 'Personajes':
					$parametros = array(0 => $mostrar, 1 => $variable);
					$entradas = BD::mostrar($parametros, 'obtenerEntradas_personaje', $comienza);
					break;
				default:
					$entradas = BD::mostrar($mostrar, 'obtenerEntradas_fechaUltima', $comienza);
					break;
			}
		}else{
			$entradas = BD::mostrar($mostrar, 'obtenerEntradas_fechaUltima', $comienza);
		}

		if(count($entradas)){
			foreach ($entradas as $entrada) {
				self::codigo_entrada($entrada);
			}
		}
	}

	public static function codigo_entrada($entrada){
		if(isset($entrada)){
			?>
			<div class="blog">
				<div class="familiares">
					<?php 
						$parametros = array(0 => $entrada -> obtener_HYZHER(), 1 => $entrada -> obtener_FAMILIA());
						$EntradaUno = BD::mostrar($parametros, 'Entrada_Uno', "");
					?>
					<button onclick="op_entradaFamiliar('<?php echo $EntradaUno;?>')"><?php echo $entrada -> obtener_FAMILIA();?></button>
					<?php
						if($entrada -> obtener_INTENTOS() > 1){
							?>
								<span>Actualizado</span>
							<?php
						}
					?>
				</div>
				<div class="entrada">
					<div class="titulo">
						<h3><?php echo $entrada -> obtener_TITULO();?></h3>
					</div>
					<div class="informativo">
						<?php
							$HyzherNombre = BD::mostrar($entrada -> obtener_HYZHER(), 'Nombre_Hyzher', '');
						?>
						<span>
							<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $HyzherNombre);?>">
								<i class="fa fa-user-circle-o" aria-hidden="true"></i>	
								<?php echo " ".self:: resumir_entrada($HyzherNombre, 11);?>
							</a>
						</span>
					</div>
					<article class="contenido">
						<?php echo self:: resumir_entrada($entrada -> obtener_TEXTO(), 300); ?>
					</article>
					<?php
						if($entrada -> obtener_PERSONAJE() != null){
							$PersonajeNombre = BD::mostrar($entrada -> obtener_PERSONAJE(), 'Nombre_Personaje', '');
							?>
							<div class="informativo">
								<span>
									<a href="<?php echo HIJOS.'/'.str_replace(' ', '-', $PersonajeNombre);?>">
										<i class="fa fa-user-secret" aria-hidden="true"></i>
										<?php echo " ".self:: resumir_entrada($PersonajeNombre, 100);?>
									</a>
								</span>
							</div>
							<?php
						}
					?>
					<div class="leer">
						<a href="<?php echo $entrada -> obtener_URL();?>">Leer</a>
					</div>
					<div class="remitente">
						<span><?php echo self::componer_fecha2($entrada -> obtener_CREADO(), 'fecha_1');?></span>
						<div class="comentarios">
						<?php $numComentarios = BD::mostrar($entrada -> obtener_ID(), 'numero_comentarios', '');?>
							<span><b><?php echo $numComentarios;?></b></span>
						</div>
					</div>
					<?php
					if($entrada -> obtener_IMAGEN() != null){
						$rutaImagen = BD::mostrar($entrada -> obtener_IMAGEN(), 'imagen_entrada', '');
						?>
						<div class="imagen">
							<img src="<?php echo self::componer_ruta_self($rutaImagen[1]);?>" alt="<?php echo $rutaImagen[0];?>">
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		return;
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
?>
<script>
	function op_entradaFamiliar(Entrada){
		$(document).ready(function(){
		    Galletas.createCookie("entradasFamiliares", "index", "");
		});
		window.location="/"+Entrada;
	}
</script>