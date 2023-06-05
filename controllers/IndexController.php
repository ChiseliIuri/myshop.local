<?php

/**
 *
 * CONTROLERUL PAGINII PRINCIPALE
 *
*/

//conectam models
//include_once '../models/CategoriesModel.php';
//include_once '../models/ProductsModel.php';

class IndexController {
    /**
     * Prepare smarty-vars and load templates for index page
     *
     * @param $smarty
     */
    function indexAction($smarty){
        $category = new CategoriesModel();
        $product = new ProductsModel();
        $rsCategories = $category->getAllCatsWithChildren();
        $rsProducts = $product->getLastProduct(16);

        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('rsProducts', $rsProducts);
        $smarty->assign('head', 'MyShop');
        $smarty->assign('pageTitle', 'Principala Pagina a site-ului');

        Router::loadTemplate($smarty, 'header');
        Router::loadTemplate($smarty, 'index');
        Router::loadTemplate($smarty, 'footer');
    }
}