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