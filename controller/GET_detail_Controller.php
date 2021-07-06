<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };
    use controller\api\APIRealState;
    require('controller/tools/Twig.php');

    /**
     * Se puede usar la cariable $id para obtener el id de la url
     * Esta función debe sacar toda la información de una casa del server
     * Esta función tiene que redirigir al index en caso de no existir la propiedad
     */

    echo $twig->render('detail.html');
?>