<?php
/**
 * Controller de lucru cu cosul de cumparaturi
 *
 */

include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

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
function removefromcartAction()
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId) exit();
    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}

/**
 * Formarea paginii cosului.
 * @link /cart/
 * @param $smarty
 */
function indexAction($smarty)
{
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

    $rsCategories = getAllCatsWithChildren();
    $rsProducts = getProductsfromArray($itemsIds);

    //Calculam suma preturilor produselor alese

    $sum = 0;
    if (!empty($rsProducts)) {
        for ($i = 0; $i <= sizeof($rsProducts) - 1; $i++) {
            $sum = $sum + $rsProducts[$i]['price'];
        }
    }
    $itemsIds = json_encode($itemsIds);
    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('head', 'Cart');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('sum', $sum);
    $smarty->assign('itemsIds',$itemsIds);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}

/**
 * Formarea paginii comenzii
 *
 */

function orderAction($smarty){
    //prmim masivul identificatorilor productelor cosului
    $itemIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    //daca cosul este gol facem redirect pe pagina cosului
    if (!$itemIds){
        redirect('/cart/');
        return;
    }

    $itemsCnt = array();
    foreach($itemIds as $item){
        $postVar = 'itemCnt_' . $item;
        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }
    $rsProducts = getProductsfromArray($itemIds);
    //adaugat la fiecare product un camp adaugator
    //realPrice = cantitatea produselor * pretul productelor
    //cnt = canticatea prodului cumparat

    //&$item &- inseamna ca daca vom modifica valoarea $item inauntrul ciclului
    //ea se va modifica la fel si in $rsProducts
    $i = 0;
    foreach($rsProducts as &$item){
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 0;
        if ($item['cnt']){
            $item['realPrice'] = $item['cnt'] * $item['price'];
        } else {
            //daca sa primit ca produsul in cos este iar cantitatea = 0 atunci stergem produsul
            unset($rsProducts[$i]);
        }
        $i++;
    }

    if (!$rsProducts){
        echo 'Cosul este gol';
        return;
    }

    //Masivul produselor dorite le inscriem in variabila de sessiune
    $_SESSION['saleCart'] = $rsProducts;

    //hideLoginBox variabila-flag creata pentru a ascunde blocurile login-ului si inregistrarii in leftColumn
    $rsCategories = getAllCatsWithChildren();

    if (!isset($_SESSION['user'])){
        $smarty->assign('hideLoginBox', 1);
    }

    $smarty->assign('pageTitle', 'Order');
    $smarty->assign('head', 'Order');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}

/**
 * AJAX functia salvarii comenzii
 *
 * @param array $_SESSION['saleCart'] masivul productelor spre cumparare
 * @return json informatia despre rezultatul executarii
 */
function saveorderAction(){
    //primim masivul cumparaturilor
    $cart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : null;
    //daca cosul este gol formam raspuns cu eroare, si il dam in format json
    if(!$cart){
        $resData['success'] = 0;
        $resData['message'] = 'NU sunt produse pentru comanda';
        echo json_encode($resData);
        return;
    }
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;

    // cream o comanda noua si primim id-ul ei
    $orderId = makeNewOrder($name, $phone, $address);

    //daca comanda nu a fost salvata formam mesajul erorii si terminam executarea functiei
    if (!$orderId){
        $resData['success'] = 0;
        $resData['message']='Error of order creation';
        echo json_encode($resData);
        return;
    }

    //salvam produsele pentru comanda creata
    $res = setPurchaseForOrder($orderId, $cart);

    //daca sa salvat cu success, formam raspuns, stergem variabilile cosului
    if ($res){
        $resData['success'] = 1;
        $resData['message'] = 'Order saved';
        unset($_SESSION['cart']);
        unset($_SESSION['saleCart']);
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Error of introducing data of order #' . $orderId;
    }
    echo json_encode($resData);
}






















