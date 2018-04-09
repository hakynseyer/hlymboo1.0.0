<?php

class conexionBD{
	private static $conexionBD;
	public static function prender_BD(){
		if (!isset(self::$conexionBD)) {
			try {
				require_once "configurador_BD.inc.php";
				self::$conexionBD = new PDO('mysql:host='.NOMBRE_SERVIDOR.';dbname='.NOMBRE_BD,NOMBRE_USUARIO,PASSWORD);
				self::$conexionBD -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				self::$conexionBD -> exec('SET CHARACTER SET utf8');
			} catch (PDOException $e) {
				echo "No se pudo conectar a la BD <br>";
				die();
			}
		}
	}
	public static function apagar_BD(){
		if (isset(self::$conexionBD)) {
			self::$conexionBD = null;
		}
	}
	public static function conexion_BD(){
		return self::$conexionBD;
	}
}