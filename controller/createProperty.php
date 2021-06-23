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

    // STATUS: Incompleto
    // TODO: Preparar el script para añadir las locations a la tabla correspondiente y la vista va mandar una lista de features.
    // TODO: Preparar el script para que si no recibe un Id de Location entonces agregue la Location recibida.
    $property = new Property();
    $property->setPrimaryKey($_POST['prop_name']); //agregué el pk
    $property->setPropName($_POST['prop_name']);
    $property->setPropAddress($_POST['prop_address']);
    $property->setPropLocation($_POST['prop_location']);
    $property->setPropDescription($_POST['prop_desc']);
    $property->setPropArea($_POST['prop_area']);
    $property->setPropPrice($_POST['prop_price']);
    $property->setPropIshidden($_POST['is_hidden']);
    $property->save();
?>