<?php
    declare(strict_types=1);
    use \config\Autoloader;
    use \config\DatabaseConnection;

    require('./config/autoload.php');
    (new Autoloader())->Load();
    
    //Configuración y conexión a la base de datos
    DatabaseConnection::SetConnectionParameters(array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'db_name' => 'RealState'
    ));
    DatabaseConnection::Connect_Reconnect();

    // header('Location: ...');
?>