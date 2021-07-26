<?php
    namespace controller;
    use settings\Path;
    use Illuminate\Database\Capsule\Manager as DBCursor;

    require('controller/tools/Twig.php');

    session_start();

    if (isset($_SESSION['user']) && $_SESSION['user'] == 'sergioescudero') 
    {
        echo $twig->render('addproperty.html', [
            'post_response' => Path::HOST_NAME().'/add-property',
            'categories' => DBCursor::select('SELECT cat_name FROM Category;'),
            'locations' => DBCursor::select('SELECT * FROM Location;')
        ]);
    }
    else
    {
        $not_found = Path::HOST_NAME().'/404';
        header("Location: $not_found");
    }   
?>