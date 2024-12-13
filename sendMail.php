<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/const.php');

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db = new db();
$mail = new PHPMailer(true);
$otp = random_int(1010, 9999);

try{

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                      
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );   

    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'snehamorker.dds@gmail.com';                   
    $mail->Password   = 'sdqcmyuvqzgmgvng';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('snehamorker.dds@gmail.com', 'Mailer');
    $mail->addAddress('snehamorker.dds@gmail.com', 'User');    
   
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Reset Your Password';
    $mail->Body = 'Hello! <br><b>Your OTP is:</b> ' . $otp . '<br><i>Please use this OTP to reset your password.</i>';
    
    $email =  $_SESSION['userEmail'];

    $result = $email['email'];  
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email',$result ,PDO::PARAM_STR);
    $stmt->execute();
   
    if ($stmt->rowCount() > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $user['id'];  
    }
   
    $stmt = $db->prepare("UPDATE users SET otp=:otp WHERE id=:id");
    $stmt->bindValue('otp',$otp,PDO::PARAM_STR);
    $stmt->bindValue('id',$user_id,PDO::PARAM_STR);
    $res = $stmt->execute();
    
    $mail->send();
    echo 'Email has been sent.';

} catch (Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
