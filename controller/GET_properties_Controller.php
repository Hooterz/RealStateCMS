<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };
    use Illuminate\Database\Capsule\Manager as DBCursor;
    require('controller/tools/Twig.php');

    echo $twig->render('properties.html',[
        'categories' => DBCursor::select('SELECT * FROM Category;')
    ]);
?>