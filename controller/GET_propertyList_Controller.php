<?php
    namespace controller;
    use controller\tools\APIRealState;
    use settings\Path;

    require('controller/tools/Twig.php');

    session_start();

    if (isset($_SESSION["user"]) && $_SESSION['user'] == 'sergioescudero') 
    {
        echo $twig->render('propertylist.html', [
        ]);
    }
    else
    {
        $not_found = Path::HOST_NAME().'/404';
        header("Location: $not_found");
    }    
?>