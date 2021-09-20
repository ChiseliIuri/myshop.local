<?php

/**
 * Model pentru tabela products
 *
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