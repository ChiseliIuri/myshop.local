<?php
/**
 *Controller pentru lucrul cu utilizatorii
 *
 */

//conectam modelele
//include_once '../models/CategoriesModel.php';
//include_once '../models/UsersModel.php';
//include_once '../models/OrdersModel.php';
//include_once '../models/PurchaseModel.php';
class UserController
{
    /**
     * AJAX inregistrarea userului
     * Initializarea variabilei de sesiune ($_SESSION['user'])
     *
     * @return json masiv de date a utiliztorului nou
     */

    private Object $purchase;
    private Object $category;
    private Object $order;
    private Object $user;
    function __construct(){
        $this->category = new CategoriesModel();
        $this->purchase = new PurchaseModel();
        $this->order = new OrdersModel();
        $this->user = new UsersModel();
    }

    function registerAction()
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
        $email = trim($email);

        $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
        $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;

        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
        $name = trim($name);

        $resData = null;
        $resData = $this->user->checkRegisterParams($email, $pwd1, $pwd2);

        if ($this->user->checkUserEmail($email)) {
            $resData['success'] = false;
            $resData['message'] = "Utilizator cu asa email('$email')deja exista!";
        }

        if ($resData['success'] == true) {
            $pwdMD5 = md5($pwd1);
            $userData = $this->user->registerNewUser($email, $pwdMD5, $name, $phone, $address);
            if ($userData['success']) {
                $resData['message'] = 'Utilizatorul este cu succes inregistrat';
                $resData['success'] = 1;

                //pentru a simplifica accesul catre masivul pe indexul 0 il reinscriem direct in masivul de sus
                $userData = $userData[0];
                $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
                $resData['userEmail'] = $email;

                $_SESSION['user'] = $userData;
                $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
            } else {
                $resData['success'] = 0;
                $resData['message'] = 'Eroare de inregistrare';
            }
        }
        echo json_encode($resData);
    }

    /**
     * Delogarea utilizatorului
     *
     */
    function logoutAction()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['cart']);
        }
//    redirect('/');
    }

    /**
     * AJAX autorizarea utilizatorului
     *
     * @returns json masiv cu datele utilizatorului
     */

    function loginAction()
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
        $email = trim($email);

        $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
        $pwd = trim($pwd);

        $userData = $this->user->loginUser($email, $pwd);

        if ($userData['success']) {
            $userData = $userData[0];

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];

            $resData = $_SESSION['user'];
            $resData['success'] = 1;
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Loghin sau Parola incorecta';
        }
        echo json_encode($resData);
    }

    /**
     * Formarea paginii principale a utilizatorului
     *
     * @link /user/
     * @param object $smarty sablonizator
     */

    function indexAction($smarty)
    {
        if (!isset ($_SESSION['user'])) {
            Router::redirect('/');
        }

        //Primim lista categoriilor pentru menu
        $rsCategories = $this->category->getAllCatsWithChildren();

        //primim lista comenzilor utilizatorului
        $rsUserOrders = $this->user->getCurUserOrders();

        $smarty->assign('pageTitle', 'User Page');
        $smarty->assign('head', 'User Page');
        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('rsUserOrders', $rsUserOrders);

        Router::loadTemplate($smarty, 'header');
        Router::loadTemplate($smarty, 'user');
        Router::loadTemplate($smarty, 'footer');
    }

    /**
     * Reinoirea datelor utilizatorului
     *
     * @return json rezultat a executarii functiei
     */

    function updateAction()
    {
        if (!isset($_SESSION['user'])) {
            Router::redirect('/');
        }

        //>Initializarea variabililor
        $resData = array();
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
        $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
        $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;
        $curPwd = isset($_REQUEST['curPwd']) ? $_REQUEST['curPwd'] : null;
        //<

        $curPwdMD5 = md5($curPwd);
        if (!$curPwd || ($_SESSION['user']['pwd']) != $curPwdMD5) {
            $resData['success'] = false;
            $resData['message'] = 'Parola curent nu este corecta';
            echo json_encode($resData);
            return false;
        }

        $res = $this->user->updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwdMD5);

        if ($res) {
            $resData['success'] = true;
            $resData['message'] = 'Saved data';
            $resData['userName'] = $name;

            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['phone'] = $phone;
            $_SESSION['user']['address'] = $address;
            $newPwd = $_SESSION['user']['pwd'];
            if ($pwd1 && ($pwd1 == $pwd2)) {
                $newPwd = md5(trim($pwd1));
            }
            $_SESSION['user']['pwd'] = $newPwd;
            $_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
        } else {
            $resData['success'] = false;
            $resData['message'] = "Ieroare de salvare a datelor";
        }

        echo json_encode($resData);
    }

    /**
     * TEST get excel
     *
     */
    function getexcelAction()
    {
        $this->user->printExcel();
    }
}