<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'RealState';
    $mysqli = new mysqli($host, $user, $password, $db);
    if($mysqli->connect_errno)
        echo "Fallo al conectar";
    echo 'Conexión exitosa';
?>