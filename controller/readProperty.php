<?php
    namespace controller;

    use controller\tools\RequestChecker;
    use RealStateModel\{
        Property
    };

    require './tools/checkRequest.php';
    require '../vendor/autoload.php';
    require '../model/generated-conf/config.php';

    $request_args = RequestChecker::CheckEmpty($_POST);
    if(!$request_args) header('Location: ../index.php');

    $property = new Property();

    
?>