<?php
/**
 * categoryController.php
 *
 *Контроллер страницы категорий (/category/1)
 *
 */

//Conectam modelele
//include_once '../models/CategoriesModel.php';
//include_once '../models/ProductsModel.php';
class CategoryController
{
    /**
     * Formam paginile categoriilor
     *
     * @param object $smarty shablonizator
     */
    function indexAction($smarty)
    {
        $category = new CategoriesModel();
        $product = new ProductsModel();
        $catID = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($catID == null) exit();
        $cats = array();
        $cats = $category->getCatByID($catID);
        $rsProducts = null;
        $rsChildCats = null;

        if ($cats['parent_id'] == 0) {
            $rsChildCats = $category->getChildrenForCat($catID);
        } else {
            $rsProducts = $product->getProductByCat($catID);
        }
        $rsCategories = $category->getAllCatsWithChildren();

        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('cat', $cats);
        $smarty->assign('rsProducts', $rsProducts);
        $smarty->assign('rsChildCats', $rsChildCats);
        $smarty->assign('head', $cats['name']);

        Router::loadTemplate($smarty, 'header');
        Router::loadTemplate($smarty, 'category');
        Router::loadTemplate($smarty, 'footer');
    }
}