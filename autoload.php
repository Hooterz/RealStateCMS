<?php    
    use settings\Path;
    require 'settings/Path.php';
    require 'vendor/autoload.php';
    
    class Autoloader
    {
        private function ClassLoader($class)
        {
            $path = str_replace('\\', '/', $class).'.php';
            if (file_exists($path)){
                require __DIR__."/$path";
            }
        }

        public function Load()
        {
            spl_autoload_register(array($this, 'ClassLoader'));
        }
    }
?>

