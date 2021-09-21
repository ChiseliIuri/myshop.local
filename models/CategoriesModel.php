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