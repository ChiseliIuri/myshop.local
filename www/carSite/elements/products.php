<?php

    $filter = false;
    $manufacturer = '';
    $category = '';
    $filterUrl = '';

    $filterUrl = '?filter=true';


    if(isset($_GET['filter'])){
        if($_GET['filter'] == 'true')
            $filter = true;
    }

    if(isset($_GET['category']) && $_GET['category'] > 0){
        $category = htmlspecialchars($_GET['category']);
    }

    if(isset($_GET['manufacturer']) && $_GET['manufacturer'] > 0){
        $manufacturer = $_GET['manufacturer'];
    }

    if($filter and $category){
        $catalog = $db->prepare('SELECT catalog.id, catalog.name, catalog.img, catalog.count, catalog.price FROM catalog INNER JOIN category ON catalog.category = category.id WHERE catalog.category = :id');
        $catalog->execute(array("id" => $category));
    }
    elseif($filter and $manufacturer){
        $catalog = $db->prepare('SELECT catalog.id, catalog.name, catalog.img, catalog.count, catalog.price FROM catalog INNER JOIN manufacturer ON catalog.manufacturer = manufacturer.id WHERE catalog.manufacturer = :id');
        $catalog->execute(array("id" => $manufacturer));
    }
    else{
        $catalog = $db->prepare('SELECT * FROM catalog');
        $catalog->execute();
    }

    $manufacturer = $db->prepare('SELECT * FROM manufacturer');
    $manufacturer->execute();

    $category = $db->prepare('SELECT * FROM category');
    $category->execute();

?>