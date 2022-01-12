<?php
/**
 *
 * Model pentru tabelul (categories)
 *
 */


/**
 * Primim categoriile copil pentru categoria $catId
 *
 * @param integer $catId ID categoriei
 * @return array masiv categoriilor copil.
 */
function getChildrenForCat($catId){
    $sql = "SELECT * 
    FROM categories 
    WHERE parent_id = {$catId}";
    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

/**
 * Primim categoriile parinte cu legatura cu cele copil
 *
 * @return array masiv de categorii
 */
function getAllCatsWithChildren(){
    $sql = 'SELECT *
   FROM  categories
   WHERE parent_id = 0';

    $rs = mysql_query($sql);
    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)) {
        $rsChildren = getChildrenForCat($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
        }

        $smartyRs[] = $row;
   }
   return $smartyRs;
}

/**
 * Primim toti copii pentru un anumit id
 *
 * @param $id
 * @return array
 */
function getCatByID($id){
    $sql="SELECT * FROM categories 
          WHERE id = '$id'";
    $rs  = mysql_query($sql);
    return mysql_fetch_assoc($rs);
}

/**
 * Primim toate categoriile principale
 *
 * @return array
 */

function getAllMainCategories(){
    $sql = "
    SELECT * FROM categories
    WHERE parent_id = 0;
    ";
    $rs = mysql_query($sql);
    $response = array();
    $response = createSmartyRsArray($rs);

    return $response;
}

/**
 * Adding new category
 *
 * @param string $catName
 * @param int $catParentId
 * @return mixed id of new category
 */
function insertCat($catName, $catParentId = 0){
    $sql = "INSERT INTO categories (parent_id, name) VALUES ('$catParentId', '$catName');";

    if(mysql_query($sql)) {
        $sql = "SELECT LAST_INSERT_ID();";
        $rs = mysql_query($sql);

        return mysql_fetch_assoc($rs);
    } else {
        return false;
    }
}

/**
 * Get all categories for categories table in admin site
 *
 * @return array|false
 */
function getAllCategories(){
    return createSmartyRsArray(mysql_query("SELECT * FROM categories ORDER BY parent_id ASC;"));
}

/**
 * Update category data
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 */
function updateCategoryData($itemId, $parentId = -1, $newName = ''){

    $set  = array();
    if ($newName){
        $set[] = "`name` = '{$newName}'";
    }

    if($parentId > -1){
        $set[] = "`parent_id` = '{$parentId}'";
    }
    $setStr = implode($set, ",");
    $sql = "UPDATE categories 
            SET {$setStr}
            WHERE id = '{$itemId}'";

    return mysql_query($sql);
}