<?php
	$files = glob("../images/*.{jpg,jpeg,gif,png}", GLOB_BRACE);
	$images = array();
	for($i = 0; $i < count($files); $i++){
		$file = stripcslashes(substr($files[$i],3));//Remove the ../ in he beginging.
		$new = 0;
		$images[$i] = array("image" => $file , "new" => $new); 
	}
	$json = json_encode($images,JSON_UNESCAPED_SLASHES);
	echo $json;
?>