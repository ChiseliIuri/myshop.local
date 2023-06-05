<?php

use JetBrains\PhpStorm\NoReturn;

class Router {
    function loadPage($smarty, $controllerName, $actionName = 'index'): void
    {
        $controllerName = ucfirst($controllerName);
        $controllerName = $controllerName . ConstConfig::CONTROLLER_POSTFIX;
        $controller = new $controllerName();
        $function = $actionName . 'Action';
        $controller->$function($smarty);
    }
    static function redirect($url){
        if(!$url) $url = '/';
        header("Location: {$url}");
        exit;
    }
    /**
     * Template loading
     *
     * @param object $smarty obiect a sablonizatorului
     * @param string $templateName denumirea file-ului sablonului
     */
    static function loadTemplate($smarty, $templateName){
        $smarty->display($templateName . ConstConfig::TEMPLATE_POSTFIX);
    }
}