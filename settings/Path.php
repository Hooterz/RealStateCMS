<?php
    declare(strict_types=1);
    namespace settings;
    
    class Path{
        public static function ROOT_PATH(): string{
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        }

        public static function PATH_FROM_ROOT(string $path): string{
            if($path[0] !== '/') $path = '/'.$path;
            return self::ROOT_PATH().$path;
        }
    }
?>