<?php
namespace crud_blog;
	
		if (isset($ajax) && !empty($ajax) && $ajax === true) {
			require_once "../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else if(isset($ajaxBuscar) && !empty($ajaxBuscar) && $ajaxBuscar === true){
			require_once "../../../../configuraciones/configurador/configurador_conexionBD.inc.php";
		}else{
			require_once 'portal/configuraciones/configurador/configurador_conexionBD.inc.php';
		}

	use \base_blog\blog as el_blog;
	use \base_categoria\categoria as la_categoria;
	use \base_clasificacion\clasificacion as la_clasificacion;
	use \base_personaje\personaje as el_personaje;
	use \base_fragmento\fragmento as el_fragmento;
	use \base_imagen\imagen as la_imagen;
	use \base_archivo\archivo as el_archivo;
	use \base_planeacion\planeacion as la_planeacion;
	use \base_perfil\perfil as el_perfil;

class blog{
	public static function nuevo($blog, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'nuevo':
						\conexionBD::conexion_BD() -> beginTransaction();
//POSIBLE PROBLEMA MYSAM PORQUE LAS TRANSACCIONES FUNCIONAN CON INNODB
						$sql = 'INSERT INTO blog(blog_hyzher, blog_categoria, blog_clasificacion, blog_titulo, blog_familia, blog_url, blog_archivoactivo, blog_creado, blog_modificado, blog_intentos, blog_estado) VALUES (:hyzher, :categoria, :clasificacion, :titulo, :familia, :url, 0, NOW(), NOW(), 0, 0)';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':categoria', $blog -> obtener_CATEGORIA(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':clasificacion', $blog -> obtener_CLASIFICACION(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':titulo', $blog -> obtener_TITULO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':familia', $blog -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':url', $blog -> obtener_URL(), \PDO::PARAM_STR);
						$ejecuta -> execute();

						$sql1 = 'SELECT id_blog FROM blog WHERE blog_titulo = :titulo2';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql1);
						$ejecuta -> bindParam(':titulo2', $blog -> obtener_TITULO(), \PDO::PARAM_STR);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$id_blog = $resultado['id_blog'];

						$sql2 = 'INSERT INTO planeacion(planeacion_blog, planeacion_proceso, planeacion_etapa1) VALUES('.$id_blog.', 20, NOW())';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql2);
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
			echo 'No se pudo guardar el blog debido a: '.$e;
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
						case 'titulo':
							$sql = 'SELECT blog_titulo FROM blog WHERE blog_titulo = :titulo';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar, \PDO::PARAM_STR);
							break;
						case 'url':
							$sql = 'SELECT blog_url FROM blog WHERE blog_url = :url';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':url', $buscar, \PDO::PARAM_STR);
							break;
						// case 'derechos':
						// 	$sql = 'SELECT blog_derechos FROM blog WHERE blog_derechos = :derechos';
						// 	$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						// 	$ejecuta -> bindParam(':derechos', $buscar, \PDO::PARAM_STR);
						// 	break;
						case 'cat_global':
							$sql = 'SELECT id_categoria FROM categoria WHERE id_categoria = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
						case 'cla_global':
							$sql = 'SELECT id_clasificacion FROM clasificacion WHERE id_clasificacion = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							break;
					}
				}else{
					switch ($opcion) {
						case 'familia':
							$sql = 'SELECT blog_familia FROM blog WHERE blog_familia = :familia AND blog_hyzher <> :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'per_hyzher':
							$sql = 'SELECT id_personaje FROM personaje WHERE id_personaje = :id AND personaje_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'frag_hyzher':
							$sql = 'SELECT id_fragmento FROM fragmento WHERE id_fragmento = :id AND fragmento_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'img_hyzher':
							$sql = 'SELECT id_imagen FROM imagen WHERE id_imagen = :id AND imagen_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'arch_hyzher':
							$sql = 'SELECT id_archivo FROM archivo WHERE id_archivo = :id AND archivo_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							break;
						case 'blog_hyzher':
							$sql = 'SELECT id_blog FROM blog WHERE id_blog = :id AND blog_hyzher = :hyzher';
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
			echo 'No se pudo validar el blog debido a: '.$e;
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
//Panel de Familias Index
						case 'obtenerEntradas_familiaGlobal':
							$trabajo = [];
							$sql = 'SELECT h.hyzher_alias, h.id_hyzher, b.blog_imagen, b.blog_familia, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher WHERE b.blog_estado = 1 GROUP BY b.blog_familia ORDER BY RAND() LIMIT '.$buscar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], '', '', $fila['blog_imagen'], '', '', '', $fila['blog_familia'], '', '', '', '', '', $fila['blog_creado'], '', '', '');
								}
							}
							break;
						case 'numero_paqueteFamiliar':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS numero FROM blog WHERE blog_familia = :familia AND blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
