<?php
	define("API_KEY", "AIzaSyAJh6_gndGJWBMn9gCjhpXcv7qudcRcBxI");

	if(!isset($_POST["submit"])){
		exit("Förfrågan måste skickas igenom knappen");
	}

	require("links.php");
	
	$allowedTypes = array(
							"image",
							"youtube",
							);
	
	$allowedEffects = array(
							"none",
							"blink",
							"horn"
							);
	
    $type = filter_input(INPUT_POST, "mediaType", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = "";
	$priority = filter_input(INPUT_POST, "priority", FILTER_SANITIZE_NUMBER_INT);
	$duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_NUMBER_INT);
	$effect = $_POST["effect"];
	$startTime = GetTimestamp(true);
	$endTime = GetTimestamp(false);
	
	echo $startTime . "<br />";
	echo $endTime . "<br />";
	
	if(!in_array($type, $allowedTypes)){
		exit("Not allowed type" . $type);
	}
	
	if($effect[0] == $allowedEffects[0]){
		$effect = NULL;
	}
	else{
		$tempEfftect = "";
		foreach($effect as $e){
			if(!in_array($e, $allowedEffects)){
				exit("Not allowed effect" . $e);
			}
			$tempEfftect .= $e . ',';
		}
		$effect = $tempEfftect;
	}
	
	switch($type){
		case "image":
			$content = "olofhaglund.name/images/" . Image();
		break;
		case "youtube":
			$content = filter_input(INPUT_POST, "youtubeUrl", FILTER_SANITIZE_URL);
			$duration = Youtube($content);
		break;
	}
	
	$dsn 		= "mysql:host=localhost;dbname=ddd";
	$username 	= "uuu";
	$password	= "ppp";
	$options	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
	
	try{
		$pdo = new PDO($dsn, $username, $password, $options);
	}
	catch(Exception $error){
		echo $error;
	}
	if($startTime != NULL){
		$sql = "INSERT INTO `mkSlide`
				(`priority`, `type`, `data`, `duration`, `effect`, `startTime`, `stopTime`) 
				VALUES 
				({$priority},'{$type}','{$content}',{$duration},'{$effect}',{$startTime},{$endTime})";
	}
	else{
		$sql = "INSERT INTO `mkSlide`
			(`priority`, `type`, `data`, `duration`, `effect`) 
			VALUES 
			({$priority},'{$type}','{$content}',{$duration},'{$effect}')";
	}
	$sth = $pdo->prepare($sql);
	if(!$sth){
		var_dump($pdo->errorInfo());
	}
	else{
		$sth->execute();
	}
	
    function Image(){
        $local = filter_input(INPUT_POST, "localImage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($local == "local"){ //Upload file
            global $IMAGE_FOLDER;
			$target = $IMAGE_FOLDER . basename($_FILES["imageFile"]["name"]);
			$check = getimagesize($_FILES["imageFile"]["tmp_name"]);
			if($check !== false){
				if(file_exists($target)){
					exit("A file with this name does allready exists. Choose another name or use the existing image");
				}
				if($_FILES["imageFile"]["size"] > 4000000){
					exit("Sorry, file you try to upload is larger than 4mb");
				}
				$allowedFileTypes = array("jpg","jpeg","png");
				if(!in_array(pathinfo($target,PATHINFO_EXTENSION), $allowedFileTypes)){
					exit("Only JPG, JPEG and PNG are allowed");
				}
				if(move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target)){
					return basename($_FILES["imageFile"]["name"]);
				}
				else{
					exit("Error uploading the image");
				}
			}
			else{
				exit("File is not an image!");
			}
        }
        else{//Copy image from a URL
            return CopyImage();
        }
    }
    
    function CopyImage(){
        $url = filter_input(INPUT_POST, "urlImage", FILTER_SANITIZE_URL);
        $name = filter_input(INPUT_POST, "urlImageName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ext = Extension($url);
        global $IMAGE_FOLDER;
        $image = $IMAGE_FOLDER . $name . "." . $ext;
        copy($url, $image);
        return $name . "." . $ext;
    }
    
	function Youtube($url){
		parse_str( parse_url($url, PHP_URL_QUERY), $out);
		//$json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=contentDetails&d=' . $out['v'] . '&key=' . API_KEY);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . $out['v'] . '&key=' . API_KEY);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$output = curl_exec($ch);
		$data = json_decode($output);
		$duration = new DateInterval($data->items[0]->contentDetails->duration);
		$seconds = $duration->h * 3600 + $duration->i * 60 + $duration->s + 5;
		return $seconds;
		
	}
	
    function Extension($url){
        return pathinfo($url, PATHINFO_EXTENSION);
    }
	
	function GetTimestamp($start){
		if(filter_input(INPUT_POST, "startNow", FILTER_SANITIZE_FULL_SPECIAL_CHARS) != true){
			if($start){
				$dateName = "startDate";
				$timeName = "startTime";
			}
			else{
				$dateName = "endDate";
				$timeName = "endTime";
			}
			//date format yyyy-mm-dd Time format hh:mm:ss
			$date = filter_input(INPUT_POST, $dateName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$time = filter_input(INPUT_POST, $timeName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			
			$date = new DateTime($date.'T'.$time, new DateTimeZone('UTC'));
			return $date->getTimestamp();
		}
		else{
			return NULL;
		}
	}
?>