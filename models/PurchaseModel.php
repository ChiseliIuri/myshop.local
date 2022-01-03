<?php
/**
 * Model for purchase table
 *
 */

/**
 * Introducing in DB product data with bind to order
 *
 * @param integer $orderId
 * @param array $cart
 * @return boolean TRUE if query was executed with success
 */
function setPurchaseForOrder($orderId, $cart){
    $sql = "INSERT INTO purchase (order_id, product_id, price, amount)
            VALUES";
    $values = array();
    //formam masivul de stringuri pentru query pentru fiecare produs
    foreach($cart as $item){
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }
    $sql .= implode($values, ', ');
    $rs = mysql_query($sql);

    return $rs;
}

/**
 * Get product data by order id
 *
 * @param $orderId
 * @return array array of products
 */
function getPurchaseForOrder($orderId){
    $sql = "
        SELECT `pe`.*, `ps`.name
        FROM purchase as `pe`
        JOIN products as ps
        ON pe.product_id = ps.id
        WHERE pe.order_id = {$orderId};
    ";
    $rs = mysql_query($sql);

    $purchases = array();
    while($row = mysql_fetch_assoc($rs)){
        $purchases[]= $row;
    }
    return $purchases;
}