//Mostrar Entradas
						case 'obtenerEntradas_familiaGlobalOffset':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b WHERE b.blog_estado = 1 GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar.' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
//Leer Entrada
						case 'obtenerEntradaNormal':
							$trabajo = null;
							$sql = 'SELECT b.id_blog, b.blog_hyzher, h.hyzher_alias, b.blog_personaje, b.blog_fragmento, b.blog_imagen, b.blog_categoria, b.blog_clasificacion, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_archivo, b.blog_archivoactivo, b.blog_derechos, b.blog_creado, b.blog_modificado, b.blog_intentos FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher WHERE b.blog_url = :url AND b.blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':url', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_blog($fila['id_blog'], $fila['hyzher_alias'], $fila['blog_personaje'], $fila['blog_fragmento'], $fila['blog_imagen'], $fila['blog_categoria'], $fila['blog_clasificacion'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], $fila['blog_archivo'], $fila['blog_archivoactivo'], $fila['blog_derechos'], $fila['blog_creado'], $fila['blog_modificado'], $fila['blog_intentos'], $fila['blog_hyzher']);
							}
							break;
//Panel constructor de Entradas Index
						case 'obtenerEntradaFamilias':
							$trabajo = [];
							$sql = 'SELECT id_blog, blog_personaje, blog_titulo, blog_url, blog_creado FROM blog WHERE blog_familia = :familia AND blog_estado = 1 ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_blog'], '', $fila['blog_personaje'], '', '', '', '', $fila['blog_titulo'], '', $fila['blog_url'], '', '', '', '', $fila['blog_creado'], '', '', '');
								}
							}
							break;
						case 'perfil_hyzherX1':
							$trabajo = null;
							$sql = 'SELECT perfil_imagen, perfil_social1, perfil_social2, perfil_social3, perfil_social4, perfil_etiqueta FROM perfil WHERE perfil_hyzher = :id AND perfil_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_perfil('', '', $fila['perfil_imagen'], '', '', '', '', $fila['perfil_social1'], $fila['perfil_social2'], $fila['perfil_social3'], $fila['perfil_social4'], $fila['perfil_etiqueta'], '');
							}
							break;
						case 'personajeX1':
							$trabajo = null;
							$sql = 'SELECT personaje_imagen, personaje_nombre FROM personaje WHERE id_personaje = :id AND personaje_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_personaje('', '', $fila['personaje_imagen'], $fila['personaje_nombre'], '', '', '', '', '', '', '', '', '', '', '', '');
							}
							break;
						case 'autoresDisponibles':
							$trabajo = [];
							$sql = 'SELECT h.hyzher_alias, h.id_hyzher FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher WHERE b.blog_estado = 1 GROUP BY b.blog_hyzher ORDER BY h.id_hyzher ASC';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'categoriasDisponibles':
							$trabajo = [];
							$sql = 'SELECT c.id_categoria, c.categoria_tipo FROM blog b INNER JOIN categoria c ON b.blog_categoria = c.id_categoria WHERE b.blog_estado = 1 GROUP BY b.blog_categoria ORDER BY c.categoria_tipo ASC';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_categoria'], '', '', '', '', $fila['categoria_tipo'], '', '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
						case 'clasificacionesDisponibles':
							$trabajo = [];
							$sql = 'SELECT c.id_clasificacion, c.clasificacion_tipo FROM blog b INNER JOIN clasificacion c ON b.blog_clasificacion = c.id_clasificacion WHERE b.blog_estado = 1 GROUP BY b.blog_clasificacion ORDER BY c.clasificacion_tipo ASC';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_clasificacion'], '', '', '', '', '', $fila['clasificacion_tipo'], '', '', '', '', '', '', '', '', '', '', '');
								}
							}
							break;
