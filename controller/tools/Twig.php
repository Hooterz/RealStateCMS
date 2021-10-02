<?php
use settings\Path;
use Twig\{
        Loader\FilesystemLoader,
        Environment
    };

    $loader = new FilesystemLoader('views');
    $twig = new Environment($loader);
    $twig->addGlobal('host', Path::HOST_NAME());

    if(IS_IN_MAINTENANCE){
        echo $twig->render('maintenance.html',[
            'no_meta' => 1,
            'is_not_indexed' => 1
        ]);
    }
?>