<?php
header("Cache-Control: no-cache, no-store,  must-revalidate");
session_start();

//initializam variabila cosului
if(! isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
include_once '../config/config.php'; //initializarea setarilor
include_once '../config/db.php';
include_once '../library/mainFunctions.php'; //Functii principale

//indicam cu ce controller vom lucra
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'index';

//definim cu ce functie vom lucra:
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
//d($actionName,0);git

//Daca in sesiune exista datele despre utilizator atunci le transmitem sablonului
if (isset($_SESSION['user'])){
    $smarty->assign('arUser', $_SESSION['user']);
}
//Initializam variabila smarty ce contine versiunea aleatorie pentru incarcarea instantanee a css fileului
$smarty->assign('rand', rand());
//Initializa variabila ce contine anul curent pentru footerul siteului
$smarty->assign('year',date('Y'));
//initializam variabila shablonizatorului care contine cantitatea de elemente in cos
$smarty->assign('cartCntItems', count($_SESSION['cart']));
loadPage($smarty, $controllerName, $actionName);