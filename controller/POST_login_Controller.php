<?php
    namespace controller;
    use settings\Path;
    require('controller/tools/Twig.php');

    session_start();

    $username = 'sergioescudero';
    $password = 'frida2009';

    $input_user = htmlspecialchars($_POST['username']);
    $input_password = htmlspecialchars($_POST['password']);

    if($input_user !== $username || $input_password !== $password){
        unset($_SESSION['logged_in']);
        $_SESSION['logged_in'] = false;
        echo $twig->render('login.html', ['message' => 'Usario o contraseña incorrecta']);
        return;
    }

    unset($_SESSION['logged_in']);
    $_SESSION['logged_in'] = true;

    $url = Path::PATH_FROM_HOST_URL('property-list');
    header("Location: $url");  

