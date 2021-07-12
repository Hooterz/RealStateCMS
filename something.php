<?php

use \Verot\Upload\Upload as UploadHandler;

require './autoload.php';
(new Autoloader())->Load();
if (!empty($_FILES)) {
    for ($i=0; $i < count($_FILES['image_field']['name']); $i++) { 
        $new_image_info = [
            'name' => $_FILES['image_field']['name'][$i],
            'type' => $_FILES['image_field']['type'][$i],
            'tmp_name' => $_FILES['image_field']['tmp_name'][$i],
            'error' => $_FILES['image_field']['error'][$i],
            'size' => $_FILES['image_field']['size'][$i]
        ];
        $handler = new UploadHandler($new_image_info);
        if ($handler->uploaded){
            $handler->file_name_body_add   = '_image_resized';
            $handler->image_resize         = true;
            $handler->image_x              = 1000;
            $handler->image_y              = 1000;
            $handler->image_ratio          = true;
            $handler->process('/Users/alejandroortega/Documents/Code/PHP/RealStateCMS/test');
            if ($handler->processed) {
                echo 'image resized';
                $handler->clean();
            } else {
                echo 'error : ' . $handler->error;
            }
        }
        d($handler->file_dst_name);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./something.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image_field[]" multiple >
        <input type="submit" value="upload">
    </form>
</body>

</html>