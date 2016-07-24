<?php
	require_once("config.php");

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    try{
        $pdo = DataBase::GetPDO();
    }
    catch(Exception $error){
        echo $error;
    }

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "DELETE FROM `mkSlide` WHERE `id` = {$id}";
    $sth = $pdo->prepare($sql);
    if(!$sth){
        var_dump($pdo->errorInfo());
    }
    else{
        $sth->execute();
    }

	header("location: /mkSlide/cms");
	echo "<a href='/mkSlide/cms'>Go Back</a>";
	exit;
?>
