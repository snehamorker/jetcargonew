<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/const.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

$db = new db();
$email = $_SESSION['userEmail'];
$result = $email['email'];

// DB otp
$stmt = $db->prepare("SELECT otp FROM users WHERE email=:email");
$stmt->bindValue(':email',$result,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$dbOtp = $row['otp'];

// modal(user) otp
$userOtp = $_POST['otp'];

if($userOtp === $dbOtp){
    echo json_encode(array("statusCode" => 200, "message" => "OTP verified"));
}else{
    echo json_encode(array("statusCode" => 201, "message" => "Invalid OTP"));
}




}

?>