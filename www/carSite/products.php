<?php

    require_once 'elements/database.php';
    require_once 'elements/products.php'

?>
<!DOCTYPE html>
<html>
<head>
    <title>Piese BMW</title>
    <link rel="stylesheet" href="style/style.css" />
</head>
<body>
    
    <?php
    
        require_once 'elements/menu.php';

    ?>

    <div class="cars_block">
        <div>
        <div class="product_block filter">
            <div class="product_title">Producator</div>
            <?php
            while($row = $manufacturer->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo '<div><a href="/products.php'.$filterUrl.'&manufacturer='.$id.'">'.$name.'</a></div>';
            }
            ?>
            <div class="product_title">Categorie</div>
            <?php
            while($row = $category->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo '<div><a href="/products.php'.$filterUrl.'&category='.$id.'">'.$name.'</a></div>';
            }
            ?>
        </div>
        </div>
        <div>
        <div class="product_block products">
        <?php 
            while($row = $catalog->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                echo '<div class="product_list">';
                echo '<div class="product_img" style="background-image: url('.$img.')"></div>';
                echo '<div>'.$name.'</div>';
                echo '<div>Cantitate: '.$count.'</div>';
                echo '<div>Pret: '.$price.'</div>';
                echo '<div><a href="/cart.php?do=add&id='.$id.'"><button>In cos</button></a></div>';
                echo '</div>';
            }
        ?>
        </div>
        </div>
    </div>
</body>
</html>