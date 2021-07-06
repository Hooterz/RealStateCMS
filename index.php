<?php
    // NOTE: This file runs all app services and handles all incoming request logic

    if(!defined('ROOT'))
        define('ROOT', __DIR__);

    require ('autoload.php');
    (new Autoloader())->Load();
    
    require ('settings/App_vars.php');
    require ('settings/DB_Settings.php');
    require ('routes.php');
?>