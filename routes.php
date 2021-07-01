<?php
    $router = new AltoRouter();

    // map homepage
    $router->map('GET', '/', fn() => require_once 'controller/GET_index_Controller.php');
    $router->map('GET', '/add-property', fn() => require_once 'controller/GET_addProperty_Controller.php');
    $router->map('POST', '/add-property', fn() => require_once 'controller/POST_addProperty_Controller.php');
    $router->map('GET', '/houses', fn() => require_once 'controller/GET_houses_Controller.php');
    $router->map('GET', '/terrains', fn() => require_once 'controller/GET_terrains_Controller.php');
    $router->map('GET', '/properties', fn() => require_once 'controller/GET_properties_Controller.php');

    $router->map('GET', '/api/[a:url]', fn($url) => require 'routes_api.php');


    // match current request url
    $match = $router->match();

    // call closure or throw 404 status
    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        require_once 'controller/GET_404.php';
    }
?>