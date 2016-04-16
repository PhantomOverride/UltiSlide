<?php
	//Google API KEY
	define("API_KEY", "AIzaSyAJh6_gndGJWBMn9gCjhpXcv7qudcRcBxI");

	$IMAGE_FOLDER = "../../images/";

	class DataBase{
		//Code made for PHP 5.5
		//For PHP 5.6+ using constants is recomended

		/*
		 * Code for PHP 5.6+
		const DSN 		= "mysql:host=localhost;dbname=olofhaglun_main";
		const USERNAME 	= "olofhaglun_main";
		const PASSWORD	= "cbvwMVi4lsEJ";
		const OPTIONS	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

		public static function GetPDO(){
			return new PDO(self::DSN, self::USERNAME, self::PASSWORD, self::OPTIONS);
		}
		*/

		private static $DSN 		= "mysql:host=localhost;dbname=olofhaglun_mk";
		private static $USERNAME 	= "olofhaglun_mk";
		private static $PASSWORD	= "aWujcHPuFwRacV1F7vtP";
		private static $OPTIONS	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

		public static function GetPDO(){
			return new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
		}
	}
?>
