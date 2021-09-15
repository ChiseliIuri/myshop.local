<?php

/**
 *
 * CONTROLERUL PAGINII PRINCIPALE
 *
*/

//conectam models
include_once '../models/CategoriesModel.php';

//make a test action
function testAction(){
    echo '__________________________IndexController.php > testAction____________________________________';
}

/**
 * Prepare smarty-vars and load templates for index page
 *
 * @param $smarty
 */
function indexAction($smarty){
    $rsCategories = getAllCatsWithChildren();
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('head', 'MyShop');
    $smarty->assign('pageTitle', 'Principala Pagina a site-ului');
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}