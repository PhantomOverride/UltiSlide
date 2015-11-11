<?php
	define("API_KEY", "");
	
	class DataBase{
		const DSN 		= "mysql:host=localhost;dbname=";
		const USERNAME 	= "";
		const PASSWORD	= "";
		const OPTIONS	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
	
		public static function GetPDO(){
			return new PDO(self::DSN, self::USERNAME, self::PASSWORD, self::OPTIONS);
		}
	}
?>