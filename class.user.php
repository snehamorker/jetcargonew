<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');

class user{
public function addUser($firstname, $lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone, $notification,$locked){
    
    $db = new db();
    try{
        $stmt = $db->prepare("INSERT into users(firstname, lastname, email, password, permissiongroup,companyId,agentcompany,phone,notification,locked) 
    VALUES(:firstname, :lastname, :email, :password, :permissiongroup, :companyId, :agentcompany, :phone, :notification, :locked)");

    $stmt->bindValue(':firstname',$firstname,PDO::PARAM_STR);
    $stmt->bindValue(':lastname',$lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email',$email, PDO::PARAM_STR);
    $stmt->bindValue(':password',$password, PDO::PARAM_STR);
    $stmt->bindValue(':permissiongroup',$permissiongroup, PDO::PARAM_INT);
    $stmt->bindValue(':companyId',$companyId, PDO::PARAM_INT);
    $stmt->bindValue(':agentcompany',$agentcompany, PDO::PARAM_STR);
    $stmt->bindValue(':phone',$phone, PDO::PARAM_STR);
    $stmt->bindValue(':notification',$notification, PDO::PARAM_STR);
    $stmt->bindValue(':locked',$locked, PDO::PARAM_BOOL);
    $stmt->execute();

    } catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
}

public function editUser($firstname,$lastname,$email,$password,$permissiongroup,$companyId,$agentcompany,$phone,$notification,$locked,$id){
   
    $db= new db();
    try{

        $stmt = $db->prepare('UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, permissiongroup=:permissiongroup, companyId=:companyId, agentcompany=:agentcompany, phone=:phone, notification=:notification, locked=:locked WHERE `id`=:id');
        $stmt->bindValue(':firstname',$firstname,PDO::PARAM_STR);
        $stmt->bindValue(':lastname',$lastname,PDO::PARAM_STR);
        $stmt->bindValue(':email',$email,PDO::PARAM_STR);
        $stmt->bindValue(':password',$password,PDO::PARAM_STR);
        $stmt->bindValue(':permissiongroup',$permissiongroup,PDO::PARAM_INT);
        $stmt->bindValue(':companyId',$companyId,PDO::PARAM_INT);
        $stmt->bindValue(':agentcompany',$agentcompany,PDO::PARAM_STR);
        $stmt->bindValue(':phone',$phone,PDO::PARAM_STR);
        $stmt->bindValue(':notification',$notification, PDO::PARAM_STR);
        $stmt->bindValue(':locked',$locked,PDO::PARAM_STR);
        $stmt->bindValue(":id",$id, PDO::PARAM_STR);
        $stmt->execute();       
    } catch(PDOException $e){
        echo $e->getMessage();
        exit;

    }
}
public function deleteUser($id){
    $db = new db();
    try{
        //$id = $_POST['id'];
        $stmt = $db->prepare("delete from users WHERE id=:id");
        $stmt->bindParam(":id",$id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e){
        echo $e->getMessage();
        exit;        
    }
    
}

}

?>