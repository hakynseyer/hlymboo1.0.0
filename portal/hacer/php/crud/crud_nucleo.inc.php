<?php
namespace crud_nucleo;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_nucleo\nucleo as el_nucleo;
	use \base_hyzher\hyzher as el_hyzher;

class nucleo{
	public static function nuevo($nucleo, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO nucleo (nucleo_hyzher, nucleo_familia, nucleo_cerradura, nucleo_creado) VALUES (:hyzher, :familia, :cerradura, NOW())';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $nucleo -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':familia', $nucleo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':cerradura', $nucleo -> obtener_CERRADURA(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el núcleo debido a: '.$e;
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
						case 'hyzher':
							$sql = 'SELECT hyzher_alias FROM hyzher WHERE hyzher_alias = :hyzher OR id_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_STR);
							break;
						case 'id_nucleo':
							$sql = 'SELECT id_nucleo FROM nucleo WHERE id_nucleo = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_STR);
							break;
						case 'familia':
							$sql = 'SELECT nucleo_familia FROM nucleo WHERE nucleo_familia = :familia';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_STR);
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
			echo 'No se pudo validar el núcleo debido a: '.$e;
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
						case 'hyzhers_faltantes':
							$trabajo = [];
							$sql = 'SELECT id_hyzher, hyzher_alias FROM hyzher WHERE id_hyzher NOT IN (SELECT nucleo_hyzher FROM nucleo)';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_hyzher($fila['id_hyzher'], '', $fila['hyzher_alias'], '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'familia_nucleo':
							$trabajo = [];
							$sql = 'SELECT nucleo_familia FROM nucleo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_nucleo('', '', $fila['nucleo_familia'], '', '');
								}
							}
							break;
						case 'hyzhers_totales':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'hyzhers_nucleo':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM nucleo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'numero_familiares':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM nucleo WHERE nucleo_familia = :familia';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'cerradura_familiar':
							$trabajo = null;
							$sql = 'SELECT nucleo_cerradura FROM nucleo WHERE nucleo_familia = :familia';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['nucleo_cerradura'];
							}
							break;
						case 'tabla_nucleo':
							$trabajo = [];
							$sql = 'SELECT n.id_nucleo, h.hyzher_alias, n.nucleo_familia, n.nucleo_creado FROM nucleo n INNER JOIN hyzher h ON n.nucleo_hyzher = h.id_hyzher WHERE h.hyzher_alias LIKE :alias ORDER BY '. $ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_nucleo($fila['id_nucleo'], $fila['hyzher_alias'], $fila['nucleo_familia'], '', $fila['nucleo_creado']);
								}
							}
							break;
						case 'nucleo_ID':
							$trabajo = null;
							$sql = 'SELECT n.id_nucleo, h.hyzher_alias, n.nucleo_familia, n.nucleo_cerradura, n.nucleo_creado FROM nucleo n INNER JOIN hyzher h ON n.nucleo_hyzher = h.id_hyzher WHERE n.id_nucleo = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_nucleo($fila['id_nucleo'], $fila['hyzher_alias'], $fila['nucleo_familia'], $fila['nucleo_cerradura'], $fila['nucleo_creado']);
							}
							break;
						case 'acceso':
							$trabajo = null;
							$sql = 'SELECT nucleo_cerradura FROM nucleo WHERE nucleo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['nucleo_cerradura'];
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
			echo 'No se pudo mostrar el núcleo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($nucleo, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'familia_uno':
						$sql = 'UPDATE nucleo SET nucleo_familia = :familia, nucleo_cerradura = :cerradura WHERE id_nucleo = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':familia', $nucleo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':cerradura', $nucleo -> obtener_CERRADURA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $nucleo -> obtener_ID(), \PDO::PARAM_INT);
						break;
					case 'familia_grupo':
						$sql = 'UPDATE nucleo SET nucleo_familia = :familiaNuevo, nucleo_cerradura = :cerradura WHERE nucleo_familia = :familiaViejo';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':familiaNuevo', $nucleo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':cerradura', $nucleo -> obtener_CERRADURA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familiaViejo', $nucleo -> obtener_ID(), \PDO::PARAM_STR);
						break;
					case 'cerradura_familia':
						$sql = 'UPDATE nucleo SET nucleo_cerradura = :cerradura WHERE nucleo_familia = :familia';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':cerradura', $nucleo -> obtener_CERRADURA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familia', $nucleo -> obtener_FAMILIA(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el núcleo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($nucleo, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nucleo':
						$sql = 'DELETE FROM nucleo WHERE id_nucleo = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $nucleo -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el núcleo debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

}