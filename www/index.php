<?php
header("Cache-Control: no-cache, no-store,  must-revalidate");
session_start();

spl_autoload_register (function ($class) {
    if (str_contains($class, 'Controller')) {
        include_once "../controllers/" . $class . '.php';
    } else if (str_contains($class, 'Model')){
        include_once "../models/" . $class . '.php';
    } else if (str_contains($class, 'Config')){
        include_once "../config/" . $class . '.php';
    } else if (str_ends_with($class, 'Smarty')){
        include_once "../vendor/smarty/smarty/libs/" . $class . ".class.php";
    } else if (str_contains($class, 'Db')){
        include_once "../config/DbConfig.php";
    } else if (str_contains($class, 'Data')){
        include_once "../library/Data.php";
    } else if (str_contains($class, 'Logger')){
        include_once "../library/Logger.php";
    } else if (str_contains($class, 'Router')){
        include_once "../library/Router.php";
    }
});

//initializam variabila cosului
if(! isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$smarty = new Smarty();
$smarty->setTemplateDir(ConstConfig::TEMPLATE_PREFIX_FLEX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');
$smarty->assign('templateWebPath',ConstConfig::TEMPLATE_WEB_PATH_FLEX);

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
$route = new Router();
$route->loadPage($smarty, $controllerName, $actionName);
