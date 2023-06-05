<?php

/**
 *
 * Initializarea conectarii la DB
 *
 */

/**
 * Class Db singleton realization of connection to db
 *
 * return mysqli
 */
class Db
{
    private function __construct(){
        echo 'connection  created';
    }
    public static function connect () : object {
        $connection = mysqli_connect(ConstConfig::DB_LOCATION, ConstConfig::DB_USER
            , ConstConfig::DB_PASSWORD);
        mysqli_set_charset($connection,'utf8' );
        if (!mysqli_select_db($connection, ConstConfig::DB_NAME)) {
            echo "Eroare de acces la DB: {ConstConfig::DB_NAME}";
            exit();
        }
        return $connection;
    }
}
//implement Singleton for DB conection
