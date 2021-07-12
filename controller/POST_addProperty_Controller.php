<?php
    namespace controller;
    use settings\Path;
    use Illuminate\Database\Capsule\Manager as DBCursor;
    use Verot\Upload\Upload as UploadHandler;
    use Exception;
    use DateTime;


$messages = array();

    // NOTE: Hacer la función de ingreso de datos del formulario para incluir nuevas propiedades
    $name = ucfirst($_POST['prop_name']);
    $location = $_POST['prop_location'];
    $new_location = $_POST['prop_new_location'] ?? null;
    $address = $_POST['prop_address'];
    $description = $_POST['prop_description'];
    $price = $_POST['prop_price'];
    $area = $_POST['prop_area'];
    $features_array = json_decode( $_POST['features'] );
    $property_type = DBCursor::select("
        SELECT cat_id FROM Category 
        WHERE cat_name = '{$_POST['type_select']}';
    ")[0]->cat_id;

    // Adding new Location to DB before using it
    if(!empty($new_location)){
        DBCursor::select("
        INSERT INTO Location 
        (lo_name) VALUES
        ('$new_location');
        ");
        
        $location = DBCursor::select("
        SELECT lo_id 
        FROM Location 
        WHERE lo_name = '$new_location';
        ")[0]->lo_id;
    }

    // Adding Property to DB
    $datetime = new DateTime();
    $current_datetime = $datetime->format('Y-m-d H:i:s');
    $generated_hash_id = hash('md5', $name.$current_datetime);
    DBCursor::select("
        INSERT INTO Property
        VALUES(
            '$generated_hash_id',
            '$name',
            '$address',
            $location,
            '$description',
            $area,
            $price,
            NOW(),
            0,
            $property_type
        );
    ");
    

    // Adding Features to DB and storing feature id in $features_id
    $features_id = array();

    foreach ($features_array as $feature) {
        DBCursor::select("
            INSERT INTO Feature
            (feature_content) VALUES
            ('$feature');
        "); 

        $feature_id = DBCursor::select("
            SELECT * FROM Feature 
            ORDER BY feature_id DESC 
            LIMIT 1;
        ")[0]->feature_id;

        array_push($features_id, $feature_id);
    }

    // Adding relation records between Properties and Features
    foreach ($features_id as $id)
        DBCursor::select("INSERT INTO Property_Feature VALUES ('$generated_hash_id', $id);");

    /**
     * Saving images in media/Properties_img/ directory 
     * Adding image path to DB
     * Storing image id in $images_id
     */
    $images_id = array();
    for ($i = 0; $i < count($_FILES['uploaded_files']['name']); $i++) {
        $image_info = [
            'name'      => $_FILES['uploaded_files']['name'][$i],
            'type'      => $_FILES['uploaded_files']['type'][$i],
            'tmp_name'  => $_FILES['uploaded_files']['tmp_name'][$i],
            'error'     => $_FILES['uploaded_files']['error'][$i],
            'size'      => $_FILES['uploaded_files']['size'][$i]
        ];

        // El archivo debe ser menor a 3mb
        // TODO: Ver que pedo con esto
        if($image_info['size'] / (1024 ** 2) > MAX_FILE_SIZE){
            array_push(
                $messages, 
                "La imagen {$_FILES['uploaded_files']['name'][$i]} excede el tamaño máximo (3mb)"
            );
            continue;
        }

        /**
         * Le pone un trailer al nombre de las imágenes para saber que fue reescalada al tamaño del frontend
         * El tamaño al que es escalado es 500x500 conservando las proporciones de la imagen
         * comprime la imagen al 40%
         * Guarda el archivo original en el directorio media/Original_img/ 
         */
        $handler = new UploadHandler($image_info);
        if ($handler->uploaded){
            $handler->process(Path::MEDIA_PATH('Original_img'));
            if(!$handler->processed) throw new Exception($handler->error, 1);
            $handler->file_name_body_add   = '_RESIZED';
            $handler->image_convert        = 'png';
            $handler->image_resize         = true;
            $handler->image_x              = 600;
            $handler->image_y              = 500;
            $handler->image_ratio          = true;
            $handler->png_compression      = 4;
            // Guarda el archivo en el directorio media/Properties_img/ 
            $handler->process(Path::MEDIA_PATH('Properties_img'));
            if ($handler->processed) {
                $handler->clean();
            } else {
                throw new Exception($handler->error, 1);
            }
        }

        // $file_path = Path::MEDIA_PATH('Properties_img').$handler->file_dst_name;
        $file_url = Path::MEDIA_HOST_URL('Properties_img').$handler->file_dst_name;
        
        // Guarda el path en la DB y guarda el id del registro en $images_id
        DBCursor::select("
            INSERT INTO Image 
            (img_path) VALUES
            ('$file_url');
        ");

        $image_id = DBCursor::select("
            SELECT * FROM Image 
            ORDER BY img_id DESC 
            LIMIT 1;
        ")[0]->img_id;

        array_push($images_id, $image_id);
    }

    // Adding relation records between Properties and Images
    foreach ($images_id as $id)
        DBCursor::select("INSERT INTO Property_Image VALUES ('$generated_hash_id', $id);");
    
    // Redirect to form
    $url = Path::HOST_NAME().'/add-property';
    header("Location: $url");
?>