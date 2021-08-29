<?php

/**
 *
 * CONTROLERUL PAGINII PRINCIPALE
 *
*/

//conectam models
include_once '../models/CategoriesModel.php';

function testAction(){
    echo 'IndexController.php > testAction';
}

function indexAction($smarty){

    $rsCategories = getAllCatsWithChildren();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('head', 'MyShop');
    $smarty->assign('pageTitle', 'Principala Pagina a site-ului');
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}