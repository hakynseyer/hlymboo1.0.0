<?php
namespace crud_hyzher;
	require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';

	use \base_hyzher\hyzher as sujeto;

class hyzher{
	public static function nuevo($hyzher, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'hyzher':
						$sql = 'INSERT INTO hyzher (hyzher_nombre, hyzher_alias, hyzher_email, hyzher_grado, hyzher_llave, hyzher_pregunta1, hyzher_respuesta1, hyzher_pregunta2, hyzher_respuesta2, hyzher_creado, hyzher_modificado, hyzher_estado) VALUES(:nombre, :alias, :email, 1, :llave, :pregunta1, :respuesta1, :pregunta2, :respuesta2, NOW(), NOW(), 1)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':nombre', $hyzher -> obtener_NOMBRE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':alias', $hyzher -> obtener_ALIAS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':email', $hyzher -> obtener_EMAIL(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':llave', $hyzher -> obtener_LLAVE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':pregunta1', $hyzher -> obtener_PREGUNTA1(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':respuesta1', $hyzher -> obtener_RESPUESTA1(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':pregunta2', $hyzher -> obtener_PREGUNTA2(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':respuesta2', $hyzher -> obtener_RESPUESTA2(), \PDO::PARAM_STR);
						break;
					case 'detalles':
						$sql = 'INSERT INTO detalles (detalles_hyzher, detalles_fragmentos, detalles_personajes, detalles_tareas, detalles_leyendas, detalles_prestigio) VALUES(:hyzher, 3, 2, 4, 2, 0.00)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $hyzher -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'ingreso':
						$sql = 'UPDATE ingreso SET ingreso_estado = 1 WHERE ingreso_email = :email';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':email', $hyzher -> obtener_EMAIL(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo crear el Hyzher debido a: '.$e;
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
						case 'alias':
							$sql = 'SELECT hyzher_alias FROM hyzher WHERE hyzher_alias = :alias';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar, \PDO::PARAM_STR);
							break;
						case 'email':
							$sql = 'SELECT hyzher_email FROM hyzher WHERE hyzher_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							break;
						case 'email_ingreso':
							$sql = 'SELECT ingreso_email FROM ingreso WHERE ingreso_email = :email AND ingreso_estado = 0';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							break;
					}
				}else{
					switch ($opcion) {
						case 'hyzher_hyzher':
							$sql = 'SELECT id_hyzher FROM hyzher WHERE id_hyzher = :id AND hyzher_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':email', $buscar[1], \PDO::PARAM_STR);
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
			echo 'No se pudo validar el Hyzher debido a: '.$e;
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
						case 'acceso':
							$trabajo = null;
							$sql = 'SELECT id_hyzher, hyzher_alias, hyzher_email, hyzher_llave FROM hyzher WHERE hyzher_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new sujeto($fila['id_hyzher'],
									'', $fila['hyzher_alias'],
									$fila['hyzher_email'], '',
									$fila['hyzher_llave'], '',
									'', '',
									'',	'',
									'', '');
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'hyzher':
							$trabajo = null;
							$sql = 'SELECT h.hyzher_id, h.hyzher_nombre, h.hyzher_alias, h.hyzher_email, g.grado_tipo, h.hyzher_llave, h.hyzher_pregunta1, h.hyzher_respuesta1, h.hyzher_pregunta2, h.hyzher_respuesta2, h.hyzher_creado, h.hyzher_modificado, h.hyzher_estado FROM hyzher h INNER JOIN grado g ON h.hyzher_grado = g.id_grado WHERE h.hyzher_alias = :alias AND h.hyzher_email = :email ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':email', $buscar[1], \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new sujeto($fila['id_hyzher'],
									$fila['hyzher_nombre'], $fila['hyzher_alias'],
									$fila['hyzher_email'], $fila['grado_tipo'],
									$fila['hyzher_llave'], $fila['hyzher_pregunta1'],
									$fila['hyzher_respuesta1'], $fila['hyzher_pregunta2'],
									$fila['hyzher_respuesta2'],	$fila['hyzher_creado'],
									$fila['hyzher_modificado'], $fila['hyzher_estado']);
							}
							break;
						case 'id_hyzher':
							$trabajo = null;
							$sql = 'SELECT id_hyzher FROM hyzher WHERE hyzher_alias = :alias AND hyzher_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':email', $buscar[1], \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['id_hyzher'];
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el Hyzher debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}