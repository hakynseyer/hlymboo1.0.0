<?php
namespace crud_spam;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_spam\spam as el_spam;

class spam{
	public static function nuevo($spam, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'spam':
						$sql = 'INSERT INTO spam(spam_tipo) VALUES(:tipo)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':tipo', $spam -> obtener_TIPO(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar el tipo de spam debido a: '.$e;
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
						case 'tipo':
							$sql = 'SELECT spam_tipo FROM spam WHERE spam_tipo = :tipo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':tipo', $buscar, \PDO::PARAM_STR);
							break;
						case 'id':
							$sql = 'SELECT id_spam FROM spam WHERE id_spam = :id';
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
			echo 'No se pudo validar el spam debido a: '.$e;
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
						case 'tabla_spams':
							$trabajo = [];
							$sql = 'SELECT * FROM spam WHERE spam_tipo LIKE :tipo ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':tipo', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_spam($fila['id_spam'], $fila['spam_tipo']);
								}
							}
							break;
						case 'spam_ID':
							$trabajo = null;
							$sql = 'SELECT * FROM spam WHERE id_spam = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = new el_spam($resultado['id_spam'], $resultado['spam_tipo']);
							}
							break;
						case 'spams_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM spam';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['total'];
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
			echo 'No se pudo mostrar el spam debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($spam, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'spam':
						$sql = 'DELETE FROM spam WHERE id_spam = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $spam -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el spam debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}