<?php
/**
 * Model pentru tabelul orders
 *
 */

/**
 * Order creation (without link with product)
 *
 * @param string $name
 * @param string $phone
 * @param string $address
 * @return int id of created order
 */
function makeNewOrder ($name, $phone, $address){
    //initializrea variabililor
    $userId = $_SESSION['user']['id'];
    //trebuie de sanitarizat datele in viitor!!!+++++++++++++++++++++++++++++++++++++++++++++++++++++
    $comment = "User id: {$userId}<br/> Name: {$name}<br/> Phone: {$phone}<br/> Address: {$address}";

    $dateCreated = date('Y.m.d H:i:s');
    $userIp = $_SERVER['REMOTE_ADDR'];

    //formam sql query
        $sql = "INSERT INTO orders ( user_id, date_created, comment, user_ip) VALUES (
    '{$userId}', '{$dateCreated}', '{$comment}', '{$userIp}'
    );
    ";
    $rs = mysql_query($sql);
    $sql = "SELECT LAST_INSERT_ID();";
    $rs = mysql_query($sql);
    $id = mysql_fetch_assoc($rs);
    return $id['LAST_INSERT_ID()'];

}