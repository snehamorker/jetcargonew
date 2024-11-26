<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/const.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/Classes/class.user.php');

$task = $_GET['task'];
$db = new db();
$user = new user();

if ($task == 'display') {
    $sql = "select * from users";
    $select = $db->prepare($sql);
    $select->execute();
    $selectdata = $select->fetchAll(PDO::FETCH_ASSOC);
    // print_r(($select->fetchAll()));
    echo json_encode(["data"=>$selectdata]);
    exit();
}

if ($task == 'getsingledata') {
    
    $id = base64_decode($_POST['id']);
    $sql = "select * from users where id=:id";
    $select = $db->prepare($sql);
    $select->bindValue(':id',$id,PDO::PARAM_STR);
    $select->execute();
    $selectdata = $select->fetch(PDO::FETCH_ASSOC);
    echo json_encode(["data"=>$selectdata]);
   //print_r($selectdata);
    die;

}

if ($task == 'add') {
    
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

    $user->addUser($firstname, $lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone, $notification,$locked);
    //print_r($user);
    echo json_encode(array("statusCode" => 200, "message" => "User Added Successfully."));
}

if ($task == 'edit') {
   
    $id = $_POST['id'];
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

    $user->editUser($firstname,$lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone,$notification,$locked,$id);
    echo json_encode(array("statusCode" => 200, "message" => "User Updated Successfully."));
    die;
}

if ($task == 'delete') {
 
    $id = $_REQUEST['id'];
    $user->deleteUser($id);
    echo json_encode(array("statusCode" => 200, "message" => "User Deleted."));
    die;
} 

?>