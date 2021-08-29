<?php

    require_once 'elements/database.php';
    require_once 'elements/cars.php'

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

    <div class="first_block">
        <div class="on_first_block">
            <div class="first_block_text">
                Procură la un preț adecvat<br>
                piese pentru mașina ta
                <div>
                    <a href="/products.php">
                        <button>Lista cu produse</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="cars_block" id="cars">
        <?php
        
        while($row = $cars->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo '<div class="img_car_block">';
            echo '<div class="img_car" style="background-image: url('.$img.')"></div>';
            echo '<div class="car_title">BMW '.$model.'</div>';
            echo $year;
            echo '</div>';
        }
        
        ?>
    </div>
</body>
</html>