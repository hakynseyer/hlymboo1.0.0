<?php
namespace crud_archivo;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_archivo\archivo as el_archivo;

class archivo{
	public static function nuevo($archivo, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO archivo(archivo_hyzher, archivo_titulo, archivo_familia, archivo_ruta, archivo_derechos, archivo_notas, archivo_creado, archivo_modificado, archivo_intentos, archivo_estado) VALUES(:hyzher, :titulo, :familia, :ruta, :derechos, :notas, NOW(), NOW(), 0, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $archivo -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':titulo', $archivo -> obtener_TITULO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familia', $archivo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':ruta', $archivo -> obtener_RUTA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':derechos', $archivo -> obtener_DERECHOS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':notas', $archivo -> obtener_NOTAS(), \PDO::PARAM_STR);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el archivo debido a: '.$e;
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
							$sql = 'SELECT archivo_titulo FROM archivo WHERE archivo_titulo = :titulo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar, \PDO::PARAM_STR);
							break;
						case 'ruta':
							$sql = 'SELECT archivo_ruta FROM archivo WHERE archivo_ruta = :ruta';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':ruta', $buscar, \PDO::PARAM_STR);
							break;
					}
				}else{
					switch ($opcion) {
						case 'arch_hyzher':
							$sql = 'SELECT id_archivo FROM archivo WHERE id_archivo = :id AND archivo_hyzher = :hyzher';
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
			echo 'No se pudo validar el archivo debido a: '.$e;
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
						case 'archivo_familia':
							$trabajo = [];
							$sql = 'SELECT archivo_familia FROM archivo WHERE archivo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_archivo('', '', '', $fila['archivo_familia'], '', '', '', '', '', '', '');
								}
							}
							break;
						case 'archivos_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_archivos FROM archivo WHERE archivo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_archivos'];
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_archivos':
							$trabajo = [];
							$sql = 'SELECT a.id_archivo, h.hyzher_alias, a.archivo_titulo, a.archivo_familia, a.archivo_ruta, a.archivo_derechos, a.archivo_notas, a.archivo_creado, a.archivo_modificado, a.archivo_intentos, a.archivo_estado FROM archivo a INNER JOIN hyzher h ON a.archivo_hyzher = h.id_hyzher WHERE a.archivo_titulo LIKE :titulo AND a.archivo_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_archivo($fila['id_archivo'], $fila['hyzher_alias'], $fila['archivo_titulo'], $fila['archivo_familia'], $fila['archivo_ruta'], $fila['archivo_derechos'], $fila['archivo_notas'], $fila['archivo_creado'], $fila['archivo_modificado'], $fila['archivo_intentos'], $fila['archivo_estado']);
								}
							}
							break;
						case 'archivo_ID':
							$trabajo = null;
							$sql = 'SELECT a.id_archivo, h.hyzher_alias, a.archivo_titulo, a.archivo_familia, a.archivo_ruta, a.archivo_derechos, a.archivo_notas, a.archivo_creado, a.archivo_modificado, a.archivo_intentos, a.archivo_estado FROM archivo a INNER JOIN hyzher h ON a.archivo_hyzher = h.id_hyzher WHERE a.id_archivo = :id AND a.archivo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_archivo($fila['id_archivo'], $fila['hyzher_alias'], $fila['archivo_titulo'], $fila['archivo_familia'], $fila['archivo_ruta'], $fila['archivo_derechos'], $fila['archivo_notas'], $fila['archivo_creado'], $fila['archivo_modificado'], $fila['archivo_intentos'], $fila['archivo_estado']);
							}
							break;
						case 'ruta_envio':
							$trabajo = null;
							$sql = 'SELECT archivo_ruta FROM archivo WHERE id_archivo = :id AND archivo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['archivo_ruta'];
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el archivo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($archivo, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar':
						$sql = 'UPDATE archivo SET archivo_familia = :familia, archivo_derechos = :derechos, archivo_notas = :notas, archivo_modificado = NOW(), archivo_intentos = archivo_intentos + 1, archivo_estado = :estado WHERE id_archivo = :id AND archivo_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':familia', $archivo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':derechos', $archivo -> obtener_DERECHOS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':notas', $archivo -> obtener_NOTAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $archivo -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $archivo -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $archivo -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el archivo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($archivo){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM archivo WHERE id_archivo = :id AND archivo_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $archivo -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $archivo -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el archivo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}