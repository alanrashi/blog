<?php

class Db
{

    public static function getConnection()
    {
        $host = "localhost"; 
        $db = "Db";
        $user = "root";
        $pass = "root";
        $charset = "utf8";

        $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
        ];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        return $db = new PDO($dsn, $user, $pass, $opt);

    }
}