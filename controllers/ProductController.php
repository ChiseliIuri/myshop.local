<?php

class ProductController
{
    /**
     * productController.php
     *
     *Контроллер страницы продуктов (/product/1)
     *
     */
    private Object $product;
    private Object $category;
    function __construct(){
        $this->product = new ProductsModel();
        $this->category = new CategoriesModel();
    }

    /**
     * Formam paginile categoriilor
     *
     * @param object $smarty shablonizator
     */
    function indexAction($smarty)
    {
        $prodId = isset($_GET['id']) ? intval($_GET['id']) : null;
        if ($prodId == null) exit();
        $product = $this->product->getProductById($prodId);
        $cat = $this->category->getCatByID($product['category_id']);
        $rsCategories = $this->category->getAllCatsWithChildren();

        if (empty($product)) {
            $product = null;
        }

        $smarty->assign('itemCart', 0);
        if (in_array($prodId, $_SESSION['cart'])) {
            $smarty->assign('itemCart', 1);
        }

        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('product', $product);
        $smarty->assign('cat', $cat);
        $smarty->assign('head', $product['name']);

        Router::loadTemplate($smarty, 'header');
        Router::loadTemplate($smarty, 'product');
        Router::loadTemplate($smarty, 'footer');
    }

    /**
     * Functionalul cautarii
     *
     */

    function searchAction($smarty)
    {
        $string = $_GET['string'] ?? null;
        $string = htmlspecialchars($string);

        $rsCategories = $this->category->getAllCatsWithChildren();
        $rsProducts = $this->product->findThisFuckingProduct($string);

        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('rsFoundProducts', $rsProducts);
        $smarty->assign('head', 'MyShop');
        $smarty->assign('findPageTitle', 'Finds for ' . $string);

        Router::loadTemplate($smarty, 'header');
        Router::loadTemplate($smarty, 'search');
        Router::loadTemplate($smarty, 'footer');
    }
}