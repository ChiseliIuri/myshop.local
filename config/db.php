<?php

/**
 *
 * Initializarea conectarii la DB
 *
 */

//try{
//    $db = new PDO("mysql:host=$dbLocation;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);
//    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $db->exec();
//    echo 'SUCCESS';
//} catch (PDOException $e) {
//    echo 'Eroare de conectare la baza de date' . $e->getMessage();
//}

//conectare la DB

/**
 * Class Db
 *
 * return mysqli
 */
class Db
{
    public mysqli|null|false $connect;
    protected string $dbLocation = "127.0.0.1";
    protected string $dbName = "myshop";
    protected string $dbUser = "root";
    protected string $dbPassword = "";

    /**
     * Db constructor.
     */
    public function __construct()
    {
        $this->connect = mysqli_connect($this->dbLocation, $this->dbUser, $this->dbPassword);
        mysqli_set_charset($this->connect,'utf8' );
        if (!mysqli_select_db($this->connect, $this->dbName)) {
            echo "Eroare de acces la DB: {$this->dbName}";
            exit();
        }
    }
}






















