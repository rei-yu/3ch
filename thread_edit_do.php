<?php
	require_once "authenticate.php";
	require_once "thread_get_by_id.php";
	require_once "correct_user.php";
	$info = get_info($_POST['thread_id']);
	correct_user($info['user_id']);


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

	$stmt = $dbh->prepare("UPDATE threads SET name = :name WHERE id = :id");
	$stmt->bindParam(':id', $_POST['thread_id'], PDO::PARAM_INT);
	$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
	$result = $stmt->execute();


	if($result){
		$url = "/3ch/board.php?id=" . $_POST['thread_id'];
		header("Location: " . $url);
	}else{
		echo "Error occured";
	}
