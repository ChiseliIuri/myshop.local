<?php
/**
 * categoryController.php
 *
 *Контроллер страницы категорий (/category/1)
 *
 */

//Conectam modelele
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * Formam paginile categoriilor
 *
 * @param object $smarty shablonizator
 */
function indexAction($smarty)
{
//    echo"Category Test";
    $catID = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($catID == null) exit();
    $cats = array();
    $cats = getCatByID($catID);
    debug($cats);

//    $smarty->assign('rsCategories', $rsCategories);
//    $smarty->assign('rsProducts', $rsProducts);
//    $smarty->assign('head', 'MyShop');
//    $smarty->assign('pageTitle', 'Principala Pagina a site-ului');
//
//    loadTemplate($smarty, 'header');
//    loadTemplate($smarty, 'index');
//    loadTemplate($smarty, 'footer');
}