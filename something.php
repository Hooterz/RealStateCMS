<?php
    require ('./vendor/autoload.php');
    require('./model/generated-conf/config.php');
    
    use RealStateModel\{
        Location,
        LocationQuery
    };

    d(__DIR__);
    // $locationQuery = LocationQuery::create()
    //                  ->filterByLoName(array('Cancún', 'Mérida'))
    //                  ->find();

?>