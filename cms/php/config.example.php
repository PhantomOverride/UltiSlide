<?php
	//Google API KEY
	define("API_KEY", "SET_YOUR_GOOGLE_API_TOKEN_HERE"); // Set you google api avalible at http://console.developers.google.com . You also have to activate the "YouTube Data API v3".
	define("IMAGES", "olofhaglund.name/images/"); //url to image directory. Example my image location is at olofhaglund.name/images.
    define("IMAGE_DIRECTORY", "../../images/  "); //Path to the image directory

	class DataBase{

		private static $DSN 		= "mysql:host=localhost;dbname=DATABASE_NAME";
		private static $USERNAME 	= "DATABASE_USERNAME";
		private static $PASSWORD	= "DATABASE_PASSWORD";
		private static $OPTIONS	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

		public static function GetPDO(){
			return new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
		}
	}
?>
