<?php
namespace entradas_resumidas;

	use \crud_blog\blog as BD;

class resumidas{
	public static function paginador($numeroActual, $numeroMostrados, $autor, $tipo, $numeroEntradas){
		if(isset($numeroEntradas) && !empty($numeroEntradas) && $numeroEntradas > 0){
			$numeroEntradas = $numeroEntradas;
		}else{
			if(!empty($autor) && $autor > 0){
				switch ($tipo) {
					case 'Autores':
						$numeroEntradas = BD::mostrar($autor, 'BlogsHyzherActivos', '');
						break;
					case 'Personajes':
						$numeroEntradas = BD::mostrar($autor, 'BlogsPersonajesActivos', '');
						break;
					case 'FamiliaresTotalesXAutor':
						$numeroEntradas = BD::mostrar($autor, 'BlogsFamiliasTotalesActivosXAutor', '');
						break;
					case 'FamiliasTotalesXPersonaje':
						$numeroEntradas = BD::mostrar($autor, 'BlogsFamiliasTotalesActivosXPersonaje', '');
						break;
					default:
						$numeroEntradas = BD::mostrar('','NumeroBlogsActivos','');
						break;
				}
			}else{
				switch ($tipo) {
					case 'FamiliaresTotales':
						$numeroEntradas = BD::mostrar('', 'BlogsFamiliasTotalesActivos', '');
						break;					
					default:
						$numeroEntradas = BD::mostrar('','NumeroBlogsActivos','');
						break;
				}
			}
		}
		$numeroPaginacion = ceil($numeroEntradas / $numeroMostrados)-1;
		$numeroOffset = $numeroActual * $numeroMostrados;

		return $numerandos = array(0 => $numeroOffset, 1 => $numeroPaginacion, 2 => $numeroEntradas);
	}

	public static function generarPaginador($numeroActual, $numeroPaginacion, $LimiteBotones, $link){
		?>
		<div class="paginador">
			<?php
				if($numeroActual > 0){
					?>
					<a href="<?php echo $link.'?Pg=0';?>">Primera</a>
					<?php
				}	
				$contador = $numeroActual;
				for ($i=1; $i <= $LimiteBotones ; $i++) { 
					if($contador <= $numeroPaginacion){
						if($contador !== 0){
							?>
							<a href="<?php echo $link.'?Pg='.$contador;?>"><?php echo $contador?></a>
							<?php
						}	
						$contador++;
					}
				}
				if($numeroActual < $numeroPaginacion){
					?>
					<a href="<?php echo $link.'?Pg='.$numeroActual = $numeroActual+1;?>">Adelante</a>
					<?php
				}
			?>
		</div>
		<?php
		return;
	}
}