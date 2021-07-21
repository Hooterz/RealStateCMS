<?php
    namespace controller;
    use controller\tools\APIRealState;

    require('controller/tools/Twig.php');
    echo $twig->render('propertylist.html', [
        'latest_properties' => APIRealState::getProperties($limit = 20)
    ]);
?>