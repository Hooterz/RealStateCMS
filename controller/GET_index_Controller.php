<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };  
    require('controller/tools/Twig.php');

    echo $twig->render('index.html');
?>