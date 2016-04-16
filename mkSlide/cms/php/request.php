<?php
	require_once("config.php");

	$currentSlide = filter_input(INPUT_POST,"slideNumber", FILTER_SANITIZE_NUMBER_INT);

	try{
		$pdo = DataBase::GetPDO();
	}
	catch(Exception $error){
		echo $error;
	}

	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	$sql = "SELECT * FROM `mkSlide` ORDER BY `priority` DESC, `id` ASC ";
	$sth = $pdo->prepare($sql);
	if(!$sth){
		var_dump($pdo->errorInfo());
	}
	else{
		$sth->execute();
	}

	$res = $sth->fetchAll();
	$index = GetIndex('id', $currentSlide, $res);

	$count = count($res);
	$loopCount = 0;

	//Check if any images to show
	do{
		if($count - 1  <= $index){
			$index = 0;
		}
		else{
			$index++;
		}
	}while(!InTimeArea($index, $res) && $count > $loopCount++);//the result mus be in time area.

	if($loopCount > $count){//No images to show

	}
	else{
		$json = json_encode($res[$index], true);
		echo $json;
	}
	function InTimeArea($index, $array){
		$currentTime = time();
		if( $array[$index]->startTime == NULL || $array[$index]->startTime == 0){
			return true;
		}
		if($currentTime >= $array[$index]->startTime && $currentTime < $array[$index]->stopTime){
			return true;
		}
		else return false;
	}

	/**
	 *	Get what index the slide was on before
	 */
	function GetIndex($key, $keyValue, $sqlFetchArray){
		$counter = 0;
		foreach($sqlFetchArray as $object){
			$id = $object->$key;
			if($id == $keyValue){
				return $counter;
			}
			$counter++;
		}
		return false;
	}
?>
