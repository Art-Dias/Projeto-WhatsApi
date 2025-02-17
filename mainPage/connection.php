<?php 
class DatabaseConnection
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection) {
            // Establish connection
            // $host = "serv";
            // $user = "user";
            // $password = "senha";
            // $database = "db";
            $host = "server";
            $user = "user";
            $password = "senha";
            $database = "user";

            self::$connection = new mysqli($host, $user, $password, $database);
        }

        return self::$connection;
    }
}
?>