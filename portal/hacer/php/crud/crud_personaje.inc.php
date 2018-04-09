<?php
namespace crud_personaje;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_personaje\personaje as el_personaje;
	use \base_imagen\imagen as la_imagen;

class personaje{
	public static function nuevo($personaje, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO personaje (personaje_hyzher, personaje_imagen, personaje_nombre, personaje_familia, personaje_edad, personaje_sexo, personaje_relacion, personaje_personalidad, personaje_historia, personaje_metas, personaje_extras, personaje_creado, personaje_modificado, personaje_intentos, personaje_estado) VALUES(:hyzher, :imagen, :nombre, :familia, :edad, :sexo, :relacion, :personalidad, :historia, :metas, :extras, NOW(), NOW(), 0, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $personaje -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':imagen', $personaje -> obtener_IMAGEN(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':nombre', $personaje -> obtener_NOMBRE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familia', $personaje -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':edad', $personaje -> obtener_EDAD(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':sexo', $personaje -> obtener_SEXO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':relacion', $personaje -> obtener_RELACION(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':personalidad', $personaje -> obtener_PERSONALIDAD(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':historia', $personaje -> obtener_HISTORIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':metas', $personaje -> obtener_METAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':extras', $personaje -> obtener_EXTRAS(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el personaje debido a: '.$e;
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
						case 'nombre':
							$sql = 'SELECT personaje_nombre FROM personaje WHERE personaje_nombre = :nombre';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':nombre', $buscar, \PDO::PARAM_STR);
							break;
					}
				}else{
					switch ($opcion) {
						case 'per_hyzher':
							$sql = 'SELECT id_personaje FROM personaje WHERE id_personaje = :id AND personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'img_hyzher':
							$sql = 'SELECT id_imagen FROM imagen WHERE id_imagen = :id AND imagen_hyzher = :hyzher';
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
			echo 'No se pudo validar el personaje debido a: '.$e;
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
						case 'personaje_familia':
							$trabajo = [];
							$sql = 'SELECT personaje_familia FROM personaje WHERE personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_personaje('', '', '', '', $fila['personaje_familia'], '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'detalles_personaje':
							$trabajo = null;
							$sql = 'SELECT detalles_personajes FROM detalles WHERE detalles_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['detalles_personajes'];
							}
							break;
						case 'personajes_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_personajes FROM personaje WHERE personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_personajes'];
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
						case 'hoja_personaje':
							$trabajo = null;
							$sql = 'SELECT p.id_personaje, h.hyzher_alias, p.personaje_imagen, p.personaje_familia, p.personaje_edad, p.personaje_sexo, p.personaje_relacion, p.personaje_personalidad, p.personaje_historia, p.personaje_metas, p.personaje_extras, p.personaje_creado FROM personaje p INNER JOIN hyzher h ON p.personaje_hyzher = h.id_hyzher WHERE p.personaje_nombre LIKE :personaje AND p.personaje_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':personaje', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_personaje($fila['id_personaje'], $fila['hyzher_alias'], $fila['personaje_imagen'], '', $fila['personaje_familia'], $fila['personaje_edad'], $fila['personaje_sexo'], $fila['personaje_relacion'], $fila['personaje_personalidad'], $fila['personaje_historia'], $fila['personaje_metas'], $fila['personaje_extras'], $fila['personaje_creado'], '', '', '');
							}
							break;
						case 'imagen_personaje':
							$trabajo = [];
							$sql = 'SELECT imagen_ruta, imagen_titulo FROM imagen WHERE id_imagen = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo[0] = $fila['imagen_ruta'];
								$trabajo[1] = $fila['imagen_titulo'];
							}
							break;
						case 'personajes_familiares':
							$trabajo = [];
							$sql = 'SELECT personaje_nombre FROM personaje WHERE personaje_familia = :familia';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_personaje('', '', '', $fila['personaje_nombre'], '', '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_personajes':
							$trabajo = [];
							$sql = 'SELECT p.id_personaje, h.hyzher_alias, p.personaje_imagen, p.personaje_nombre, p.personaje_familia, p.personaje_edad, p.personaje_sexo, p.personaje_relacion, p.personaje_personalidad, p.personaje_historia, p.personaje_metas, p.personaje_extras, p.personaje_creado, p.personaje_modificado, p.personaje_intentos, p.personaje_estado FROM personaje p INNER JOIN hyzher h ON p.personaje_hyzher = h.id_hyzher WHERE p.personaje_nombre LIKE :nombre AND p.personaje_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':nombre', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[]  = new el_personaje($fila['id_personaje'], $fila['hyzher_alias'], $fila['personaje_imagen'], $fila['personaje_nombre'], $fila['personaje_familia'], $fila['personaje_edad'], $fila['personaje_sexo'], $fila['personaje_relacion'], $fila['personaje_personalidad'], $fila['personaje_historia'], $fila['personaje_metas'], $fila['personaje_extras'], $fila['personaje_creado'], $fila['personaje_modificado'], $fila['personaje_intentos'], $fila['personaje_estado']);
								}
							}
							break;
						case 'personaje_ID':
							$trabajo = null;
							$sql = 'SELECT p.id_personaje, h.hyzher_alias, p.personaje_imagen, p.personaje_nombre, p.personaje_familia, p.personaje_edad, p.personaje_sexo, p.personaje_relacion, p.personaje_personalidad, p.personaje_historia, p.personaje_metas, p.personaje_extras, p.personaje_creado, p.personaje_modificado, p.personaje_intentos, p.personaje_estado FROM personaje p INNER JOIN hyzher h ON p.personaje_hyzher = h.id_hyzher WHERE p.id_personaje = :id AND p.personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_personaje($fila['id_personaje'], $fila['hyzher_alias'], $fila['personaje_imagen'], $fila['personaje_nombre'], $fila['personaje_familia'], $fila['personaje_edad'], $fila['personaje_sexo'], $fila['personaje_relacion'], $fila['personaje_personalidad'], $fila['personaje_historia'], $fila['personaje_metas'], $fila['personaje_extras'], $fila['personaje_creado'], $fila['personaje_modificado'], $fila['personaje_intentos'], $fila['personaje_estado']);
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el personaje debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($personaje, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar':
						$sql = 'UPDATE personaje SET personaje_imagen = :imagen, personaje_familia = :familia, personaje_edad = :edad, personaje_sexo = :sexo, personaje_relacion = :relacion, personaje_personalidad = :personalidad, personaje_historia = :historia, personaje_metas = :metas, personaje_extras = :extras, personaje_modificado = NOW(), personaje_intentos = personaje_intentos + 1, personaje_estado = :estado WHERE id_personaje = :id AND personaje_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':imagen', $personaje -> obtener_IMAGEN(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':familia', $personaje -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':edad', $personaje -> obtener_EDAD(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':sexo', $personaje -> obtener_SEXO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':relacion', $personaje -> obtener_RELACION(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':personalidad', $personaje -> obtener_PERSONALIDAD(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':historia', $personaje -> obtener_HISTORIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':metas', $personaje -> obtener_METAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':extras', $personaje -> obtener_EXTRAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $personaje -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $personaje -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $personaje -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el personaje debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($personaje){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM personaje WHERE id_personaje = :id AND personaje_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $personaje -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $personaje -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el personaje debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}