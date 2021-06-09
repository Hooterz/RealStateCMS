<?php
declare(strict_types=1);
namespace config;

class Redirection
{
    public static $path = array(
        'error' => __DIR__.'/../views/error.html',
        'home' => __DIR__ . '/../views/index.html',
    );

    public static function Error404(){
        $pathToFile = self::$path['error'];
        header('Location: '.$pathToFile.'?error="404"');
    }

    public static function CustomError($error_numer){
        $pathToFile = self::$path['error'];
        header('Location: '.$pathToFile.'?error="'.$error_numer.'"');
    }

    public static function Home(){
        $pathToFile = self::$path['home'];
        header("Location: $pathToFile");
    }

    public static function Path($path){
        header("Location: $path");
    }
}
?>