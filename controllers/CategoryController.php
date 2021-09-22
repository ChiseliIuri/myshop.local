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
    $catID = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($catID == null) exit();
    $cats = array();
    $cats = getCatByID($catID);
    $rsProducts = null;
    $rsChildCats = null;

    if ($cats['parent_id'] == 0){
        $rsChildCats = getChildrenForCat($catID);
    } else {
        $rsProducts = getProductByCat($catID);
    }
    $rsCategories = getAllCatsWithChildren();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('cat', $cats);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    $smarty->assign('head', $cats['name']);

    loadTemplate($smarty, 'header2');
    loadTemplate($smarty, 'category');
    loadTemplate($smarty, 'footer');
}