<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/const.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/Classes/class.user.php');


$task = $_GET['task'];
$db = new db();
$user = new user(); 

if ($task == 'display'){
    $sql = "SELECT * FROM users";
    $select = $db->prepare($sql);
    $select->execute();
    $selectdata = $select->fetchAll(PDO::FETCH_ASSOC);

    $data = []; 
    foreach($selectdata as $row){
        
        $imageArray = json_decode($row['image'], true);      
        if(!$imageArray){
            $imageArray = [];
        }

        $imgHtml='';
        foreach($imageArray as $image){
            $imgHtml .= '<img src="../image/'.$image .'" width="100px">';
        }

        $data[] = [
            'id' => $row['id'],
            'firstname'=> $row['firstname'],
            'lastname'=> $row['lastname'],
            'email'=> $row['email'],
            'password'=> $row['password'],
            'permissiongroup'=> $row['permissiongroup'],
            'companyId'=> $row['companyId'],
            'agentcompany'=> $row['agentcompany'],
            'phone'=> $row['phone'],
            'notification'=> $row['notification'],
            'locked'=> $row['locked'],
            'image' => $imgHtml,
        ];
    }
    echo json_encode(['data' => $data]);
    exit();
}

if ($task == 'getsingledata'){

    $id = base64_decode($_POST['id']);
    $sql = "select * from users where id=:id";
    $select = $db->prepare($sql);
    $select->bindValue(':id',$id,PDO::PARAM_STR);
    $select->execute();
    $selectdata = $select->fetch(PDO::FETCH_ASSOC); 
    $obj = json_decode($selectdata['image']);

    if($selectdata && !empty($selectdata['image'])){
       $selectdata['image'] = $obj;  
    }

    echo json_encode(["data"=>$selectdata]);
    die;
}


if ($task == 'add'){

    $totalImage = count($_FILES['image']['name']);
    $imageArray = array();

    for($i = 0; $i < $totalImage; $i++){

        $file_name = $_FILES["image"]["name"][$i];
        $file_tmp = $_FILES["image"]["tmp_name"][$i];

        $imageExtension = pathinfo($file_name, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);
        $file_uniqid = uniqid();
        $newImgName = $file_uniqid . "." . $imageExtension;
        $folder = "../image/" . $newImgName;

        if(move_uploaded_file($file_tmp,$folder)){
            $imageArray[] = $newImgName;
        }
    }

    $imgArrayJson = json_encode($imageArray);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST["password"]);
    $permissiongroup = $_POST['permissiongroup'];
    $companyId = $_POST['companyId'];
    $agentcompany = $_POST['agentcompany'];
    $phone = $_POST['phone'];
    $notification = $_POST['notification'];
    $locked = $_POST['locked'];
    $image=$imgArrayJson;
    $user->addUser($firstname, $lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone,$notification,$locked,$image);
    echo json_encode(array("statusCode" => 200, "message" => "User Added Successfully."));
}

if ($task == 'edit'){

    $id = $_POST['editId'];

    $stmt = $db->prepare("SELECT image FROM users WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldImages = json_decode($result['image'], true) ?? [];

    $uploaded_files = $_FILES['image']['name'];
    $new_images = [];

    if (!empty($uploaded_files[0])){ 
        $files = $_FILES['image'];

        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['tmp_name'][$key];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_uniqid = uniqid();
            $newFileName = $file_uniqid . "." . $extension;
            $folder = "../image/" . $newFileName;

            if (move_uploaded_file($file_tmp, $folder)) {
                $new_images[] = $newFileName; 
            }
        }
    }
    $allImages = array_merge($oldImages, $new_images);
    $images = json_encode($allImages);

    $id = $_POST['editId'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $permissiongroup = $_POST['permissiongroup'];
    $companyId = $_POST['companyId'];
    $agentcompany = $_POST['agentcompany'];
    $phone = $_POST['phone'];
    $notification = $_POST['notification'];
    $locked = $_POST['locked'];
    $image= $images;
    $user->editUser($firstname,$lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone,$notification,$locked,$image,$id);
    echo json_encode(array("statusCode" => 200, "message" => "User Updated Successfully."));
    die;
}


if ($task == 'delete'){
 
    $id = $_REQUEST['id'];
    $user->deleteUser($id);
    echo json_encode(array("statusCode" => 200, "message" => "User Deleted."));
    die;
} 

if($task == 'deleteImage'){ 
        
        $uid = $_POST['uid'];
        $imgId = $_POST['imgId'];

        $stmt = $db->prepare("select image from users where id=:id");
        $stmt->bindValue(':id',$uid,PDO::PARAM_STR);
        $stmt->execute();
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        $oldImages = json_decode($result['image'],true);
        
        $imgArray = [];
    
        foreach($oldImages as $img=>$value){

            if($img == $imgId){
   
                $imagePath = '../image/'.$img;
            
                if(file_exists($imagePath)){

                    unlink($imagePath); 
                    
                }else{

                $imgArray[] = $value;            
            }  
        }        
      
       $updateImage = json_encode($imgArray);         
       $stmt=$db->prepare("update users set image=:image where id=:id");
       $stmt->bindValue(':id',$uid,PDO::PARAM_STR);
       $stmt->bindValue(':image',$updateImage,PDO::PARAM_STR);
       $stmt->execute();
       echo json_encode(array("statusCode"=>200,"message"=>"Image Deleted"));
       die;
}
}

if($task == 'userCheck'){
  
    $email = $_POST['mail'];
    $stmt = $db->prepare("SELECT email FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['userEmail'] = $user;

    if(!$user){
        echo json_encode(array("StatusCode" => 201 ,"message" => "Your E-mail isn't registered!"));
    }else{
        echo json_encode(array("StatusCode" => 200 ,"message" => "Email Founded"));
       
       // send otp mail

    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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

    }
}


?>