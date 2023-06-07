<?php
/**
 * Model pentru tabelul orders
 *
 */
class OrdersModel
{
    /**
     * Order creation (without link with product)
     *
     * @param string $name
     * @param string $phone
     * @param string $address
     * @return int id of created order
     */
    function makeNewOrder($name, $phone, $address)
    {
        //initializrea variabililor

        $userId = $_SESSION['user']['id'];
        //trebuie de sanitarizat datele in viitor!!!+++++++++++++++++++++++++++++++++++++++++++++++++++++
        $comment = "User id: {$userId}<br/> Name: {$name}<br/> Phone: {$phone}<br/> Address: {$address}";
        date_default_timezone_set("Europe/Chisinau");
        $dateCreated = date('Y.m.d H:i:s');
        $userIp = $_SERVER['REMOTE_ADDR'];
        $connect = Db::connect();
        //formam sql query
        $sql = "INSERT INTO orders ( user_id, date_created, comment, user_ip) VALUES (
    '{$userId}', '{$dateCreated}', '{$comment}', '{$userIp}'
    );
    ";
        $rs = mysqli_query($connect, $sql);
        $sql = "SELECT LAST_INSERT_ID();";
        $rs = mysqli_query($connect, $sql);
        $id = mysqli_fetch_assoc($rs);
        return $id['LAST_INSERT_ID()'];
    }

    /**
     * Primirea listei comenzilor cu legarea catre producte pentru utilizatorul $userId
     *
     * @param $userId
     * @return array masivul comentilor cu legatura spre producte
     */
    function getOrdersWithProductsByUser($userId)
    {
        $purchase = new PurchaseModel();
        $userId = intval($userId);
        $sql = "SELECT * FROM orders
            WHERE user_id = '{$userId}'
            ORDER BY id DESC";
        $rs = mysqli_query(Db::connect(), $sql);
        $smartyRs = array();
        while ($row = mysqli_fetch_assoc($rs)) {
            $rsChildren = $purchase->getPurchaseForOrder($row['id']);

            if ($rsChildren) {
                $row['children'] = $rsChildren;
                $smartyRs[] = $row;
            }
        }
        return $smartyRs;
    }

    /**
     * Get orders with user and products information
     *
     * @return array
     */
    function getOrders()
    {
        $sql = "SELECT o.*, u.name, u.email, u.phone, u.address
            FROM orders AS o
            LEFT JOIN users AS u ON o.user_id = u.id
            ORDER BY id DESC;";
        $rs = mysqli_query(Db::connect(), $sql);

        $smartyRs = array();
        while ($row = mysqli_fetch_assoc($rs)) {
            $rsChildren = $this->getProductsForOrder($row['id']);

            if ($rsChildren) {
                $row['children'] = $rsChildren;
                $smartyRs[] = $row;
            }
        }
//    debug($smartyRs);
        return $smartyRs;
    }

    /**
     * Get products of order by order id
     *
     * @param $orderId
     */
    function getProductsForOrder($orderId)
    {
        $rs = mysqli_query(Db::connect(), "
    SELECT *
    FROM purchase as pe
    LEFT JOIN products as ps
    ON pe.product_id = ps.id
    WHERE (`order_id` = $orderId);
    ");
        return Data::createSmartyRsArray($rs);
    }

    /**
     * Update Order Status
     *
     * @param $itemId
     * @param $status
     * @return bool|resource
     */
    function updateOrderStatus($itemId, $status)
    {
        $status = intval($status);
        return mysqli_query(Db::connect(), "UPDATE orders 
            SET `status` = '$status'
            WHERE id = '{$itemId}';");
    }

    /**
     * Update date of order payment
     *
     * @param $itemId
     * @param $datePayment
     * @return bool|resource
     */
    function updateOrderDatePayment($itemId, $datePayment)
    {
        return mysqli_query(Db::connect(), "
            UPDATE orders 
            SET `date_payment` = '{$datePayment}'
            WHERE id = '{$itemId}'
            ");
    }
}