<?php

    require_once 'elements/database.php';
    require_once 'elements/cart.php'

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
        <div class="product_block products et">
        <div class="product_title">Shopping Cart</div>
        <?php

        $total = 0;
        
        foreach ($products as $key => $value) {
            $total += (int)$value['price'];
            echo '<div class="product_list">';
            echo '<div class="product_img" style="background-image: url('.$value['img'].')"></div>';
            echo '<div>'.$value['name'].'</div>';
            echo '<div>Pret: '.$value['price'].'</div>';
            echo '<div><a href="/cart.php?do=delete&id='.$key.'"><button>Sterge</button></a></div>';
            echo '</div>';
        }

        ?>
        <br><br>
        <div class="product_title">Total: <?= $total ?></div>
        </div>
    </div>
</body>
</html>