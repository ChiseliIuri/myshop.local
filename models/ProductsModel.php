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