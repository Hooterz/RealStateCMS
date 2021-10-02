<?php
    namespace controller;
    require('controller/tools/Twig.php');

    echo $twig->render('about.html', [
        'no_meta' => 1,
        'is_not_indexed' => 1
    ]);
?>