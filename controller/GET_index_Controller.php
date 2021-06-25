<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };  

    $loader = new FilesystemLoader('views');
    $twig = new Environment($loader);

    echo $twig->render('index.html');
?>