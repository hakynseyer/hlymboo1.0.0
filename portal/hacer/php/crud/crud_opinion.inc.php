<?php
namespace crud_opinion;

		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_opinion\opinion as la_opinion;

class opinion{
	public static function nuevo($opinion, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'opinion':
						$sql = 'INSERT INTO opinion(opinion_hyzher, opinion_blog, opinion_texto, opinion_spam, opinion_hyzh, opinion_creado, opinion_estado) VALUES(:hyzher, :blog, :texto, :spam, :hyzh, NOW(), 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $opinion -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':blog', $opinion -> obtener_BLOG(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':texto', $opinion -> obtener_TEXTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':spam', $opinion -> obtener_SPAM(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzh', $opinion -> obtener_HYZH(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo guardar la opinión debido a: '.$e;
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
						case 'blog':
							$sql = 'SELECT id_blog FROM blog WHERE id_blog = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
						case 'spam':
							$sql = 'SELECT id_spam FROM spam WHERE id_spam = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
						case 'hyzh':
							$sql = 'SELECT id_opinion FROM opinion WHERE id_opinion = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
						case 'opinion':
							$sql = 'SELECT id_opinion FROM opinion WHERE id_opinion = :id';
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
			echo 'No se pudo validar la opinion debido a: '.$e;
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
						case 'tabla_opiniones':
							$trabajo = [];
							$sql = 'SELECT o.id_opinion, o.opinion_hyzher, b.blog_titulo, o.opinion_texto, s.spam_tipo, o.opinion_hyzh, o.opinion_creado, o.opinion_estado FROM opinion o INNER JOIN blog b ON o.opinion_blog = b.id_blog INNER JOIN spam s ON o.opinion_spam = s.id_spam WHERE b.id_blog = :id AND o.opinion_estado = 0 ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_opinion($fila['id_opinion'], $fila['opinion_hyzher'], $fila['blog_titulo'], $fila['opinion_texto'], $fila['spam_tipo'], $fila['opinion_hyzh'], $fila['opinion_creado'], $fila['opinion_estado']);
								}
							}
							break;
						case 'opinion_ID':
							$trabajo = null;
							$sql = 'SELECT * FROM opinion WHERE id_opinion = :id AND opinion_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = new la_opinion($resultado['id_opinion'], $resultado['opinion_hyzher'], $resultado['opinion_blog'], $resultado['opinion_texto'], $resultado['opinion_spam'], $resultado['opinion_hyzh'], $resultado['opinion_creado'], $resultado['opinion_estado']);
							}
							break;
						case 'opiniones_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM opinion';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['total'];
							}
							break;
						case 'blogs_opinados':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, b.blog_titulo FROM opinion o INNER JOIN blog b ON o.opinion_blog = b.id_blog WHERE b.blog_hyzher = :hyzher AND o.opinion_estado = 0 ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_opinion($fila['id_blog'], '', $fila['blog_titulo'], '', '', '', '', '');
								}
							}
							break;
						case 'las_opiniones':
							$trabajo = [];
							$sql = 'SELECT o.id_opinion, o.opinion_hyzher, o.opinion_blog, o.opinion_texto, s.spam_tipo, o.opinion_hyzh, o.opinion_creado FROM opinion o INNER JOIN spam s ON o.opinion_spam = s.id_spam WHERE o.opinion_blog = :blog AND o.opinion_estado = 1 AND o.opinion_hyzh IS NULL ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_opinion($fila['id_opinion'], $fila['opinion_hyzher'], $fila['opinion_blog'], $fila['opinion_texto'], $fila['spam_tipo'], $fila['opinion_hyzh'], $fila['opinion_creado'], '');
								}
							}
							break;
						case 'la_respuesta':
							$trabajo = null;
							$sql = 'SELECT opinion_texto FROM opinion WHERE id_opinion = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['opinion_texto'];
							}
							break;
						case 'el_hyzher':
							$trabajo = null;
							$sql = 'SELECT hyzher_alias FROM hyzher WHERE id_hyzher = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['hyzher_alias'];
							}
							break;
						case 'cantidad_comentarios':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS total FROM opinion WHERE opinion_blog = :blog AND opinion_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo = $resultado['total'];
							}
							break;
					}
				}else{
					switch ($opcion) {
						case 'opiniones_respuesta':
							$trabajo = [];
							$sql = 'SELECT o.id_opinion, o.opinion_hyzher, o.opinion_blog, o.opinion_texto, s.spam_tipo, o.opinion_hyzh, o.opinion_creado FROM opinion o INNER JOIN spam s ON o.opinion_spam = s.id_spam WHERE o.opinion_blog = :blog AND o.opinion_hyzh = :id AND o.opinion_estado = 1 ORDER BY o.opinion_creado DESC';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':id', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new la_opinion($fila['id_opinion'], $fila['opinion_hyzher'], $fila['opinion_blog'], $fila['opinion_texto'], $fila['spam_tipo'], $fila['opinion_hyzh'], $fila['opinion_creado'], '');
								}
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar la opinion debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($opinion, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'estado':
						$sql = 'UPDATE opinion SET opinion_estado = 1 WHERE id_opinion = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $opinion -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
			}
			if (isset($sql)) {
				$trabajo = $ejecuta -> execute();
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar la opinion debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;	
	}

	public static function eliminar($opinion, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'opinion':
						$sql = 'DELETE FROM opinion WHERE id_opinion = :id';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':id', $opinion -> obtener_ID(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar la opinion debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	} 
}