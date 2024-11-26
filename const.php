<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include($_SERVER["DOCUMENT_ROOT"] . "/jetcargonew/Admin/site_path.php");

define('DB_HOST', 'localhost');
define('DB_DATABASE', 'jetcargonew');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$base_url = pathUrl(__DIR__) . '/jetcargonew/Admin';
define('base_url', $base_url);

define('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"].'/jetcargonew/Admin');

define('EXEC', $base_url . "/Exec/");


define('VIEW', $base_url. "/View/");

define('Classes', $base_url . "/Classes/");



?>