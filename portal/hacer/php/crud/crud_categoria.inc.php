<?php
namespace crud_categoria;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_categoria\categoria as la_categoria;

class categoria{
	public static function nuevo($categoria, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						$sql = 'INSERT INTO categoria(categoria_tipo) VALUES(:tipo)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':tipo', $categoria -> obtener_TIPO(), \PDO::PARAM_STR);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar la categoria debido a: '.$e;
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
							$sql = 'SELECT categoria_tipo FROM categoria WHERE categoria_tipo = :tipo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':tipo', $buscar, \PDO::PARAM_STR);
							break;
						case 'id':
							$sql = 'SELECT id_categoria FROM categoria WHERE id_categoria = :id';
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
			echo 'No se pudo validar la categoria debido a: '.$e;
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
						case 'tabla_categorias':
							$trabajo = [];
							$sql = 'SELECT * FROM categoria WHERE categoria_tipo LIKE :tipo ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':tipo', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_categoria($fila['id_categoria'], $fila['categoria_tipo']);
								}
							}
							break;
						case 'categoria_ID':
							$trabajo = null;
							$sql = 'SELECT * FROM categoria WHERE id_categoria = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = new la_categoria($resultado['id_categoria'], $resultado['categoria_tipo']);
							}
							break;
						case 'categorias_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM categoria';
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
			echo 'No se pudo mostrar la categoria debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($categoria, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'categoria':
						$sql = 'DELETE FROM categoria WHERE id_categoria = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $categoria -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar la categoria debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}