//Zona de autores
						case 'blog_familia':
							$trabajo = [];
							$sql = 'SELECT blog_familia FROM blog WHERE blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog('','','','','','','','',$fila['blog_familia'],'','','','','','','','','');
								}
							}
							break;
						case 'blog_contados':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS mis_blogs FROM blog WHERE blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['mis_blogs'];
							}
							break;
						case 'las_categorias':
							$trabajo = [];
							$sql = 'SELECT * FROM categoria';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_categoria($fila['id_categoria'], $fila['categoria_tipo']);
								}
							}
							break;
						case 'las_clasificaciones':
							$trabajo = [];
							$sql = 'SELECT * FROM clasificacion';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_clasificacion($fila['id_clasificacion'], $fila['clasificacion_tipo']);
								}
							}
							break;
						case 'mis_personajes':
							$trabajo = [];
							$sql = 'SELECT id_personaje, personaje_nombre FROM personaje WHERE personaje_hyzher = :hyzher AND personaje_estado = 1';
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
						case 'mis_fragmentos':
							$trabajo = [];
							$sql = 'SELECT id_fragmento, fragmento_titulo FROM fragmento WHERE fragmento_hyzher = :hyzher AND fragmento_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_fragmento($fila['id_fragmento'], '', $fila['fragmento_titulo'], '', '', '', '', '', '');
								}
							}
							break;
						case 'mis_imagenes':
							$trabajo = [];
							$sql = 'SELECT id_imagen, imagen_titulo, imagen_familia, imagen_ruta, imagen_fuente, imagen_notas, imagen_creado FROM imagen WHERE imagen_hyzher = :hyzher AND imagen_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new la_imagen($fila['id_imagen'], '', $fila['imagen_titulo'], $fila['imagen_familia'], $fila['imagen_ruta'], $fila['imagen_fuente'], $fila['imagen_notas'], $fila['imagen_creado'], '', '', '');
								}
							}
							break;
						case 'mis_archivos':
							$trabajo = [];
							$sql = 'SELECT id_archivo, archivo_titulo FROM archivo WHERE archivo_hyzher = :hyzher AND archivo_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_archivo($fila['id_archivo'], '', $fila['archivo_titulo'], '', '', '', '', '', '', '', '');
								}
							}
							break;			
