<?php
    namespace controller;
    use settings\Path;

    require('controller/tools/Twig.php');

    session_start();

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy(); 
    
    $link = Path::HOST_NAME();
    header("Location: $link");
?>