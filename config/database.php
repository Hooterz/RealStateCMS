<?php
namespace config;

class DatabaseConnection
{
    public static $instance;

    public static function getInstance()
    {
        if (isset(self::$instance))
        {
            return self::$instance;
        }
        else
        {
            $instance = new DatabaseConnection();
            self::$instance = $instance;
            return self::$instance;
        }
    }

    public function __construct($dbhost = "", $username = "", $password = "", $dbname = "")
    {
        try
        {
            $this->instance = new mysqli($dbhost, $username, $password, $dbname);

            if(mysqli_connect_errno())
            {
                throw new Exception("Could not connect to database.");
            }
        }
        catch (Exception $error)
        {
            throw new Exception($error->getMessage());
        }
    }
}
?>