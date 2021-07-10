<?php
    namespace controller;

    use controller\tools\APIRealState;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };


    require('controller/tools/Twig.php');

    /**
     * Se puede usar la cariable $id para obtener el id de la url
     * Esta función debe sacar toda la información de una casa del server
     * Esta función tiene que redirigir al index en caso de no existir la propiedad
     */
    $property = APIRealState::getProperty($id);
    $features = APIRealState::getPropertyFeatures($property->prop_id);
    $images = APIRealState::getPropertyImages($property->prop_id);

    echo $twig->render('detail.html', [
        'property' => $property,
        'features' => $features,
        'images' => $images
    ]);
?>