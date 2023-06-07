<?php
/**
 * AdminController.php
 *
 * Controllerul back-endului siteului
 *
 */

//conectam modelele
//include_once '../models/CategoriesModel.php';
//include_once '../models/ProductsModel.php';
//include_once '../models/OrdersModel.php';
//include_once '../models/PurchaseModel.php';
class AdminController
{
//INCARCAM IN SMARTY TEMPLATES A MEDIULUI ADMIN
    private Object $purchase;
    private Object $category;
    private Object $order;
    private Object $product;
    private Object $smarty;
    function __construct($smarty){
        $this->category = new CategoriesModel();
        $this->purchase = new PurchaseModel();
        $this->order = new OrdersModel();
        $this->product = new ProductsModel();
        $this->smarty = $smarty;
        $this->smarty->setTemplateDir(ConstConfig::TEMPLATE_ADMIN_PREFIX);
        $this->smarty->assign('templateWebPath', ConstConfig::TEMPLATE_ADMIN_WEB_PATH);
    }

    function indexAction()
    {
        $rsCategories = $this->category->getAllMainCategories();
        $this->smarty->assign('rsCategories', $rsCategories);
        $this->smarty->assign('pageTitle', 'ADMINKA');
        Router::loadTemplate($this->smarty, 'adminHeader');
        Router::loadTemplate($this->smarty, 'admin');
        Router::loadTemplate($this->smarty, 'adminFooter');
    }

    /**
     * Action for adding new categories
     *
     * @return json array with response data
     */
    function addnewcatAction()
    {
        $catName = $_POST['newCategoryName'];
        $catParentId = $_POST['generalCatId'];
        $res = $this->category->insertCat($catName, $catParentId);

        if ($res) {
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
    function categoryAction()
    {
        $rsCategories = $this->category->getAllCategories();
        $rsMainCategories = $this->category->getAllMainCategories();

        $this->smarty->assign('rsCategories', $rsCategories);
        $this->smarty->assign('rsMainCategories', $rsMainCategories);
        $this->smarty->assign('pageTitle', 'ADMINKA');

        Router::loadTemplate($this->smarty, 'adminHeader');
        Router::loadTemplate($this->smarty, 'adminCategory');
        Router::loadTemplate($this->smarty, 'adminFooter');
    }

    /**
     * Realize process of updating categories data
     *
     * @return false|string return json
     */

    function updatecategoryAction()
    {

        $itemId = $_POST['itemId'];
        $parentId = $_POST['parentId'];
        $name = $_POST['newName'];

        if ($this->category->updateCategoryData($itemId, $parentId, $name)) {
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

    function productsAction()
    {
        $rsCategories = $this->category->getAllChildCategories();
        $rsProducts = $this->product->getProducts();

        $this->smarty->assign('rsCategories', $rsCategories);
        $this->smarty->assign('rsProducts', $rsProducts);
        $this->smarty->assign('pageTitle', 'Site Administration');

        Router::loadTemplate($this->smarty, 'adminHeader');
        Router::loadTemplate($this->smarty, 'adminProducts');
        Router::loadTemplate($this->smarty, 'adminFooter');
    }

    /**
     * Add new product
     *
     * @return json array
     */
    function addproductAction()
    {
        $itemName = $_POST['itemName'];
        $itemPrice = $_POST['itemPrice'];
        $itemDesc = $_POST['itemDesc'];
        $itemCat = $_POST['itemCatId'];

        if ($this->product->insertProduct($itemName, $itemPrice, $itemDesc, $itemCat)) {
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
    function updateproductAction()
    {
        $itemId = $_POST['itemId'];
        $itemName = $_POST['itemName'];
        $itemPrice = $_POST['itemPrice'];
        $itemStatus = $_POST['itemStatus'];
        $itemDesc = $_POST['itemDesc'];
        $itemCat = $_POST['itemCatId'];

        $res = $this->product->updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);

        if ($res) {
            $resData['success'] = 1;
            $resData['message'] = "Updated with success;";
        } else {
            $resData['success'] = 0;
            $resData['message'] = "Some Error occurred!";
        }
        echo json_encode($resData);
        return;
    }

    /**
     * Uploading image
     *
     */
    function uploadAction()
    {
        $maxSize = 2 * 1024 * 1024;
        $itemId = $_POST['itemId'];
        //primim extensia fileului incarcabil
        $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
        //cream denumirea fileului
        $newFileName = $itemId . '.' . $ext;

        if ($_FILES['filename']['size'] > $maxSize) {
            echo('File size exceeds 2 MB');
            return;
        }

        //controlam daca fileul este incarcat
        if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
            //daca fileul este incarcat il mutam din directoria teporara in directoria finala
            $res = move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $newFileName);
            if ($res) {
                $res = $this->product->updateProductImage($itemId, $newFileName);
                if ($res) {
                    Router::redirect('/admin/products/');
                }
            }
        } else {
            echo("Error of loading file");
        }
    }

    /**
     * Main controller for order page
     *
     */
    function ordersAction()
    {
        $rsOrders = $this->order->getOrders();

        $this->smarty->assign('rsOrders', $rsOrders);
        $this->smarty->assign('pageTitle', 'Orders');

        Router::loadTemplate($this->smarty, 'adminHeader');
        Router::loadTemplate($this->smarty, 'adminOrders');
        Router::loadTemplate($this->smarty, 'adminFooter');
    }

    /**
     * Set order status
     *
     */
    function setorderstatusAction()
    {
        $itemId = $_POST['itemId'];
        $status = $_POST['status'];

        if ($this->order->updateOrderStatus($itemId, $status)) {
            $resData['success'] = 1;
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Error of setting new status';
        }

        echo json_encode($resData);
    }

    /**
     * Set Order Date Payment
     *
     */
    function setorderdatePaymentAction()
    {
        $itemId = $_POST['itemId'];
        $datePayment = $_POST['datePayment'];

        if ($this->order->updateOrderDatePayment($itemId, $datePayment)) {
            $resData['success'] = 1;
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Error of setting payment date';
        }

        echo json_encode($resData);
    }

    function destroycategoryAction()
    {
        $catId = intval($_POST['catId']);
        if ($this->category->deleteCategoryById($catId)) {
            $resData['success'] = 1;
            $resData['message'] = 'Category Successfully deleted';
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Stoto ne tac uioba';
        }
        echo json_encode($resData);
    }

    function destroyproductAction()
    {
        $prodId = intval($_POST['prodId']);
        if ($this->product->deleteProductById($prodId)) {
            $resData['success'] = 1;
            $resData['message'] = 'Product Successfully deleted';
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Stoto ne tac uioba';
        }
        echo json_encode($resData);
    }
}