<?php

    session_start();
    $products = array();

    if(isset($_SESSION['cart']))
        $products = unserialize($_SESSION['cart']);

    if(isset($_GET['do'])){
        if($_GET['do'] == 'add'){
            $catalog = $db->prepare('SELECT catalog.id, catalog.name, catalog.img, catalog.price FROM catalog WHERE catalog.id = :id');
            $catalog->execute(array("id" => $_GET['id']));
            $row = $catalog->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $products[] = array(
                "id" => $id,
                "name" => $name,
                "img" => $img,
                "price" => $price
            );
            $_SESSION['cart'] = serialize($products);
            header('Location: /cart.php');
        }
    }

    if(isset($_GET['do'])){
        if($_GET['do'] == 'delete'){
            unset($products[$_GET['id']]);
            $_SESSION['cart'] = serialize($products);
            header('Location: /cart.php');
        }
    }

?>