//Herramientas útiles						
						case 'Nombre_Hyzher':
							$trabajo = null;
							$sql = 'SELECT hyzher_alias FROM hyzher WHERE id_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['hyzher_alias'];
							}
							break;
						case 'hyzher_id':
							$trabajo = null;
							$sql = 'SELECT id_hyzher FROM hyzher WHERE hyzher_alias = :alias';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['id_hyzher'];
							}
							break;
						case 'Nombre_Personaje':
							$trabajo = null;
							$sql = 'SELECT personaje_nombre FROM personaje WHERE id_personaje = :personaje';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':personaje', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['personaje_nombre'];
							}
							break;
						case 'personaje_id':
							$trabajo = null;
							$sql = 'SELECT id_personaje FROM personaje WHERE personaje_nombre = :nombre';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':nombre', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['id_personaje'];
							}
							break;
						case 'Categoria_Blog':
							$trabajo = null;
							$sql = 'SELECT categoria_tipo FROM categoria WHERE id_categoria = :categoria';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':categoria', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['categoria_tipo'];
							}
							break;
						case 'Clasificacion_Blog':
							$trabajo = null;
							$sql = 'SELECT clasificacion_tipo FROM clasificacion WHERE id_clasificacion = :clasificacion';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':clasificacion', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['clasificacion_tipo'];
							}
							break;
						case 'NumeroBlogsActivos':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS numero FROM blog WHERE blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'BlogsFamiliasTotalesActivos':
							$trabajo = null;
							$sql = 'SELECT COUNT(DISTINCT blog_familia) AS numero FROM blog WHERE blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'BlogsFamiliasTotalesActivos_Alias':
							$trabajo = null;
							$sql = 'SELECT COUNT(DISTINCT blog_familia) AS numero FROM blog b WHERE blog_hyzher = :hyzher AND blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'BlogsFamiliasTotalesActivos_Personajes':
							$trabajo = null;
							$sql = 'SELECT COUNT(DISTINCT blog_familia) AS numero FROM blog b WHERE blog_personaje = :personaje AND blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':personaje', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'BlogsHyzherAliasActivos':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS numero FROM blog b INNER JOIN hyzher h on b.blog_hyzher = h.id_hyzher WHERE h.hyzher_alias = :hyzher AND b.blog_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'numero_comentarios':
							$trabajo = null;
							$sql = 'SELECT COUNT(*) AS numero FROM opinion WHERE opinion_blog = :blog AND opinion_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':blog', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['numero'];
							}
							break;
						case 'etiqueta_hyzher':
							$trabajo = null;
							$sql = 'SELECT p.perfil_etiqueta from perfil p INNER JOIN hyzher h ON p.perfil_hyzher = h.id_hyzher WHERE h.hyzher_alias = :alias';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':alias', $buscar, \PDO::PARAM_STR);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if (!empty($resultado)) {
								$trabajo = $resultado['perfil_etiqueta'];
							}
							break;
						case 'imagen_entrada':
							$trabajo = [];
							$sql = 'SELECT imagen_titulo, imagen_ruta, imagen_fuente FROM imagen WHERE id_imagen = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetch();
							if(!empty($resultado)){
								$trabajo[0] = $resultado['imagen_titulo'];
								$trabajo[1] = $resultado['imagen_ruta'];
								$trabajo[2] = $resultado['imagen_fuente'];
							}
							break;
						case 'planeacion_entrada':
							$trabajo = null;
							$sql = 'SELECT planeacion_proceso, planeacion_etapa1, planeacion_etapa2, planeacion_etapa3, planeacion_etapa4, planeacion_etapa5, planeacion_etapa6 FROM planeacion WHERE planeacion_blog = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar, \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new la_planeacion('', '', $fila['planeacion_proceso'], $fila['planeacion_etapa1'], $fila['planeacion_etapa2'], $fila['planeacion_etapa3'], $fila['planeacion_etapa4'], $fila['planeacion_etapa5'], $fila['planeacion_etapa6']);
							}
							break;
					}
				}else{
					switch ($opcion) {
//Zona de autores
						case 'tabla_blogs':
							$trabajo = [];
							$sql = 'SELECT id_blog, blog_hyzher, blog_personaje, blog_fragmento, blog_imagen, blog_categoria, blog_clasificacion, blog_titulo, blog_familia, blog_url, blog_archivo, blog_archivoactivo, blog_derechos, blog_creado, blog_modificado, blog_intentos, blog_estado FROM blog WHERE blog_titulo LIKE :titulo AND blog_hyzher = :hyzher ORDER BY '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':titulo', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if (count($resultado)) {
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_blog'], '', $fila['blog_personaje'], $fila['blog_fragmento'], $fila['blog_imagen'], $fila['blog_categoria'], $fila['blog_clasificacion'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], '', $fila['blog_archivo'], $fila['blog_archivoactivo'], $fila['blog_derechos'], $fila['blog_creado'], $fila['blog_modificado'], $fila['blog_intentos'], $fila['blog_estado']);
								}
							}
							break;
						case 'blog_ID':
							$trabajo = null;
							$sql = 'SELECT id_blog, blog_hyzher, blog_personaje, blog_fragmento, blog_imagen, blog_categoria, blog_clasificacion, blog_titulo, blog_familia, blog_url, blog_texto, blog_archivo, blog_archivoactivo, blog_derechos, blog_creado, blog_modificado, blog_intentos, blog_estado FROM blog WHERE id_blog = :id AND blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_blog($fila['id_blog'], $fila['blog_hyzher'], $fila['blog_personaje'], $fila['blog_fragmento'], $fila['blog_imagen'], $fila['blog_categoria'], $fila['blog_clasificacion'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], $fila['blog_archivo'], $fila['blog_archivoactivo'], $fila['blog_derechos'], $fila['blog_creado'], $fila['blog_modificado'], $fila['blog_intentos'], $fila['blog_estado']);
							}
							break;
						case 'blog_contenido':
							$trabajo = null;
							$sql = 'SELECT blog_texto FROM blog WHERE id_blog = :id AND blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = new el_blog('', '', '', '', '', '', '', '', '', '', $fila['blog_texto'], '', '', '', '', '', '', '');
							}
							break;
						case 'Entrada_Uno':
							$trabajo = null;
							$sql = 'SELECT blog_url FROM blog WHERE blog_hyzher = :hyzher AND blog_familia = :familia AND blog_estado = 1 ORDER BY blog_creado LIMIT 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':familia', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if (!empty($fila)) {
								$trabajo = $fila['blog_url'];
							}
							break;
						case 'obtenerEntradaHyzher':
							$trabajo = null;
							$sql = 'SELECT b.id_blog, h.hyzher_alias, b.blog_personaje, b.blog_fragmento, b.blog_imagen, b.blog_categoria, b.blog_clasificacion, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_archivo, b.blog_archivoactivo, b.blog_derechos, b.blog_creado, b.blog_modificado, b.blog_intentos, b.blog_estado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher WHERE b.blog_url = :url AND h.id_hyzher = :id';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':url', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':id', $buscar[1], \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_blog($fila['id_blog'], $fila['hyzher_alias'], $fila['blog_personaje'], $fila['blog_fragmento'], $fila['blog_imagen'], $fila['blog_categoria'], $fila['blog_clasificacion'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], $fila['blog_archivo'], $fila['blog_archivoactivo'], $fila['blog_derechos'], $fila['blog_creado'], $fila['blog_modificado'], $fila['blog_intentos'], $fila['blog_estado']);
							}
							break;
