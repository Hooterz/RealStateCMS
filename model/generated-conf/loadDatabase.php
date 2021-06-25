<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'RealState' => 
  array (
    0 => '\\RealStateModel\\Map\\CategoryTableMap',
    1 => '\\RealStateModel\\Map\\FeatureTableMap',
    2 => '\\RealStateModel\\Map\\ImageTableMap',
    3 => '\\RealStateModel\\Map\\LocationTableMap',
    4 => '\\RealStateModel\\Map\\PropertyFeatureTableMap',
    5 => '\\RealStateModel\\Map\\PropertyImageTableMap',
    6 => '\\RealStateModel\\Map\\PropertyTableMap',
  ),
));
