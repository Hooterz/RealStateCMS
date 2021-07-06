<?php
    $router_api = new AltoRouter();

    $router_api->map('GET', 'test', fn() => require_once 'controller/api/testAPI.php');
    $router_api->map('GET', 'properties', fn() => require_once 'controller/api/API_get_properties_Controller.php');
    $router_api->map('GET', 'property', fn() => require_once 'controller/api/API_get_property_Controller.php');
    $router_api->map('GET', 'propertyFeatures', fn() => require_once 'controller/api/API_get_propertyFeatures.php');
    $router_api->map('GET', 'propertyImages', fn() => require_once 'controller/api/API_get_propertyImages.php');
    $router_api->map('GET', 'propertyNameExits', fn() => require_once 'controller/api/API_property_name_exists_Controller.php');
    $router_api->map('GET', 'propertyIdExits', fn() => require_once 'controller/api/API_property_id_exists_Controller.php');
    

    // match current request url
    $match = $router_api->match($requestUrl = $url);

    // call closure or throw 404 status
    if( is_array($match) && is_callable( $match['target'] ) ) {
        @call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>