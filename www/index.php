<?php
session_start();

//if(!){
//
//}
include_once '../config/config.php'; //initializarea setarilor
include_once '../config/db.php';
include_once '../library/mainFunctions.php'; //Functii principale

//indicam cu ce controller vom lucra
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'index';

//definim cu ce functie vom lucra:
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
//d($actionName,0);git

loadPage($smarty, $controllerName, $actionName);
