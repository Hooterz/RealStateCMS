<?php
    namespace config;
    
    class Autoloader
    {
        private function ClassLoader($class)
        {
            $path = str_replace('\\', '/', $class).'.php';

            if (file_exists($path))
                require_once $path;
        }

        public function Load()
        {
            spl_autoload_register(array($this, 'ClassLoader'));
        }
    }
?>

