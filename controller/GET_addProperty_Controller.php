<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };
    use settings\Path;

    $loader = new FilesystemLoader('views');
    $twig = new Environment($loader);
    echo $twig->render('addproperty.html', [
        'post_response' => Path::PATH_FROM_ROOT('/add-property')
    ]);
?>