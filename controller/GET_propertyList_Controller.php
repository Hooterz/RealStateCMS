<?php
    namespace controller;
    use controller\tools\APIRealState;
    use settings\Path;

    require('controller/tools/Twig.php');
    require('controller/tools/Auth_required.php');

    echo $twig->render('propertylist.html');  
?>