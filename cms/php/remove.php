<?php
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $dsn        = "mysql:host=localhost;dbname=ddd";
    $username   = "uuu";
    $password   = "ppp";
    $options    = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    
    try{
        $pdo = new PDO($dsn, $username, $password, $options);
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
?>