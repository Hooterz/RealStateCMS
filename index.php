<?php
    require ('autoload.php');
    (new Autoloader())->Load();

    $router = new AltoRouter();

    // map homepage
    $router->map('GET', '/', fn() => require_once 'controller/GET_index_Controller.php');

    $router->map('GET', '/add-property', fn() => require_once 'controller/GET_addProperty_Controller.php');

    $router->map('GET', '/houses', fn() => require_once 'controller/GET_houses_Controller.php');
    $router->map('GET', '/terrains', fn() => require_once 'controller/GET_terrains_Controller.php');

    $router->map('GET', '/properties', fn() => require_once 'controller/GET_properties_Controller.php');

    $router->map('GET', 'api/get_properties', fn() => require_once 'controller/API_get_properties_Controller.php');


    // match current request url
    $match = $router->match();

    // call closure or throw 404 status
    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
    
?>