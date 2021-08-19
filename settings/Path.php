<?php
    declare(strict_types=1);
    namespace settings;
    
    class Path{
        public static $ROOT_PATH = ROOT;

        public static function MEDIA_PATH($media_path = null): string{
            if(isset($media_path))
                return self::PATH_FROM_ROOT('media'.self::FormatPath($media_path));
            else
                return self::PATH_FROM_ROOT('media');
        }

        public static function MEDIA_HOST_URL($media_path = null): string{
            if(isset($media_path))
                return self::PATH_FROM_HOST_URL('media'.self::FormatPath($media_path));
            else
                return self::PATH_FROM_HOST_URL('media');
        }

        public static function HOST_NAME(): string{
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        }

        public static function PATH_FROM_ROOT(string $path): string{
            return self::$ROOT_PATH.self::FormatPath($path);
        }

        public static function PATH_FROM_HOST_URL(string $path): string{
            $url = self::HOST_NAME().self::FormatPath($path);
            // return substr($url, 0, strlen($url) - 1);
            return $url;
        }
        
        /**
         * Esta función es para agregar los '/' al principio y al final.
         *
         * @param [type] $path
         * @return void
         */
        private static function FormatPath($path){
            if($path[0] !== '/') $path = '/'.$path;
            if($path[strlen($path) - 1] !== '/') $path = $path.'/';
            return $path;
        }
    }
?>