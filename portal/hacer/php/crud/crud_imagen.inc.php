<?php
namespace crud_imagen;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_imagen\imagen as la_imagen;

class imagen{
	public static function nuevo($imagen, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO imagen(imagen_hyzher, imagen_titulo, imagen_familia, imagen_ruta, imagen_fuente, imagen_notas, imagen_creado, imagen_modificado, imagen_intentos, imagen_estado) VALUES(:hyzher, :titulo, :familia, :ruta, :fuente, :notas, NOW(), NOW(), 0, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $imagen -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':titulo', $imagen -> obtener_TITULO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familia', $imagen -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':ruta', $imagen -> obtener_RUTA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':fuente', $imagen -> obtener_FUENTE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':notas', $imagen -> obtener_NOTAS(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar la imagen debido a: '.$e;
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
						case 'titulo':
							$sql = 'SELECT imagen_titulo FROM imagen WHERE imagen_titulo = :titulo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar, \PDO::PARAM_STR);
							break;
						case 'ruta':
							$sql = 'SELECT imagen_ruta FROM imagen WHERE imagen_ruta = :ruta';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':ruta', $buscar, \PDO::PARAM_STR);
							break;
					}
				}else{
					switch ($opcion) {
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
			echo 'No se pudo validar la imagen debido a: '.$e;
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
						case 'imagen_familia':
							$trabajo = [];
							$sql = 'SELECT imagen_familia FROM imagen WHERE imagen_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_imagen('', '', '', $fila['imagen_familia'], '', '', '', '', '', '', '');
								}
							}
							break;
						case 'imagenes_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_imagenes FROM imagen WHERE imagen_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_imagenes'];
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_imagenes':
							$trabajo = [];
							$sql = 'SELECT i.id_imagen, h.hyzher_alias, i.imagen_titulo, i.imagen_familia, i.imagen_ruta, i.imagen_fuente, i.imagen_notas, i.imagen_creado, i.imagen_modificado, i.imagen_intentos, i.imagen_estado FROM imagen i INNER JOIN hyzher h ON i.imagen_hyzher = h.id_hyzher WHERE i.imagen_titulo LIKE :titulo AND i.imagen_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[]  = new la_imagen($fila['id_imagen'], $fila['hyzher_alias'], $fila['imagen_titulo'], $fila['imagen_familia'], $fila['imagen_ruta'], $fila['imagen_fuente'], $fila['imagen_notas'], $fila['imagen_creado'], $fila['imagen_modificado'], $fila['imagen_intentos'], $fila['imagen_estado']);
								}
							}
							break;
						case 'imagen_ID':
							$trabajo = null;
							$sql = 'SELECT i.id_imagen, h.hyzher_alias, i.imagen_titulo, i.imagen_familia, i.imagen_ruta, i.imagen_fuente, i.imagen_notas, i.imagen_creado, i.imagen_modificado, i.imagen_intentos, i.imagen_estado FROM imagen i INNER JOIN hyzher h ON i.imagen_hyzher = h.id_hyzher WHERE i.id_imagen = :id AND i.imagen_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new la_imagen($fila['id_imagen'], $fila['hyzher_alias'], $fila['imagen_titulo'], $fila['imagen_familia'], $fila['imagen_ruta'], $fila['imagen_fuente'], $fila['imagen_notas'], $fila['imagen_creado'], $fila['imagen_modificado'], $fila['imagen_intentos'], $fila['imagen_estado']);
							}
							break;
						case 'ruta_envio':
							$trabajo = null;
							$sql = 'SELECT imagen_ruta FROM imagen WHERE id_imagen = :id AND imagen_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['imagen_ruta'];
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar la imagen debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($imagen, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar':
						$sql = 'UPDATE imagen SET imagen_familia = :familia, imagen_fuente = :fuente, imagen_notas = :notas, imagen_modificado = NOW(), imagen_intentos = imagen_intentos + 1, imagen_estado = :estado WHERE id_imagen = :id AND imagen_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':familia', $imagen -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':fuente', $imagen -> obtener_FUENTE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':notas', $imagen -> obtener_NOTAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $imagen -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $imagen -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $imagen -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar la imagen debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($imagen){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM imagen WHERE id_imagen = :id AND imagen_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $imagen -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $imagen -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar la imagen debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}