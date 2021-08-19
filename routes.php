<?php
    $router = new AltoRouter();
    $router->setBasePath('');

    // View routing
    $router->map('GET', '/', fn() => require_once 'controller/GET_index_Controller.php');
    $router->map('GET', '/about-us', fn() => require_once 'controller/GET_about-us_Controller.php');
    $router->map('GET', '/add-property', fn() => require_once 'controller/GET_addProperty_Controller.php');
    $router->map('POST', '/add-property', fn() => require_once 'controller/POST_addProperty_Controller.php');
    $router->map('GET', '/edit-property/[a:id]', fn($id) => require_once 'controller/GET_editProperty_Controller.php');
    $router->map('POST', '/edit-property/[a:id]', fn($id) => require_once 'controller/POST_editProperty_Controller.php');
    $router->map('GET', '/detail/[a:id]', fn($id) => require_once 'controller/GET_detail_Controller.php');
    $router->map('GET', '/properties', fn() => require_once 'controller/GET_properties_Controller.php');
    $router->map('GET', '/404', fn() => require_once require_once 'controller/GET_404.php');
    $router->map('GET', '/property-list', fn() => require_once 'controller/GET_propertyList_Controller.php');
    $router->map('GET', '/login', fn() => require_once 'controller/GET_login_Controller.php');
    $router->map('POST', '/login', fn() => require_once 'controller/POST_login_Controller.php');
    $router->map('GET', '/logout', fn() => require_once 'controller/GET_logout_Controller.php');

    // Api routing connection
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