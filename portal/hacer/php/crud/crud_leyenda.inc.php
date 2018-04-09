<?php
namespace crud_leyenda;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

		use \base_leyenda\leyenda as la_leyenda;
		use \base_personaje\personaje as el_personaje;

class leyenda{
	public static function nuevo($leyenda, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO leyenda(leyenda_hyzher, leyenda_personaje, leyenda_escrito) VALUES(:hyzher, :personaje, :escrito)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $leyenda -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':personaje', $leyenda -> obtener_PERSONAJE(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':escrito', $leyenda -> obtener_ESCRITO(), \PDO::PARAM_STR);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar la leyenda debido a: '.$e;
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
						case 'libre':
							
							break;
					}
				}else{
					switch ($opcion) {
						case 'personaje':
							$sql = 'SELECT id_personaje FROM personaje WHERE id_personaje = :id AND personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'ley_hyzher':
							$sql = 'SELECT id_leyenda FROM leyenda WHERE id_leyenda = :id AND leyenda_hyzher = :hyzher';
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
			echo 'No se pudo validar el Fragmento debido a: '.$e;
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
						case 'lista_personajes':
							$trabajo = [];
							$sql = 'SELECT id_personaje, personaje_nombre FROM personaje WHERE personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_personaje($fila['id_personaje'], '', '', $fila['personaje_nombre'], '', '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'detalles_leyendas':
							$trabajo = null;
							$sql = 'SELECT detalles_leyendas FROM detalles WHERE detalles_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['detalles_leyendas'];
							}
							break;
						case 'leyendas_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_leyendas FROM leyenda WHERE leyenda_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_leyendas'];
							}
							break;
						case 'mostrar_leyendas_activas':
							$trabajo = [];
							$sql = 'SELECT l.id_leyenda, h.hyzher_alias, p.personaje_nombre, l.leyenda_escrito FROM leyenda l INNER JOIN hyzher h ON l.leyenda_hyzher = h.id_hyzher INNER JOIN personaje p ON l.leyenda_personaje = p.id_personaje ORDER BY RAND() LIMIT 0,'.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_leyenda($fila['id_leyenda'], $fila['hyzher_alias'], $fila['personaje_nombre'], $fila['leyenda_escrito']);
								}
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_leyendas':
							$trabajo = [];
							$sql = 'SELECT l.id_leyenda, h.hyzher_alias, p.personaje_nombre, l.leyenda_escrito FROM leyenda l INNER JOIN hyzher h ON l.leyenda_hyzher = h.id_hyzher INNER JOIN personaje p ON l.leyenda_personaje = p.id_personaje WHERE p.personaje_nombre LIKE :nombre AND l.leyenda_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':nombre', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_leyenda($fila['id_leyenda'], $fila['hyzher_alias'], $fila['personaje_nombre'], $fila['leyenda_escrito']);
								}
							}
							break;
						case 'leyenda_ID':
							$trabajo = null;
							$sql = 'SELECT l.id_leyenda, h.hyzher_alias, p.personaje_nombre, l.leyenda_escrito FROM leyenda l INNER JOIN hyzher h ON l.leyenda_hyzher = h.id_hyzher INNER JOIN personaje p ON l.leyenda_personaje = p.id_personaje WHERE l.id_leyenda = :id AND l.leyenda_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new la_leyenda($fila['id_leyenda'], $fila['hyzher_alias'], $fila['personaje_nombre'], $fila['leyenda_escrito']);
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar la leyenda debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($leyenda){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM leyenda WHERE id_leyenda = :id AND leyenda_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $leyenda -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $leyenda -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar la leyenda debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}