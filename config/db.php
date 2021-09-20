<?php

/**
 *
 * Initializarea conectarii la DB
 *
 */

$dbLocation = "127.0.0.1";
$dbName = "myshop";
$dbUser = "root";
$dbPassword = "";

//conectare la DB
$db = mysql_connect($dbLocation, $dbUser,$dbPassword);

if (!$db){
    echo"Eroare de conectare la MySql";
    exit();
}

mysql_set_charset('utf8', $db);

if(!mysql_select_db($dbName,$db)){
    echo "Eroare de acces la DB: {$dbName}";
    exit();
}
