<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('RealState', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=RealState',
  'user' => 'root',
  'password' => '',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('RealState');
$serviceContainer->setConnectionManager('RealState', $manager);
$serviceContainer->setDefaultDatasource('RealState');
require_once __DIR__ . '/./loadDatabase.php';
