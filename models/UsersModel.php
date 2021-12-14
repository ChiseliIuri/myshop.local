<?php
/**
 *Model pentru tabelul utilizatorilor
 *
 */

/**
 * Inregistrarea unui nou utilizator
 *
 * @param string $email posta
 * @param string $pwdMD5 paraola criptata in MD5
 * @param string $name numele utilizatorului
 * @param string $phone telefonul
 * @param string $address adresa utilizatorului
 * @return array masivul de date a utilizatorului nou
 */


function registerNewUser($email, $pwdMD5, $name, $phone, $address)
{
    //sanitarizarea datelor
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));
    //sql query
    $sql = "
    insert into users (`email`, `pwd`, `name`, `phone`, `address`) 
    VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$address}');
    ";
    $rs = mysql_query($sql);
    if ($rs) {
        $sql = "
        SELECT * FROM users 
        WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
        LIMIT 1;";
        $rs = mysql_query($sql);
        $rs = createSmartyRsArray($rs);
        if (isset($rs[0])) {
            $rs['success'] = 1;
        } else {
            $rs['success'] = 0;
        }
    } else {
        $rs['success'] = 0;
    }
    return $rs;
}

/**
 * Validarea parametrilor pentru inregistrarea unui user
 *
 * @param string $email email
 * @param string $pwd1 parola 1
 * @param string $pwd2 parola 2
 * @return array result
 */

function checkRegisterParams($email, $pwd1, $pwd2){
    $res['success'] = true;
    $res['message'] = "";
    if (!$email){
        $res['success'] = false;
        $res['message']  .= 'Introduceti email-ul ';
    }
    if (!$pwd1){
        $res['success'] = false;
        $res['message']  .= 'Introduceti parola ';
    }
    if (!$pwd2 && $pwd1){
        $res['success'] = false;
        $res['message']  .= 'Introduceti parola repetat ';
    }
    if ($pwd1 != $pwd2){
        $res['success'] = false;
        $res['message']  .= 'Parolele NU conincid! ';
    }
    return $res;
}

/**
 * Controlam posta(daca emailul exista in baza de date)
 *
 * @param string $email
 * @returns array masiv- rand din tabelul users sau masiv gol
 */
function checkUserEmail($email){
    $email = mysql_real_escape_string($email);
    $sql = "SELECT id FROM users WHERE email =  '{$email}'";
    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);
    return $rs;
}

/**
 * Autorizarea utilizatorului
 *
 * @param string $email posta (login)
 * @param string $pwd parola
 * @return array masiv de date a utilizatorului
 */

function loginUser($email, $pwd){
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $pwd = md5($pwd);

    $sql = "SELECT * FROM users 
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";

    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);

    if (isset($rs[0])){
        $rs['success']  = 1;
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

/**
 * Modify user data
 *
 * @param string $name numele utilizatorului
 * @param string $phone telefon
 * @param string $address adresa
 * @param string $pwd1 prima introducere a parolei noi
 * @param string $pwd2 2 a doua introducere a parolei noi
 * @param string $curPwd parola veche
 * @returns boolean TRUE in caz de success
 */
function updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd){
    $email = htmlspecialchars(mysql_real_escape_string($_SESSION['user']['email']));
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);

    $newPwd = null;
    if ($pwd1 && ($pwd1 == $pwd2)){
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE users SET";

    if ($newPwd){
        $sql .= "`pwd` = '{$newPwd}'";
    }

    $sql .= "
    `name` ='{$name}',
    `phone` ='{$phone}',
    `address`='{$address}',
    WHERE
    `email`='{$email}' AND `pwd`='{$curPwd}'
    LIMIT 1;
    ";
    $rs = mysql_query($sql);
    return $rs;
}