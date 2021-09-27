<?php
/**
 * Controller de lucru cu cosul de cumparaturi
 *
 */

include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * Adaugarea produsului in cos
 *
 * @param integer id GET parametru - id-ul produsului adaugat
 * @return json informatia despre operatiune (succes, cantitatea de elemente in cos)
 */
function addtocartAction()
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId) return false;

    $resData = array();

    //daca continutul nu se gaseste atunci il adaugam
    if (isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false) {
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}

/**
 * Stergerea elementului din sessiune
 *
 * @param integer id GET parametru - id-ul produsului adaugat
 * @return json informatia despre operatiune (succes, cantitatea de elemente in cos)
 */
function removefromcartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId) exit();
    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if ($key!==false){
        unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}