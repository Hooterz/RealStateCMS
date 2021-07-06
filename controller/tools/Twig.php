<?php
use settings\Path;
use Twig\{
        Loader\FilesystemLoader,
        Environment
    };

    $loader = new FilesystemLoader('views');
    $twig = new Environment($loader);
    $twig->addGlobal('host', Path::HOST_NAME());
?>