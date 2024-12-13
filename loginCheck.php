<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/const.php');

if (isset($_POST['login'])) {

        $db = new db();
        $email = $_POST['email'];
        $password = md5($_POST['password']);
		
		$stmt = $db->prepare("SELECT email,password FROM users WHERE email=:email");
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user){
            
            echo json_encode(array("StatusCode" => 400, "message" => "Email not found!"));
        } else{
			
            $_SESSION['email'] = $user['email'];
			$result = $user['password'];
			
        if ($password === $result){
			
            echo json_encode(array("StatusCode" => 200, "message" => "You successfully logged in"));
        } else {
               
            echo json_encode(array("StatusCode" => 401, "message" => "Invalid email or password!"));
        }
        } 
}


 

?>

