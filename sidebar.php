<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/const.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');

if (!isset($_SESSION['indentity'])) {
    header("location:/Admin/View/login.php");
      //$_SERVER["DOCUMENT_ROOT"]. '/jetcargonew/Admin'
     
    }

    $file = $_SERVER['PHP_SELF'];
    $path = explode("/", $file);
    
    $db = new db();
    $email = $_SESSION['email'];
    $query = "select * from users where email='$email'";
    $data = $db->prepare($query);
    $data->execute();
    $userdatafetch = $data->fetch(PDO::FETCH_ASSOC);
    print_r($userdatafetch);
    error_reporting(0);

?>
