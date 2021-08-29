<?php

    $cars = $db->prepare('SELECT * FROM bmw');
    $cars->execute();

?>