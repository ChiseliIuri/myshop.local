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
 * @return array
 */
function createSmartyRsArray($rs){

    if(! $rs) return false;

    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}


/**
 *Преобразование результата работы функции выборки в ассоциативный массив с PDO
 *
 * @param $rs
 * @return array
 */
function createSmartyRsArrayPDO($stmt){
    $result = array();
    try {
        $result[] = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e){
        echo $e->getMessage();
    }
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

/**
 * Implementation of mysql_field_name in mysqli
 *
 * @param $result
 * @param $field_offset
 * @return null
 */
function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}




















