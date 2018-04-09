<?php
namespace crud_detalles;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_detalles\detalles as el_detalle;

class detalles{
	public static function validar($buscar, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				if (!is_array($buscar)) {
					switch ($opcion) {
						case 'detalles_hyzher':
							$sql = 'SELECT id_detalles FROM detalles WHERE id_detalles = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
					}
				}else{
					switch ($opcion) {
						case 'libre':

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
			echo 'No se pudo validar el Detalle debido a: '.$e;
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
						case 'detalles_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM detalles';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'tabla_detalles':
							$trabajo = [];
							$sql = 'SELECT d.id_detalles, h.hyzher_alias, d.detalles_fragmentos, d.detalles_fragmentos, d.detalles_personajes, d.detalles_tareas, d.detalles_leyendas, d.detalles_prestigio FROM detalles d INNER JOIN hyzher h ON d.detalles_hyzher = h.id_hyzher WHERE h.hyzher_alias LIKE :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_detalle($fila['id_detalles'],
										$fila['hyzher_alias'],$fila['detalles_fragmentos'],
										$fila['detalles_personajes'],$fila['detalles_tareas'],
										$fila['detalles_leyendas'],$fila['detalles_prestigio']);
								}
							}
							break;
						case 'detalles_ID':
							$trabajo = null;
							$sql = 'SELECT d.id_detalles, h.hyzher_alias, d.detalles_fragmentos, d.detalles_fragmentos, d.detalles_personajes, d.detalles_tareas, d.detalles_leyendas, d.detalles_prestigio FROM detalles d INNER JOIN hyzher h ON d.detalles_hyzher = h.id_hyzher WHERE d.id_detalles = :id';

							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_detalle($fila['id_detalles'],
									$fila['hyzher_alias'],$fila['detalles_fragmentos'],
									$fila['detalles_personajes'],$fila['detalles_tareas'],
									$fila['detalles_leyendas'],$fila['detalles_prestigio']);		
							}
							break;
					}
				}else{
					switch ($opcion) {						
						case 'Libre':

							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el Detalle debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($detalles, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar_detalles':
						$sql = 'UPDATE detalles SET detalles_fragmentos = :fragmentos, detalles_personajes = :personajes, detalles_tareas = :tareas, detalles_leyendas = :leyendas WHERE id_detalles = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':fragmentos', $detalles -> obtener_FRAGMENTOS(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':personajes', $detalles -> obtener_PERSONAJES(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':tareas', $detalles -> obtener_TAREAS(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':leyendas', $detalles -> obtener_LEYENDAS(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $detalles -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el Detalle debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}
}