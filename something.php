<?php

use RealStateModel\{
    LocationQuery,
    Location
};
use Twig\{
    Loader\FilesystemLoader,
    Environment
};   
    require('./autoload.php');
    (new Autoloader())->Load();

    $query = new LocationQuery();
    
    $loader = new FilesystemLoader('./views');
    $twig = new Environment($loader);
    echo $twig->render('addproperty.html');
?>

