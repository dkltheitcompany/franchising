<?php


class DataBase
{
    private static $connection;
    private static $querries;
    private static $querry;
    
    private static function connect()
    {
        if (empty(self::$connection))
        {
            $args = include ROOT.'/application/config/db_connection.php';
            self::$connection = new PDO($args['dsn'], $args['user'], $args['password']);
            self::$querries = include ROOT."/application/config/db_querries.php";
        }
    }
    
    public static function querry($querry, $args = [])
    {
        self::connect();
        self::$querry = self::$connection->prepare($querry);
        self::$querry->execute($args);
    }
    
    public static function querry_tmp($querry, ...$args)
    {
        self::connect();
        $querry = self::$querries[$querry];
        self::$querry = self::$connection->prepare($querry['querry']);
        foreach ($args as $key => $val)
            change_key($key, $querry['args'][$key], $args);
        self::$querry->execute($args);
    }
    
    public static function fetch()
    {
        return self::$querry->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function fetch_all()
    {
        return self::$querry->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function last_insert_id()
    {
        return self::$connection->lastInsertId();
    }
    
    public function error()
    {
        return self::$querry->errorCode();
    }
}