<?php
namespace crud_perfil;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_perfil\perfil as el_perfil;
	use \base_imagen\imagen as la_imagen;
	use \base_fragmento\fragmento as el_fragmento;
	use \base_hyzher\hyzher as el_hyzher;
	use \base_personaje\personaje as el_personaje;

class perfil{
	public static function nuevo($perfil, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'perfil':
						$sql = 'INSERT INTO perfil(perfil_hyzher, perfil_nacimiento, perfil_lugar, perfil_soy, perfil_estado) VALUES(:hyzher, :nacimiento, :lugar, :soy, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':nacimiento', $perfil -> obtener_NACIMIENTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':lugar', $perfil -> obtener_LUGAR(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':soy', $perfil -> obtener_SOY(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el perfil debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function validar($buscar, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				if (!is_array($buscar)) {
					switch ($opcion) {
						case 'imagen':
							$sql = 'SELECT id_imagen FROM imagen WHERE id_imagen = :imagen';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':imagen', $buscar, \PDO::PARAM_INT);
							break;
						case 'fragmento':
							$sql = 'SELECT id_fragmento FROM fragmento WHERE id_fragmento = :fragmento';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':fragmento', $buscar, \PDO::PARAM_INT);
							break;
						case 'hyzher':
							$sql = 'SELECT perfil_hyzher FROM perfil WHERE perfil_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							break;
					}
				}else{
					switch ($opcion) {
						case 'social1':
							$sql = 'SELECT perfil_social1 FROM perfil WHERE ( perfil_social1 = :social OR perfil_social2 = :social OR perfil_social3 = :social OR perfil_social4 = :social) AND perfil_hyzher <> :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':social', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'social2':
							$sql = 'SELECT perfil_social2 FROM perfil WHERE ( perfil_social2 = :social OR perfil_social3 = :social OR perfil_social4 = :social OR perfil_social1 = :social ) AND perfil_hyzher <> :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':social', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'social3':
							$sql = 'SELECT perfil_social3 FROM perfil WHERE ( perfil_social3 = :social OR perfil_social4 = :social OR perfil_social1 = :social OR perfil_social2 = :social ) AND perfil_hyzher <> :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':social', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'social4':
							$sql = 'SELECT perfil_social4 FROM perfil WHERE ( perfil_social4 = :social OR perfil_social1 = :social OR perfil_social2 = :social OR perfil_social3 = :social ) AND perfil_hyzher <> :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':social', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'id_perfil':
							$sql = 'SELECT id_perfil FROM perfil WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
					}
				}
			}
			if (isset($sql)) {
				$ejecuta -> execute();
				$respuesta = $ejecuta -> fetch();
				if (!empty($respuesta)) {
					$trabajo = true;
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo validar el perfil debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function mostrar($buscar, $opcion, $ordenar){
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				if (!is_array($buscar)) {
					switch ($opcion) {
						case 'tabla_perfil':
							$trabajo = null;
							$sql = 'SELECT * FROM perfil WHERE perfil_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_perfil($fila['id_perfil'], $fila['perfil_hyzher'], $fila['perfil_imagen'], $fila['perfil_fragmento'], $fila['perfil_nacimiento'], $fila['perfil_lugar'], $fila['perfil_soy'], $fila['perfil_social1'], $fila['perfil_social2'], $fila['perfil_social3'], $fila['perfil_social4'], $fila['perfil_etiqueta'], $fila['perfil_estado']);
							}
							break;
						case 'tabla_perfil2':
							$trabajo = [];
							$sql = 'SELECT p.id_perfil, p.perfil_hyzher, h.hyzher_alias, g.grado_tipo, p.perfil_etiqueta, p.perfil_estado FROM perfil p INNER JOIN hyzher h ON p.perfil_hyzher = h.id_hyzher INNER JOIN grado g ON h.hyzher_grado = g.id_grado WHERE h.hyzher_alias LIKE :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_perfil($fila['id_perfil'], $fila['perfil_hyzher'], $fila['hyzher_alias'], $fila['grado_tipo'], '', '', '', '', '', '', '', $fila['perfil_etiqueta'], $fila['perfil_estado']);
								}
							}
							break;
						case 'perfil_ID':
							$trabajo = null;
							$sql = 'SELECT * FROM perfil WHERE id_perfil = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_perfil($fila['id_perfil'], $fila['perfil_hyzher'], $fila['perfil_imagen'], $fila['perfil_fragmento'], $fila['perfil_nacimiento'], $fila['perfil_lugar'], $fila['perfil_soy'], $fila['perfil_social1'], $fila['perfil_social2'], $fila['perfil_social3'], $fila['perfil_social4'], $fila['perfil_etiqueta'], $fila['perfil_estado']);
							}
							break;
						case 'mis_imagenes':
							$trabajo = [];
							$sql = 'SELECT id_imagen, imagen_titulo, imagen_familia, imagen_ruta, imagen_fuente, imagen_notas, imagen_creado FROM imagen WHERE imagen_hyzher = :hyzher AND imagen_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_imagen($fila['id_imagen'], '', $fila['imagen_titulo'], $fila['imagen_familia'], $fila['imagen_ruta'], $fila['imagen_fuente'], $fila['imagen_notas'], $fila['imagen_creado'], '', '', '');
								}
							}
							break;
						case 'mis_fragmentos':
							$trabajo = [];
							$sql = 'SELECT id_fragmento, fragmento_titulo FROM fragmento WHERE fragmento_hyzher = :hyzher AND fragmento_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_fragmento($fila['id_fragmento'], '', $fila['fragmento_titulo'], '', '', '', '', '', '');
								}
							}
							break;
						case 'hoja_autor':
							$trabajo = null;
							$sql = 'SELECT p.perfil_imagen, p.perfil_fragmento, p.perfil_nacimiento, p.perfil_lugar, p.perfil_soy, p.perfil_social1, p.perfil_social2, p.perfil_social3, p.perfil_social4, p.perfil_etiqueta FROM perfil p INNER JOIN hyzher h ON p.perfil_hyzher = h.id_hyzher WHERE h.hyzher_alias LIKE :hyzher AND p.perfil_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_perfil('', '', $fila['perfil_imagen'], $fila['perfil_fragmento'], $fila['perfil_nacimiento'], $fila['perfil_lugar'], $fila['perfil_soy'], $fila['perfil_social1'], $fila['perfil_social2'], $fila['perfil_social3'], $fila['perfil_social4'], $fila['perfil_etiqueta'], '');
							}
							break;
						case 'imagen_perfil':
							$trabajo = [];
							$sql = 'SELECT imagen_ruta, imagen_titulo, imagen_fuente FROM imagen WHERE id_imagen = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(count($fila)){
								$trabajo[0] = $fila['imagen_ruta'];
								$trabajo[1] = $fila['imagen_titulo'];
								$trabajo[2] = $fila['imagen_fuente'];
							}
							break;
						case 'hoja_autor2':
							$trabajo = null;
							$sql = 'SELECT h.id_hyzher, h.hyzher_nombre, g.grado_tipo, h.hyzher_creado FROM hyzher h INNER JOIN grado g ON h.hyzher_grado = g.id_grado WHERE h.hyzher_alias LIKE :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_hyzher($fila['id_hyzher'], $fila['hyzher_nombre'], '', '', $fila['grado_tipo'], '', '', '', '', '', $fila['hyzher_creado'], '', '');
							}
							break;
						case 'num_entradas':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) as total FROM blog WHERE blog_hyzher = :hyzher AND blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = $fila['total'];
							}
							break;
						case 'num_opiniones':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) as total FROM opinion o INNER JOIN blog b ON o.opinion_blog =  b.id_blog WHERE b.blog_hyzher = :hyzher AND o.opinion_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = $fila['total'];
							}
							break;
						case 'familia_personajes':
							$trabajo = [];
							$sql = 'SELECT personaje_nombre, personaje_familia FROM personaje WHERE personaje_hyzher = :hyzher GROUP BY personaje_familia';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$respuesta = $ejecuta -> fetchAll();
							if(count($respuesta)){
								foreach ($respuesta as $fila) {
									$trabajo[] = new el_personaje('', '', '', $fila['personaje_nombre'], $fila['personaje_familia'], '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'num_hijos':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) as total FROM personaje WHERE personaje_hyzher = :hyzher AND personaje_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = $fila['total'];
							}
							break;
						case 'etiquetas_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM perfil';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'perfil2_ID':
							$trabajo = null;
							$sql = 'SELECT p.id_perfil, p.perfil_hyzher, h.hyzher_alias, p.perfil_lugar, p.perfil_soy, p.perfil_etiqueta, p.perfil_estado FROM perfil p INNER JOIN hyzher h ON p.perfil_hyzher = h.id_hyzher  WHERE p.id_perfil = :id AND p.perfil_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_perfil($fila['id_perfil'], $fila['perfil_hyzher'], $fila['hyzher_alias'], '', '', $fila['perfil_lugar'], $fila['perfil_soy'], '', '', '', '', $fila['perfil_etiqueta'], $fila['perfil_estado']);
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el perfil debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($perfil, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'imagen':
						$sql = 'UPDATE perfil SET perfil_imagen = :imagen WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':imagen', $perfil -> obtener_IMAGEN(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'social':
						$sql = 'UPDATE perfil SET perfil_fragmento = :fragmento, perfil_social1 = :social1, perfil_social2 = :social2, perfil_social3 = :social3, perfil_social4 = :social4 WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':fragmento', $perfil -> obtener_FRAGMENTO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':social1', $perfil -> obtener_SOCIAL1(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':social2', $perfil -> obtener_SOCIAL2(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':social3', $perfil -> obtener_SOCIAL3(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':social4', $perfil -> obtener_SOCIAL4(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'estado':
						$sql = 'UPDATE perfil SET perfil_estado = :estado WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':estado', $perfil -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'perfil':
						$sql = 'UPDATE perfil SET perfil_nacimiento = :nacimiento, perfil_lugar = :lugar, perfil_soy = :soy WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':nacimiento', $perfil -> obtener_NACIMIENTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':lugar', $perfil -> obtener_LUGAR(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':soy', $perfil -> obtener_SOY(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'etiqueta':
						$sql = 'UPDATE perfil SET perfil_etiqueta = :etiqueta WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':etiqueta', $perfil -> obtener_ETIQUETA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el perfil debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($perfil, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'perfil':
						$sql = 'DELETE FROM perfil WHERE id_perfil = :id AND perfil_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $perfil -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $perfil -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el perfil debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

}