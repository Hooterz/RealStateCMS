<?php    
    use settings\Path;
    require 'settings/Path.php';
    require 'vendor/autoload.php';
    require 'model/generated-conf/config.php';
    
    class Autoloader
    {
        private function ClassLoader($class)
        {
            $path = str_replace('\\', '/', $class).'.php';

            print_r($path);
            if (file_exists($path)){
                require Path::ROOT_PATH().$path;
            }
        }

        public function Load()
        {
            spl_autoload_register(array($this, 'ClassLoader'));
        }
    }
?>

