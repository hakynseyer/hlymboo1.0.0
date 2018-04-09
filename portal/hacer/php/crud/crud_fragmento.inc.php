<?php
namespace crud_fragmento;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_fragmento\fragmento as el_fragmento;

class fragmento{
	public static function nuevo($fragmento, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO fragmento(fragmento_hyzher, fragmento_titulo, fragmento_lado1, fragmento_lado2, fragmento_creado, fragmento_modificado, fragmento_intentos, fragmento_estado) VALUES(:hyzher, :titulo, :lado1, :lado2, NOW(), NOW(), 0, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $fragmento -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':titulo', $fragmento -> obtener_TITULO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':lado1', $fragmento -> obtener_LADO1(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':lado2', $fragmento -> obtener_LADO2(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el fragmento debido a: '.$e;
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
							$sql = 'SELECT fragmento_titulo FROM fragmento WHERE fragmento_titulo = :titulo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar, \PDO::PARAM_STR);
							break;
					}
				}else{
					switch ($opcion) {
						case 'frag_hyzher':
							$sql = 'SELECT id_fragmento FROM fragmento WHERE id_fragmento = :id AND fragmento_hyzher = :hyzher';
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
						case 'detalles_fragmento':
							$trabajo = null;
							$sql = 'SELECT detalles_fragmentos FROM detalles WHERE detalles_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['detalles_fragmentos'];
							}
							break;
						case 'fragmentos_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_fragmentos FROM fragmento WHERE fragmento_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_fragmentos'];
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_fragmentos':
							$trabajo = [];
							$sql = 'SELECT f.id_fragmento, h.hyzher_alias, f.fragmento_titulo, f.fragmento_lado1, f.fragmento_lado2, f.fragmento_creado, f.fragmento_modificado, f.fragmento_intentos, f.fragmento_estado FROM fragmento f INNER JOIN hyzher h ON f.fragmento_hyzher = h.id_hyzher WHERE f.fragmento_titulo LIKE :titulo AND f.fragmento_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_fragmento($fila['id_fragmento'],
										$fila['hyzher_alias'],$fila['fragmento_titulo'],
										$fila['fragmento_lado1'],$fila['fragmento_lado2'],
										$fila['fragmento_creado'],$fila['fragmento_modificado'],
										$fila['fragmento_intentos'],$fila['fragmento_estado']);
								}
							}
							break;
						case 'fragmento_ID':
							$trabajo = null;
							$sql = 'SELECT f.id_fragmento, h.hyzher_alias, f.fragmento_titulo, f.fragmento_lado1, f.fragmento_lado2, f.fragmento_creado, f.fragmento_modificado, f.fragmento_intentos, f.fragmento_estado FROM fragmento f INNER JOIN hyzher h ON f.fragmento_hyzher = h.id_hyzher WHERE f.id_fragmento = :id AND f.fragmento_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_fragmento($fila['id_fragmento'],
										$fila['hyzher_alias'],$fila['fragmento_titulo'],
										$fila['fragmento_lado1'],$fila['fragmento_lado2'],
										$fila['fragmento_creado'],$fila['fragmento_modificado'],
										$fila['fragmento_intentos'],$fila['fragmento_estado']);
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el Fragmento debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($fragmento, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar':
						$sql = 'UPDATE fragmento SET fragmento_lado1 = :lado1, fragmento_lado2 = :lado2, fragmento_modificado = NOW(), fragmento_intentos = fragmento_intentos + 1, fragmento_estado = :estado WHERE id_fragmento = :id AND fragmento_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':lado1', $fragmento -> obtener_LADO1(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':lado2', $fragmento -> obtener_LADO2(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $fragmento -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $fragmento -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $fragmento -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el Fragmento debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($fragmento){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM fragmento WHERE id_fragmento = :id AND fragmento_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $fragmento -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $fragmento -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el Fragmento debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}