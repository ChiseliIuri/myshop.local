<?php
/**
 * AdminController.php
 *
 * Controllerul back-endului siteului
 *
 */

//conectam modelele
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

//INCARCAM IN SMARTY TEMPLATES A MEDIULUI ADMIN
$smarty->setTemplateDir(TEMPLATE_ADMIN_PREFIX);
$smarty->assign('templateWebPath', TEMPLATE_ADMIN_WEB_PATH);

function indexAction($smarty){

    $rsCategories = getAllMainCategories();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('pageTitle','ADMINKA');
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'admin');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Action for adding new categories
 *
 * @return json array with response data
 */
function addnewcatAction(){
    $catName = $_POST['newCategoryName'];
    $catParentId = $_POST['generalCatId'];
    $res = insertCat($catName, $catParentId);

    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Category Added';
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Error on adding category.';
    }

    echo json_encode($resData);
    return;
}

/**
 * Category administration page
 *
 * @param $smarty
 */
function categoryAction($smarty){
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('pageTitle', 'ADMINKA');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminCategory');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Realize process of updating categories data
 *
 * @return false|string return json
 */

function updatecategoryAction(){

    $itemId = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $name = $_POST['newName'];

    if (updateCategoryData($itemId, $parentId, $name)){
        $resData['success'] = 1;
        $resData['message'] = 'Successfully updated';
    } else {
        $resData['success'] = 0;
        $resData['message'] = "OOPS, Some error occurred during data updating :(";
    }
    echo json_encode($resData);
    return;
}

/**
 * Page of products control
 *
 * @param type smarty
 */

function productsAction($smarty){
    $rsCategories = getAllCategories();
    $rsProducts = getProducts();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('pageTitle', 'Site Administration');

    loadTemplate($smarty,'adminHeader');
    loadTemplate($smarty, 'adminProducts');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Add new product
 *
 * @return json array
 */
function addproductAction(){
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];

    if (insertProduct($itemName, $itemPrice, $itemDesc, $itemCat)){
        $resData['success'] = 1;
        $resData['message'] = 'Changes was successful introduced';
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Some error occurred during introducing data';
    }
    echo json_encode($resData);
    return;
}

/**
 * Update product data
 *
 * @return json array
 */
function updateproductAction(){
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemStatus = $_POST['itemStatus'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];

    $res = updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);

    if ($res){
        $resData['success'] = 1;
        $resData['message'] = "Updated with success;";
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Some Error occurred!";
    }
    echo json_encode($resData);
    return;
}