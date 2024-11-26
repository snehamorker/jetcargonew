<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/const.php');

if(isset($_POST['login'])){

	$db = new db();
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	// check email 
	$sql = "SELECT email FROM users WHERE email=:email";
  	$stmt = $db->prepare($sql);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->rowCount();
  	if($result == 1){	
	$_SESSION['email'] = $email;
	echo json_encode(array("StatusCode" => 400, "message" => "Email not found."));
  	}else{

	// email exits and check password
	$sql = "SELECT * FROM users WHERE email=:email AND password=:password";
	$result = $db->prepare($sql);
	$result->bindParam(':email', $email, PDO::PARAM_STR);
	$result->bindParam(':password', $password, PDO::PARAM_STR);
	$result->execute();
	$user = $result->fetchAll();
	print_r($user);
	var_dump($user['password']);

	if(password_verify($user['password'],$password)){

	  echo json_encode(array("StatusCode" => 200, "message" => "You succsessfully logged in"));
  	}else{
	echo json_encode(array("StatusCode" => 201, "message" => "Oops! , your credentials were mismatch."));
	  }
  	}
  	}


?>

