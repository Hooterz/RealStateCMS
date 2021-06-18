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

    $property->setPropName($_POST['prop_name']);
    $property->setPropAddress($_POST['prop_address']);
    $property->setPropLocation($_POST['prop_location']);
    $property->setPropDescription($_POST['prop_desc']);
    $property->setPropArea($_POST['prop_area']);
    $property->setPropPrice($_POST['prop_price']);
    $property->setPropIshidden($_POST['is_hidden']);
    $property->save();
?>