<?php

/**
 * Model pentru tabela products
 *
 */
class ProductsModel
{
    /**
     * Intoarce ultimele producte inregistrate in limita data. daca nu este indicata limita intoarce toate productele
     * in ordine de la ultimul.
     *
     * @param null $limit limita numarului productelor
     * @return array masiv de producte
     */
    function getLastProduct($limit = null): array
    {
        $sql = 'SELECT * FROM products
            WHERE status = 1
            ORDER BY id DESC';

        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        $rs = mysqli_query(Db::connect(), $sql);
        return Data::createSmartyRsArray($rs);
    }

    /**
     * Intoarce productele categoriei alelese.
     *
     * @param $catID id-ul categoriei necesare
     * @return array|false|mixed masiv de producte
     */
    function getProductByCat($catID)
    {

        $sql = "SELECT * FROM products where status = 1 and category_id = '{$catID}'";
        $rs = mysqli_query(Db::connect(), $sql);
        return Data::createSmartyRsArray($rs);
    }

    /**
     * Intoarce toata info despre un anumit product dupa id-ul lui
     *
     * @param $prodId id-ul productului
     * @return array|false|mixed
     */
    function getProductById($prodId)
    {

        $sql = "SELECT * FROM products 
            WHERE id = '{$prodId}'";
        $rs = mysqli_query(Db::connect(), $sql);
        return mysqli_fetch_assoc($rs);
    }

    /**
     * Primim un masiv de producte din masiv de id-uri
     *
     * @param $array
     */
    function getProductsfromArray($idArray)
    {

        $strIds = implode(',', $idArray);

        $sql = "SELECT * FROM products
            where id in ({$strIds})";
        $rs = mysqli_query(Db::connect(), $sql);
        return Data::createSmartyRsArray($rs);
    }

    /**
     * Get full data of all products
     *
     * @return array|false
     */
    function getProducts()
    {
        return Data::createSmartyRsArray(mysqli_query(Db::connect(), "SELECT * from products ORDER BY category_id"));
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
    function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat)
    {
        return mysqli_query(Db::connect(), "
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
    function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = null)
    {
        $set = array();
        if ($itemName) {
            $set[] = "`name` = '{$itemName}'";
        }
        if ($itemPrice > 0) {
            $set[] = "`price` = '{$itemPrice}'";
        }
        if ($itemStatus !== null) {
            $set[] = "`status` = '{$itemStatus}'";
        }
        if ($itemDesc) {
            $set[] = "`description` = '{$itemDesc}'";
        }
        if ($itemCat) {
            $set[] = "`category_id` = '{$itemCat}'";
        }
        if ($newFileName) {
            $set[] = "`image` = '{$newFileName}'";
        }
        $setStr = implode(", ", $set);
        $sql = "
        UPDATE products
        SET {$setStr}
        WHERE id = '{$itemId}';
    ";
        return mysqli_query(Db::connect(), $sql);
    }

    /**
     * Update product image filename
     *
     * @param $itemId
     * @param $newFileName
     * @return bool|resource
     */
    function updateProductImage($itemId, $newFileName)
    {
        return $this->updateProduct($itemId, null, null, null, null, null, $newFileName);
    }

    /**
     * Find fucking products from search bar
     *
     * @param string $string
     */
    function findThisFuckingProduct(string $string)
    {
        $db = Db::connect();
        $string = mysqli_escape_string($db, $string);
        $sql = "SELECT * FROM products WHERE name LIKE '%$string%' and status = 1";
        $result = mysqli_query($db, $sql);
        return Data::createSmartyRsArray($result);
    }

    /**
     * Delete product data by id
     *
     * @param $prodId product id
     */
    function deleteProductById($prodId)
    {
        $sql = "DELETE FROM products WHERE id = '{$prodId}'";
        return mysqli_query(Db::connect(), $sql);
    }

}



