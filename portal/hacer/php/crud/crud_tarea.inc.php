<?php
namespace crud_tarea;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_tarea\tarea as la_tarea;
	use \base_blog\blog as el_blog;
	use \base_tablones\tablones as el_tablon;

class tarea{
	public static function nuevo($tarea, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'tarea':
						\conexionBD::conexion_BD() -> beginTransaction();
//POSIBLE PROBLEMA MYSAM PORQUE LAS TRANSACCIONES FUNCIONAN CON INNODB
						$sql2 = 'SELECT id_planeacion FROM planeacion WHERE planeacion_blog = :blog2';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql2);
						$ejecuta -> bindParam(':blog2', $tarea -> obtener_BLOG(), \PDO::PARAM_INT);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$id_planeacion = $resultado['id_planeacion'];

						$sql3 = 'INSERT INTO tarea(tarea_blog, tarea_planeacion, tarea_descripcion, tarea_programada, tarea_estado) VALUES(:blog3,'.$id_planeacion.', :descripcion, :programada, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql3);
						$ejecuta -> bindParam(':blog3', $tarea -> obtener_BLOG(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':descripcion', $tarea -> obtener_DESCRIPCION(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':programada', $tarea -> obtener_PROGRAMADA(), \PDO::PARAM_STR);
						$trabajo = $ejecuta -> execute();

						\conexionBD::conexion_BD() -> commit();
						break;
				}
				// if (isset($sql)) {
				// 	$trabajo = $ejecuta -> execute();
				// }
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar la tarea debido a: '.$e;
			\conexionBD::conexion_BD() -> rollback();
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
						case 'elblog':
							$sql = 'SELECT tarea_blog FROM tarea WHERE tarea_blog = :blog';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar, \PDO::PARAM_INT);
							break;
						case 'tarea_blog':
							$sql = 'SELECT id_tarea FROM tarea WHERE id_tarea = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
					}
				}else{
					switch ($opcion) {
						case 'blog':
							$sql = 'SELECT id_blog FROM blog WHERE id_blog = :blog AND blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar[0], \PDO::PARAM_INT);
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
						case 'tarea_ID':
							$trabajo = null;
							$sql = 'SELECT t.id_tarea, b.blog_titulo, b.blog_familia, t.tarea_descripcion, t.tarea_programada, t.tarea_estado FROM tarea t INNER JOIN blog b ON t.tarea_blog = b.id_blog WHERE t.id_tarea = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = new la_tarea($resultado['id_tarea'], $resultado['blog_titulo'], $resultado['blog_familia'], $resultado['tarea_descripcion'], $resultado['tarea_programada'], $resultado['tarea_estado']);
							}
							break;
						case 'tareas_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM tarea';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['total'];
							}
							break;
						case 'tareas_permitidas':
							$trabajo = null;
							$sql = 'SELECT detalles_tareas FROM detalles WHERE detalles_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['detalles_tareas'];
							}
							break;
						case 'mis_blogs':
							$trabajo = [];
							$sql = 'SELECT id_blog, blog_imagen, blog_titulo, blog_familia FROM blog WHERE blog_hyzher = :hyzher AND blog_estado = 0 AND id_blog NOT IN (SELECT tarea_blog FROM tarea )';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_blog'], '', '', '', $fila['blog_imagen'], '', '', $fila['blog_titulo'], $fila['blog_familia'], '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'mi_tarea':
							$trabajo = null;
							$sql = 'SELECT id_tarea FROM tarea WHERE tarea_blog = :blog';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['id_tarea'];
							}
							break;
						case 'tablon_tareas':
							$trabajo = [];
							$sql = 'SELECT t.id_tarea, h.hyzher_alias, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, pl.planeacion_proceso, pl.planeacion_etapa1, pl.planeacion_etapa2, pl.planeacion_etapa3, pl.planeacion_etapa4, pl.planeacion_etapa5, pl.planeacion_etapa6, t.tarea_descripcion, t.tarea_programada FROM tarea t INNER JOIN blog b ON t.tarea_blog = b.id_blog INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion INNER JOIN planeacion pl ON t.tarea_planeacion = pl.id_planeacion WHERE t.tarea_estado = 1 ORDER BY RAND() LIMIT '.$buscar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_tablon($fila['id_tarea'], $fila['hyzher_alias'], $fila['blog_personaje'], $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['planeacion_proceso'], $fila['planeacion_etapa1'], $fila['planeacion_etapa2'], $fila['planeacion_etapa3'], $fila['planeacion_etapa4'], $fila['planeacion_etapa5'], $fila['planeacion_etapa6'], $fila['tarea_descripcion'], $fila['tarea_programada']);
								}
							}
							break;
						case 'tablon_imagen':
							$trabajo = [];
							$sql = 'SELECT imagen_titulo, imagen_ruta, imagen_fuente FROM imagen WHERE id_imagen = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(count($resultado)){
								$trabajo[0] = $resultado['imagen_titulo'];
								$trabajo[1] = $resultado['imagen_ruta'];
								$trabajo[2] = $resultado['imagen_fuente'];
							}
							break;
						case 'tablon_personaje':
							$trabajo = null;
							$sql = 'SELECT personaje_nombre FROM personaje WHERE id_personaje = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['personaje_nombre'];
							}
							break;
						case 'tablon_tareas_vista':
							$trabajo = [];
							$sql = 'SELECT t.id_tarea, h.hyzher_alias, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, pl.planeacion_proceso, pl.planeacion_etapa1, pl.planeacion_etapa2, pl.planeacion_etapa3, pl.planeacion_etapa4, pl.planeacion_etapa5, pl.planeacion_etapa6, t.tarea_descripcion, t.tarea_programada FROM tarea t INNER JOIN blog b ON t.tarea_blog = b.id_blog INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion INNER JOIN planeacion pl ON t.tarea_planeacion = pl.id_planeacion WHERE h.id_hyzher = :id AND t.tarea_estado = 0';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(!empty($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_tablon($fila['id_tarea'], $fila['hyzher_alias'], $fila['blog_personaje'], $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['planeacion_proceso'], $fila['planeacion_etapa1'], $fila['planeacion_etapa2'], $fila['planeacion_etapa3'], $fila['planeacion_etapa4'], $fila['planeacion_etapa5'], $fila['planeacion_etapa6'], $fila['tarea_descripcion'], $fila['tarea_programada']);
								}
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'tabla_tareas':
							$trabajo = [];
							$sql = 'SELECT t.id_tarea, b.blog_titulo, t.tarea_planeacion, t.tarea_descripcion, t.tarea_programada, t.tarea_estado FROM tarea t INNER JOIN blog b ON t.tarea_blog = b.id_blog WHERE b.blog_titulo LIKE :titulo AND b.blog_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_tarea($fila['id_tarea'], $fila['blog_titulo'], $fila['tarea_planeacion'], $fila['tarea_descripcion'], $fila['tarea_programada'], $fila['tarea_estado']);
								}
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar la tarea debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($tarea, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'tarea':
						$sql = 'UPDATE tarea SET tarea_descripcion = :descripcion, tarea_programada = :programada, tarea_estado = :estado WHERE id_tarea = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':descripcion', $tarea -> obtener_DESCRIPCION(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':programada', $tarea -> obtener_PROGRAMADA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $tarea -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $tarea -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar la tarea debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($tarea, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'tarea':
						$sql = 'DELETE FROM tarea WHERE id_tarea = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $tarea -> obtener_ID(), \PDO::PARAM_INT);
						$trabajo = $ejecuta -> execute();
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar la tarea debido a: '.$e;
			\conexionBD::conexion_BD() -> rollback();
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}