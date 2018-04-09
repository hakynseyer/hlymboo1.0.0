<?php
	namespace crud_ingreso;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_ingreso\ingreso as el_ingreso;

class ingreso{
	public static function nuevo($ingreso, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO ingreso(ingreso_user, ingreso_pass, ingreso_email, ingreso_estado) VALUES(:user, :pass, :email, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':user', $ingreso -> obtener_USER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':pass', $ingreso -> obtener_PASS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':email', $ingreso -> obtener_EMAIL(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el ingreso debido a: '.$e;
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
						case 'user_ingreso':
							$sql = 'SELECT id_ingreso FROM ingreso WHERE ingreso_user = :user';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':user', $buscar, \PDO::PARAM_STR);
							break;
						case 'user_hyzher':
							$sql = 'SELECT id_hyzher FROM hyzher WHERE hyzher_alias = :user';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':user', $buscar, \PDO::PARAM_STR);
							break;
						case 'email_ingreso':
							$sql = 'SELECT id_ingreso FROM ingreso WHERE ingreso_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							break;
						case 'email_hyzher':
							$sql = 'SELECT id_hyzher FROM hyzher WHERE hyzher_email = :email';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							break;
						case 'user_id':
							$sql = 'SELECT id_ingreso FROM ingreso WHERE id_ingreso = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
					}
				}else{
					switch ($opcion) {
						case 'Libre':

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
			echo 'No se pudo validar el Ingreso debido a: '.$e;
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
						case 'acceso_registro':
							$trabajo = null;
							$sql = 'SELECT ingreso_pass, ingreso_email FROM ingreso WHERE ingreso_email = :email AND ingreso_estado = 0';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_ingreso('', '', $fila['ingreso_pass'], $fila['ingreso_email'], '');
							}
							break;
						case 'hcompuerta':
							$trabajo = null;
							$sql = 'SELECT ingreso_pass, ingreso_email FROM ingreso WHERE ingreso_email = :email AND ingreso_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':email', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_ingreso('', '', $fila['ingreso_pass'], $fila['ingreso_email'], '');
							}
							break;
						case 'ingresos_totales':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM ingreso';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'ingresos_totales_registrados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM ingreso WHERE ingreso_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['total'];
							}
							break;
						case 'tabla_ingresos':
							$trabajo = [];
							$sql = 'SELECT id_ingreso, ingreso_user, ingreso_email, ingreso_estado FROM ingreso WHERE ingreso_user LIKE :user ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':user', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_ingreso($fila['id_ingreso'], $fila['ingreso_user'], '', $fila['ingreso_email'], $fila['ingreso_estado']);
								}
							}
							break;
						case 'ingresos_ID':
							$trabajo = null;
							$sql = 'SELECT id_ingreso, ingreso_user, ingreso_email, ingreso_estado FROM ingreso WHERE id_ingreso = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_ingreso($fila['id_ingreso'], $fila['ingreso_user'], '', $fila['ingreso_email'], $fila['ingreso_estado']);
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'libre':

							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el Ingreso debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($ingreso, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'cambiar_pass':
						$sql = 'UPDATE ingreso SET ingreso_pass = :pass WHERE id_ingreso = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':pass', $ingreso -> obtener_PASS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $ingreso -> obtener_ID(), \PDO::PARAM_INT);
						break;
					// case 'cambiar_email_ingreso':
					// 	$sql = 'UPDATE ingreso SET ingreso_email = :email WHERE id_ingreso = :id';
					// 	$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
					// 	$ejecuta -> bindParam(':email', $ingreso -> obtener_EMAIL(), \PDO::PARAM_STR);
					// 	$ejecuta -> bindParam(':id', $ingreso -> obtener_ID(), \PDO::PARAM_INT);
					// 	break;
					// case 'cambiar_email_hyzher':
					// 	$sql = 'UPDATE hyzher SET hyzher_email = :email WHERE hyzher_email = :user';
					// 	$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
					// 	$ejecuta -> bindParam(':email', $ingreso -> obtener_EMAIL(), \PDO::PARAM_STR);
					// 	$ejecuta -> bindParam(':user', $ingreso -> obtener_USER(), \PDO::PARAM_STR);
					// 	break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el Ingreso debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($ingreso, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'ingreso':
						$sql = 'DELETE FROM ingreso WHERE id_ingreso = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $ingreso -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el ingreso debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

}
