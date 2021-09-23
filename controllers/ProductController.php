<?php

/**
 * productController.php
 *
 *Контроллер страницы продуктов (/product/1)
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
    $prodId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($prodId == null) exit();
    $product = getProductById($prodId);
    $cat = getCatByID($product['category_id']);
    $rsCategories = getAllCatsWithChildren();

    if (empty($product)){
        $product = null;
    }
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('product', $product);
    $smarty->assign('cat', $cat);
    $smarty->assign('head', $product['name']);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}