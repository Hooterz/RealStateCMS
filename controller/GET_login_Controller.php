<?php
    namespace controller;
    use settings\Path;
    require('controller/tools/Twig.php');

    session_start();

    // $username = 'sergioescudero';
    // $password = 'frida2009';

    // if (isset($_POST['submit']))
    // {
    //     if (isset($_SESSION["user"]) && $_SESSION['user'] == 'sergioescudero')
    //     {
    //         already_logged_msg();
    //     }
    //     else if ($_POST['username'] == $username && $_POST['password'] == $password)
    //     {
    //         $page = "property-list";
    //         $_SESSION["user"] = $username;
    //         redirect_to($page);
    //     }
    //     else
    //     {
    //         display_login_form();
    //         display_error_msg();
    //     }
    // }
    // else
    // {
    //     display_login_form();
    // }

    // function redirect_to($page)
    // {
    //     $link = Path::HOST_NAME().'/'.$page;
    //     header("Location: $link");
    // }

    // function display_login_form()
    // {
    //     $self = Path::HOST_NAME().'/login';

    //     echo
    //         '<form action="' . $self . '" method="post">' .
    //             '<label for="username">username</label>' .
    //             '<input type="text" name="username" id="username"><br>' .
    //             '<label for="password">password</label>' .
    //             '<input type="password" name="password" id="password"><br>' .
    //             '<input type="submit" name="submit" value="submit">' .
    //         '</form>';
    // }

    // function display_error_msg()
    // {
    //     echo '<p>Usuario o contraseña incorrecta</p><br>';
    // }

    // function already_logged_msg()
    // {
    //     echo '<p>Ya iniciaste sesión</p>' .
    //     '<a href="/property-list">Ir a la lista de propiedades</a>';
    // }
    
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
        $url = Path::PATH_FROM_HOST_URL('property-list');
        header("Location: $url");  
        
    } 

    echo $twig->render('login.html');
?>