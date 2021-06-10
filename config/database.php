<?php
declare(strict_types=1);
namespace config;

use mysqli;

class DatabaseConnection
{
    private static $instance = null, $host, $user, $password, $db_name;

    public static function SetConnectionParameters(array $settings){
        if(empty($settings)) return false;
        foreach($settings as $key => $value)
            $settings[$key] = isset($value) ? $value : '';
        self::$host = $settings['host']; 
        self::$user = $settings['user'];
        self::$password  = $settings['password'];
        self::$db_name = $settings['db_name'];
    }

    public static function GetConnectionParameters(){
        return array(
            'host' => self::$host,
            'user' => self::$user,
            'password' => self::$password,
            'db_name' => self::$db_name
        );
    }

    public static function GetInstance(){
        if (isset(self::$instance))
            return self::$instance;
        $instance = new DatabaseConnection();
        return self::$instance;
    }

    public static function Connect_Reconnect(){
        new DatabaseConnection();
    }

    public static function Disconnect(){
        self::$instance = null;
    }

    private function __construct(){
        $mysqli = new mysqli(
            self::$host, 
            self::$user, 
            self::$password ?? '', 
            self::$db_name
        );
        if($mysqli->connect_errno)
            self::$instance = null;
        self::$instance = $mysqli;
    }

    public function __invoke(){
        return self::GetInstance();
    }
}
?>