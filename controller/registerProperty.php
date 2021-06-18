<?php
    namespace controller;

    use controller\tools\RequestChecker;
    use RealStateModel\{
        Location,
        LocationQuery
    };

    require './tools/checkRequest.php';
    require '../vendor/autoload.php';
    require '../model/generated-conf/config.php';

    $request_args = RequestChecker::CheckEmpty($_POST);
    if(!$request_args) header('Location: ../index.php');

    print_r($request_args);
    $location = new Location();
    $location->setLoName($_POST['name']);
    $location->save();


?>