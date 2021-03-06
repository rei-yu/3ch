<?php

	try {
    $dbh = new PDO(
    	'mysql:host=localhost;
    	dbname=textboard',
    	'admin',
    	'CCJYzgrbN0qsIsOa'
  );
	} catch (PDOException $e) {
	    var_dump($e->getMessage());
	    exit;
	}

	session_start();

	$stmt = $dbh->prepare("INSERT INTO threads (name,user_id,updated) VALUES (:name,:user_id,:updated)");
	$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $_SESSION['USERID'], PDO::PARAM_INT);
	$stmt->bindParam(':updated', date('Y-m-d'), PDO::PARAM_STR);
	$result = $stmt->execute();

	if($result){
		$url = "/3ch/threads.php";
		header("location: " . $url);
	}else{
		echo "failed";
	}