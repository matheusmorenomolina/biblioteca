<?php
	require_once 'config.php';

	class DB{
		private static $instance;

		public static function getInstance(){
			if (!isset(self::$istance)) {
				try {
					self::$instance = new PDO('mysql:host='.db_host.';dbname='.db_name, db_user, db_pass);
					self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				}catch (PDOExepcion $e) {
					echo $e->getMessage();
				}
			}

			return self::$instance;
		}

		public static function prepare($sql) {
			return self::getInstance()->prepare($sql);
		}
	}
?>