//Panel entradas index						
						case 'obtenerEntrada_familiaGlobalOffset_Autor':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_estado = 1 AND b.blog_hyzher = :hyzher AND b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar[0].' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
						case 'obtenerEntrada_familiaGlobalOffset_Personaje':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_estado = 1 AND b.blog_personaje = :personaje AND b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar[0].' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':personaje', $buscar[1], \PDO::PARAM_INT);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
						case 'obtenerEntrada_familiaGlobalOffset_Categoria':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_estado = 1 AND b.blog_categoria = :categoria AND b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar[0].' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':categoria', $buscar[1], \PDO::PARAM_INT);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
						case 'obtenerEntrada_familiaGlobalOffset_Clasificacion':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_estado = 1 AND b.blog_clasificacion = :clasificacion AND b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar[0].' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':clasificacion', $buscar[1], \PDO::PARAM_INT);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
						case 'obtenerEntrada_familiaGlobalOffset_Familias':
							$trabajo = [];
							$sql = 'SELECT b.id_blog, h.hyzher_alias, h.id_hyzher, b.blog_personaje, b.blog_imagen, c.categoria_tipo, cl.clasificacion_tipo, b.blog_titulo, b.blog_familia, b.blog_url, b.blog_texto, b.blog_intentos, b.blog_creado FROM blog b INNER JOIN hyzher h ON b.blog_hyzher = h.id_hyzher INNER JOIN categoria c ON b.blog_categoria = c.id_categoria INNER JOIN clasificacion cl ON b.blog_clasificacion = cl.id_clasificacion WHERE b.blog_estado = 1 AND b.blog_familia LIKE :familia AND b.blog_modificado IN (SELECT MAX(b.blog_modificado) FROM blog b GROUP BY b.blog_familia) ORDER BY b.blog_modificado DESC LIMIT '.$buscar[0].' OFFSET '.$ordenar;
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':familia', $buscar[1], \PDO::PARAM_INT);
						 	$ejecuta -> execute();
							$resultado = $ejecuta -> fetchAll();
							if(count($resultado)){
								foreach ($resultado as $fila) {
									$trabajo[] = new el_blog($fila['id_hyzher'], $fila['hyzher_alias'], $fila['blog_personaje'], '', $fila['blog_imagen'], $fila['categoria_tipo'], $fila['clasificacion_tipo'], $fila['blog_titulo'], $fila['blog_familia'], $fila['blog_url'], $fila['blog_texto'], '', '', '', $fila['blog_creado'], '', $fila['blog_intentos'], $fila['id_blog']);
								}
							}
							break;
