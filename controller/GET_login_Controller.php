<?php
    namespace controller;
    use settings\Path;

    require('controller/tools/Twig.php');

    echo $twig->render('header.html');
    
    error_reporting(E_ERROR | E_PARSE);

    session_start();

    $username = 'sergioescudero';
    $password = 'frida2009';

    if (isset($_POST['submit']))
    {
        if (isset($_SESSION["user"]) && $_SESSION['user'] == 'sergioescudero')
        {
            already_logged_msg();
        }
        else if ($_POST['username'] == $username && $_POST['password'] == $password)
        {
            $page = "property-list";
            $_SESSION["user"] = $username;
            redirect_to($page);
        }
        else
        {
            display_login_form();
            display_error_msg();
        }
    }
    else
    {
        display_login_form();
    }

    function redirect_to($page)
    {
        $link = Path::HOST_NAME().'/'.$page;
        header("Location: $link");
    }

    function display_login_form()
    {
        $self = Path::HOST_NAME().'/login';

        echo
            '<main id="main" class="mt-2">' .
                '<section class="intro-single">' .
                    '<center>' .
                        '<form style="width: 50%;" action="' . $self . '" method="post">' .
                            '<div class="form-group">' .
                                '<label for="username">Usuario</label>' .
                                '<input class="form-control" type="text" name="username" id="username">' .
                            '</div>' .
                            '<div class="form-group" style="margin-bottom: 10px;">' .
                                '<label for="password">Contraseña</label>' .
                                '<input class="form-control" type="password" name="password" id="password">' .
                            '</div>' .
                            '<input style="width: 100%" class="btn btn-primary" type="submit" name="submit" value="submit">' .
                        '</form>' .
                    '</center>' .
                '</section>' .
            '</main>';
    }

    function display_error_msg()
    {
        echo '<p>Usuario o contraseña incorrecta</p><br>';
    }

    function already_logged_msg()
    {
        echo '<p>Ya iniciaste sesión</p>' .
        '<a href="/property-list">Ir a la lista de propiedades</a>';
    }

    echo $twig->render('footer.html');
?>