<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'RealState' => 
  array (
    0 => '\\Map\\FeatureTableMap',
    1 => '\\Map\\ImageTableMap',
    2 => '\\Map\\LocationTableMap',
    3 => '\\Map\\PropertyFeatureTableMap',
    4 => '\\Map\\PropertyImageTableMap',
    5 => '\\Map\\PropertyTableMap',
  ),
));
