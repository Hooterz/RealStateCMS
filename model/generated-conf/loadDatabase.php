<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'RealState' => 
  array (
    0 => '\\RealStateModel\\Map\\FeatureTableMap',
    1 => '\\RealStateModel\\Map\\ImageTableMap',
    2 => '\\RealStateModel\\Map\\LocationTableMap',
    3 => '\\RealStateModel\\Map\\PropertyFeatureTableMap',
    4 => '\\RealStateModel\\Map\\PropertyImageTableMap',
    5 => '\\RealStateModel\\Map\\PropertyTableMap',
  ),
));
