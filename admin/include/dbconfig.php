<?php

class Database {

    private static $hostname = 'localhost:3307';
    private static $username = 'root';
    private static $password = '';
    private static $dbname = 'food_order';
    private static $connection = null;

    public static function connect()
    {
        if(!self::$connection)
            self::$connection = new PDO("mysql:host=".self::$hostname.";dbname=".self::$dbname, self::$username, self::$password);
        return self::$connection;
    }

    public function disconnect()
    {
        self::$connection = null;
    }
}

?>