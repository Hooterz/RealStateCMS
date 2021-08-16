<?php
    namespace controller;
    require('controller/tools/Twig.php');
    echo $twig->render('404.html',[
        'no_meta' => 1,
        'is_not_indexed' => 1
    ]);
?>