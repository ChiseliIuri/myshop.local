<?php

/**
 *
 * FUNCTII PRINCIPALE
 *
*/

/**
 * Formarea Paginii apelate
 *
 * @param object $smarty obiect a clasei Smarty
 * @param string $controllerName denumirea controlerului
 * @param string $actionName denumirea functiei de prelucrare a paginii
*/
function loadPage($smarty, $controllerName, $actionName = 'index'){
    include_once PathPrefix . $controllerName . PathPostfix;
    $function = $actionName . 'Action';
    $function($smarty);
}

/**
 * Template loading
 *
 * @param object $smarty obiect a sablonizatorului
 * @param string $templateName denumirea file-ului sablonului
 */
function loadTemplate($smarty, $templateName){
    $smarty->display($templateName . TEMPLATE_POSTFIX);
}

/**
 * Функция отладки. Останавливает работу программы выводя значение переменной
 * $value
 *
 * @param variant $value переменная для вывода ее на страницу
 */
function debug($value = null, $die = 1){
    echo'Debug: <br/><pre>';
    print_r($value);
    echo'</pre>';
    if($die) die;
}

/**
 *Преобразование результата работы функции выборки в ассоциативный массив
 *
 * @param $rs
 * @return array|mixed
 */
function createSmartyRsArray($rs){

    if(! $rs) return false;

    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}
/**
 * Redirect
 *
 * @param string url
 */
function redirect($url){
    if(!$url) $url = '/';
    header("Location: {$url}");
    exit;
}























