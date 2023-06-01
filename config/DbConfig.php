<?php

/**
 *
 * Initializarea conectarii la DB
 *
 */

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






















