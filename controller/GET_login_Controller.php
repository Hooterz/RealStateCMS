<?php
    namespace controller;
    use settings\Path;
    require('controller/tools/Twig.php');

    session_start();
    
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        $url = Path::HOST_NAME().'/property-list';
        header("Location: $url");  
        
    } 

    echo $twig->render('login.html',[
        'is_not_indexed' => 1,
        'no_meta' => 1
    ]);
?>