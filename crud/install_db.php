<?php
class Create
{

private static $servername = 'localhost';
private static $username = 'root';
private static $password = '';


    public static function checkIfDbExists($dbname)
    {
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        self::connectDB();
        if ($conn->query($dbname) === TRUE) {
            echo "Database allready exists!" . $conn->error;
        } else {
            self::createDB($dbname);
        }
    }

    public static function connectDB()
    {
// Create connection
       $conn = new mysqli(self::$servername, self::$username, self::$password);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    public static function createDB($dbname)
    {
        $conn = new mysqli(self::$servername, self::$username, self::$password);
// Create database
        $sql = "CREATE DATABASE $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }

    }

    public static function closeDB()
    {
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        $conn->close();
    }
}
?> 