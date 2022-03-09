<?php
include_once '../config/db.php';
include_once '../library/mainFunctions.php';
////exec('C:\xampp\htdocs\myshop.local\tmp\smarty\templates_c\delete.js');
//$dbLocation = "127.0.0.1";
//$dbName = "myshop";
//$dbUser = "root";
//$dbPassword = "";
//
//try{
//    $db = new PDO("mysql:host=$dbLocation;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
//    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo 'Eroare de conectare la baza de date' . $e->getMessage();
//}

$db = new Db();
$sql = 'SELECT *
   FROM  categories
   WHERE parent_id = 0';

$rs = mysqli_query($db->connect,$sql);
print_r(createSmartyRsArray($rs));
