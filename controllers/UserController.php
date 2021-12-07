<?php
/**
 *Controller pentru lucrul cu utilizatorii
 *
 */

//conectam modelelele
include_once '../models/CategoriesModel.php';
include_once '../models/UsersModel.php';

/**
 * AJAX inregistrarea userului
 * Initializarea variabilei de sesiune ($_SESSION['user'])
 *
 * @return json masiv de date a utiliztorului nou
 */

function registerAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);

    $resData = null;
    $resData = checkRegisterParams($email, $pwd1, $pwd2);

    if(!$resData && checkUserMail($email)){
        $resData['success'] = false;
        $resData['message']  = "Utilizator cu asa email('$email')deja exista!";
    }

    if(!$resData){
        $pwdMD5 = md5($pwd1);
        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $address);
        if($userData['success']){
            $resData['message'] = 'Utilizatorul este cu succes inregistrat';
            $resData['success'] = 1;

            $userData = $userData[0];
            $resData['userName']  = $userData['name'] ? $userData['name'] : $userData['email'];
            $resData['userEmail'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
        } else {
            $resData['success'] = 0;
            $resData['message']  = 'Eroare de inregistrare';
        }
    }
}