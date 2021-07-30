<?php
    use settings\Path;
    
    session_start();

    if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']){
        $url = Path::PATH_FROM_HOST_URL('login');
        header("Location: $url"); 
    } 