//Otras Herramientas
						case 'Fragmento_Entrada':
							$trabajo = null;
							$sql = 'SELECT f.fragmento_lado1, f.fragmento_lado2 FROM fragmento f INNER JOIN hyzher h ON f.fragmento_hyzher = h.id_hyzher WHERE f.id_fragmento = :id AND h.hyzher_alias = :alias AND f.fragmento_estado = 1';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_STR);
							$ejecuta -> bindParam(':alias', $buscar[1], \PDO::PARAM_STR);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo = new el_fragmento('', '', '', $fila['fragmento_lado1'], $fila['fragmento_lado2'], '', '', '', '');
							}
							break;
						case 'numero_intentos':
							$trabajo = [];
							$sql = 'SELECT blog_intentos, blog_estado FROM blog WHERE id_blog = :id AND blog_hyzher = :hyzher';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
							$ejecuta -> bindParam(':id', $buscar[0], \PDO::PARAM_INT);
							$ejecuta -> bindParam(':hyzher', $buscar[1], \PDO::PARAM_INT);
							$ejecuta -> execute();
							$fila = $ejecuta -> fetch();
							if(!empty($fila)){
								$trabajo[0] = $fila['blog_intentos'];
								$trabajo[1] = $fila['blog_estado'];
							}
							break;
					}
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo mostrar el blog debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function modificar($blog, $opcion){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			if (isset($opcion) && !empty($opcion)) {
				switch ($opcion) {
					case 'contenido':
						$sql = 'UPDATE blog SET blog_texto = :texto, blog_intentos = blog_intentos + 1 WHERE id_blog = :id AND blog_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':texto', $blog -> obtener_TEXTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
					case 'contenido_modificado':
						\conexionBD::conexion_BD() -> beginTransaction();
//POSIBLE PROBLEMA MYSAM PORQUE LAS TRANSACCIONES FUNCIONAN CON INNODB
						$sql1 = 'UPDATE blog SET blog_texto = :texto, blog_modificado = NOW(), blog_intentos = blog_intentos + 1 WHERE id_blog = :id AND blog_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql1);
						$ejecuta -> bindParam(':texto', $blog -> obtener_TEXTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> execute();

						$sql2 = 'SELECT planeacion_etapa4, planeacion_etapa5, planeacion_etapa6 FROM planeacion WHERE planeacion_blog = :blog';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql2);
						$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$estado[0] = $resultado['planeacion_etapa4'];
						$estado[1] = $resultado['planeacion_etapa5'];
						$estado[2] = $resultado['planeacion_etapa6'];

						$sql3 = 'SELECT blog_intentos FROM blog WHERE id_blog = :blog';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql3);
						$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$intentos = $resultado['blog_intentos'];

						if($intentos > 1){
							if(empty($estado[0])){
								$sql4 = 'UPDATE planeacion SET planeacion_proceso = 80, planeacion_etapa4 = NOW() WHERE planeacion_blog = :blog';
								$ejecuta = \conexionBD::conexion_BD() -> prepare($sql4);
								$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
								$ejecuta -> execute();
							}elseif(empty($estado[1])){
								$sql4 = 'UPDATE planeacion SET planeacion_proceso = 100, planeacion_etapa5 = NOW() WHERE planeacion_blog = :blog';
								$ejecuta = \conexionBD::conexion_BD() -> prepare($sql4);
								$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
								$ejecuta -> execute();
							}elseif(empty($estado[2])){
								$sql4 = 'UPDATE planeacion SET planeacion_proceso = 120, planeacion_etapa6 = NOW() WHERE planeacion_blog = :blog';
								$ejecuta = \conexionBD::conexion_BD() -> prepare($sql4);
								$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
								$ejecuta -> execute();
							}
						}

						$trabajo = true;

						\conexionBD::conexion_BD() -> commit();
						break;
					case 'contenido_estado_oculto':
						\conexionBD::conexion_BD() -> beginTransaction();
//POSIBLE PROBLEMA MYSAM PORQUE LAS TRANSACCIONES FUNCIONAN CON INNODB
						$sql2 = 'UPDATE blog SET blog_texto = :texto WHERE id_blog = :id AND blog_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql2);
						$ejecuta -> bindParam(':texto', $blog -> obtener_TEXTO(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> execute();

						$sql1 = 'SELECT planeacion_etapa2 FROM planeacion WHERE planeacion_blog = :blog';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql1);
						$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$estado = $resultado['planeacion_etapa2'];

						if(empty($estado)){
							$sql0 = 'UPDATE planeacion SET planeacion_proceso = 40, planeacion_etapa2 = NOW() WHERE planeacion_blog = :blog';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql0);
							$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
							$ejecuta -> execute();
						}

						$trabajo = true;

						\conexionBD::conexion_BD() -> commit();
						break;
					case 'detalles':
						\conexionBD::conexion_BD() -> beginTransaction();
//POSIBLE PROBLEMA MYSAM PORQUE LAS TRANSACCIONES FUNCIONAN CON INNODB
						$sql1 = 'UPDATE blog SET blog_categoria = :categoria, blog_clasificacion = :clasificacion, blog_familia = :familia, blog_derechos = :derechos, blog_estado = :estado WHERE id_blog = :id AND blog_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql1);
						$ejecuta -> bindParam(':categoria', $blog -> obtener_CATEGORIA(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':clasificacion', $blog -> obtener_CLASIFICACION(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':familia', $blog -> obtener_FAMILIA(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':derechos', $blog -> obtener_DERECHOS(), \PDO::PARAM_STR);
						$ejecuta -> bindParam(':estado', $blog -> obtener_ESTADO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						$ejecuta -> execute();

						$sql2 = 'SELECT planeacion_etapa3 FROM planeacion WHERE planeacion_blog = :blog';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql2);
						$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> execute();
						$resultado = $ejecuta -> fetch();
						$estado = $resultado['planeacion_etapa3'];

						if(empty($estado) && $blog -> obtener_ESTADO() == 1){
							$sql3 = 'UPDATE planeacion SET planeacion_proceso = 60, planeacion_etapa3 = NOW() WHERE planeacion_blog = :blog';
							$ejecuta = \conexionBD::conexion_BD() -> prepare($sql3);
							$ejecuta -> bindParam(':blog', $blog -> obtener_ID(), \PDO::PARAM_INT);
							$ejecuta -> execute();
						}

						$trabajo = true;

						\conexionBD::conexion_BD() -> commit();
						break;
					case 'pfi_v1':
						$sql = 'UPDATE blog SET blog_personaje = :personaje, blog_fragmento = :fragmento, blog_imagen = :imagen, blog_archivo = :archivo, blog_archivoactivo = :archivoactivo WHERE id_blog = :id AND blog_hyzher = :hyzher';
						$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
						$ejecuta -> bindParam(':personaje', $blog -> obtener_PERSONAJE(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':fragmento', $blog -> obtener_FRAGMENTO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':imagen', $blog -> obtener_IMAGEN(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':archivo', $blog -> obtener_ARCHIVO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':archivoactivo', $blog -> obtener_ARCHIVOACTIVO(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
						$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
						break;
				}
				if (isset($sql)) {
					$trabajo = $ejecuta -> execute();
				}
			}
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo modificar el blog debido a: '.$e;
			\conexionBD::conexion_BD() -> rollback();
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}

	public static function eliminar($blog){
		$trabajo = false;
		\conexionBD::prender_BD();
		try {
			$sql = 'DELETE FROM blog WHERE id_blog = :id AND blog_hyzher = :hyzher';
			$ejecuta = \conexionBD::conexion_BD() -> prepare($sql);
			$ejecuta -> bindParam(':id', $blog -> obtener_ID(), \PDO::PARAM_INT);
			$ejecuta -> bindParam(':hyzher', $blog -> obtener_HYZHER(), \PDO::PARAM_INT);
			$trabajo = $ejecuta -> execute();
		} catch (PDOException $e) {
			\conexionBD::apagar_BD();
			echo 'No se pudo eliminar el blog debido a: '.$e;
		}
		\conexionBD::apagar_BD();
		return $trabajo;
	}
}