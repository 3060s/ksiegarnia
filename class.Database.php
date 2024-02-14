<?php
final class Database 
{
    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PASSWORD = "";
    private const DB_NAME = "ksiegarnia";
    private static mysqli|null $connection = null;

    private static function connect(): void
    {
        self::$connection = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);

        $error = self::$connection->connect_error;

        if ($error) {
            self::$connection = null;
            die("Connection failed: " . $error);
        }
    }

    public static function getConnection(): mysqli 
    {
        if (is_null(self::$connection)) {
            self::connect();   
        }

        return self::$connection;
    }
}