<?php

/**
 * Model pentru tabela products
 *
 */

/**
 * Intoarce ultimele producte inregistrate in limita data. daca nu este indicata limita intoarce toate productele
 * in ordine de la ultimul.
 *
 * @param null $limit limita numarului productelor
 * @return array|false|mixed masiv de producte
 */
function getLastProduct($limit = null){
    $sql = 'SELECT * FROM products 
            ORDER BY id DESC';

    if ($limit){
        $sql .= " LIMIT ".intval($limit);
    }
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 * Intoarce productele categoriei alelese.
 *
 * @param $catID id-ul categoriei necesare
 * @return array|false|mixed masiv de producte
 */
function getProductByCat($catID){
    $sql = "SELECT * FROM products where category_id = '{$catID}'";
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 * Intoarce toata info despre un anumit product dupa id-ul lui
 *
 * @param $prodId id-ul productului
 * @return array|false|mixed
 */
function getProductById($prodId){
    $sql = "SELECT * FROM products 
            WHERE id = '{$prodId}'";
    $rs = mysql_query($sql);
    return mysql_fetch_assoc($rs);
}

/**
 * Primim un masiv de producte din masiv de id-uri
 *
 * @param $array
 */
function getProductsfromArray($idArray){
    $strIds = implode($idArray, ',');

    $sql = "SELECT * FROM products
            where id in ({$strIds})";
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 * Get full data of all products
 *
 * @return array|false
 */
function getProducts(){
    return createSmartyRsArray(mysql_query("SELECT * from products ORDER BY category_id"));
}

/**
 *Insert new product
 *
 * @param $itemName
 * @param $itemPrice
 * @param $itemDesc
 * @param $itemCat
 * @return bool|resource
 */
function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat){
    return mysql_query("
            INSERT INTO products 
            SET 
            `name` = '{$itemName}',
            `price` = '{$itemPrice}',
            `description` = '{$itemDesc}',
            `category_id` = '{$itemCat}'
    ");
}

/**
 * Update product data
 *
 * @param $itemId
 * @param $itemName
 * @param $itemPrice
 * @param $itemStatus
 * @param $itemDesc
 * @param $itemCat
 * @param null $newFileName
 * @return bool|resource
 */
function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = null){
    $set = array();
    if ($itemName){
        $set[] = "`name` = '{$itemName}'";
    }
    if ($itemPrice > 0){
        $set[] = "`price` = '{$itemPrice}'";
    }
    if ($itemStatus !== null){
        $set[] = "`status` = '{$itemStatus}'";
    }
    if ($itemDesc){
        $set[] = "`description` = '{$itemDesc}'";
    }
    if ($itemCat){
        $set[] = "`category_id` = '{$itemCat}'";
    }
    if ($newFileName){
        $set[] = "`image` = '{$newFileName}'";
    }
    $setStr = implode($set, ", ");
    $sql = "
        UPDATE products
        SET {$setStr}
        WHERE id = '{$itemId}';
    ";
//    debug($sql);
    return mysql_query($sql);
}