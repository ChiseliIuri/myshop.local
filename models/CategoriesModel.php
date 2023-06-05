<?php
/**
 *
 * Model pentru tabelul (categories)
 *
 */

class CategoriesModel
{
    /**
     * Primim categoriile copil pentru categoria $catId
     *
     * @param integer $catId ID categoriei
     * @return array masiv categoriilor copil.
     */
    function getChildrenForCat($catId)
    {
        $db = Db::connect();
        $sql = "SELECT * 
            FROM categories 
            WHERE parent_id = {$catId}";
        $rs = mysqli_query($db, $sql);
        return Data::createSmartyRsArray($rs);
    }

    /**
     * Primim categoriile parinte cu legatura cu cele copil
     *
     * @return array masiv de categorii
     */
    function getAllCatsWithChildren()
    {
        $db = Db::connect();
        $sql = 'SELECT *
                FROM  categories
                WHERE parent_id = 0';

        $rs = mysqli_query($db, $sql);
        $smartyRs = array();
        while ($row = mysqli_fetch_assoc($rs)) {
            $rsChildren = $this->getChildrenForCat($row['id']);

            if ($rsChildren) {
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
    function getCatByID($id)
    {
        $sql = "SELECT * FROM categories 
          WHERE id = '$id'";
        $rs = mysqli_query(Db::connect(), $sql);
        return mysqli_fetch_assoc($rs);
    }

    /**
     * Primim toate categoriile principale
     *
     * @return array
     */

    function getAllMainCategories()
    {
        $sql = "
    SELECT * FROM categories
    WHERE parent_id = 0;
    ";
        $rs = mysqli_query(Db::connect(), $sql);
        $response = array();
        $response = Data::createSmartyRsArray($rs);

        return $response;
    }

    /**
     * Adding new category
     *
     * @param string $catName
     * @param int $catParentId
     * @return mixed id of new category
     */
    function insertCat($catName, $catParentId = 0)
    {
        $sql = "INSERT INTO categories (parent_id, name) VALUES ('$catParentId', '$catName');";
        if (mysqli_query(Db::connect(), $sql)) {
            $sql = "SELECT LAST_INSERT_ID();";
            $rs = mysqli_query(Db::connect(), $sql);

            return mysqli_fetch_assoc($rs);
        } else {
            return false;
        }
    }

    /**
     * Get all categories for categories table in admin site
     *
     * @return array|false
     */
    function getAllCategories()
    {
        return Data::createSmartyRsArray(mysqli_query(Db::connect(), "SELECT * FROM categories ORDER BY parent_id ASC;"));
    }

    /**
     * Get all child categories without parental
     *
     * @return array|false
     */
    function getAllChildCategories()
    {
        return Data::createSmartyRsArray(mysqli_query(Db::connect(), "SELECT * from categories where parent_id != 0 order by parent_id;"));
    }

    /**
     * Update category data
     *
     * @param $itemId
     * @param int $parentId
     * @param string $newName
     */
    function updateCategoryData($itemId, $parentId = -1, $newName = '')
    {
        $set = array();
        if ($newName) {
            $set[] = "`name` = '{$newName}'";
        }

        if ($parentId > -1) {
            $set[] = "`parent_id` = '{$parentId}'";
        }
        $setStr = implode(",", $set);
        $sql = "UPDATE categories 
            SET {$setStr}
            WHERE id = '{$itemId}'";

        return mysqli_query(Db::connect(), $sql);
    }

    /**
     * Delete category data
     *
     * @param $catId categoty id
     */
    function deleteCategoryById($catId)
    {
        $sql = "DELETE FROM categories WHERE id = '{$catId}'";
        return mysqli_query(Db::connect(), $sql);
    }
}