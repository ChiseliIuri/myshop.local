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
    $db = new Db;
    $db = $db->connect;
    //sanitarizarea datelor
    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($db, $phone));
    $address = htmlspecialchars(mysqli_real_escape_string($db, $address));
    //sql query
    $sql = "
    insert into users (`email`, `pwd`, `name`, `phone`, `address`) 
    VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$address}');
    ";
    $rs = mysqli_query($db, $sql);
    if ($rs) {
        $sql = "
        SELECT * FROM users 
        WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
        LIMIT 1;";
        $rs = mysqli_query($db, $sql);
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
function checkUserEmail(string $email){
    $db = new Db;
    $db = $db->connect;
    $email = mysqli_real_escape_string($db, $email);
    $sql = "SELECT id FROM users WHERE email =  '{$email}'";
    $rs = mysqli_query($db,$sql);
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
    $db = new Db;
    $db = $db->connect;
    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $pwd = md5($pwd);

    $sql = "SELECT * FROM users 
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";

    $rs = mysqli_query($db, $sql);
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
    $db = new Db;
    $db = $db->connect;
    $email = htmlspecialchars(mysqli_real_escape_string($db, $_SESSION['user']['email']));
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($db, $phone));
    $address = htmlspecialchars(mysqli_real_escape_string($db, $address));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);

    $newPwd = null;
    if ($pwd1 && ($pwd1 == $pwd2)){
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE users SET";

    if ($newPwd){
        $sql .= "`pwd` = '{$newPwd}',";
    }

    $sql .= "
    `name` ='{$name}',
    `phone` ='{$phone}',
    `address`='{$address}'
    WHERE
    `email`='{$email}' AND `pwd`='{$curPwd}'
    LIMIT 1;
    ";

//    debug($sql,0);
    $rs = mysqli_query($db, $sql);
    return $rs;
}

/**
 * Primirea datelor comenzilor utilizatorului curent
 *
 * @return array masivul comenzilor cu conexiune spre producte
 */
function getCurUserOrders(){
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $rs = getOrdersWithProductsByUser($userId);

    return $rs;
}

/**
 * Print excel
 *
 */

function printExcel(){
    $db = new Db;
    $db = $db->connect;
    /*******EDIT LINES 3-8*******/

    $filename = "excelfilename";         //File Name
    /*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/

    $result = mysqli_query($db, 'SELECT * FROM PRODUCTS;');
    $file_ending = "xlsx";
    //header info for browser
    header("Content-Type: application/xls");
    header("Accept-Encoding: utf-8, iso-8859-1;q=0.5");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    /*******Start of Formatting for Excel*******/
    //define separator (defines columns in excel & tabs in word)
    $sep = "\t"; //tabbed character
    //start of printing column names as names of MySQL fields
    for ($i = 0; $i < mysqli_num_fields($result); $i++) {
        echo mysqli_field_name($result,$i) . "\t";
    }
    print("\n");
//end of printing column names
//start while loop to get data
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
}








