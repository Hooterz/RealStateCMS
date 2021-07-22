<?php
    namespace controller;

    use controller\tools\APIRealState;
    use settings\Path;
    use Verot\Upload\Upload as UploadHandler;
    use Illuminate\Database\Capsule\Manager as DBCursor;
    use Exception;
    require('controller/tools/Twig.php');

    
    // La propiedad actual
    $current_property = APIRealState::getProperty($id);
    // Array de características nuevas ya parseadas
    $new_features = json_decode($_POST['features']) ?? null;
    // Array de StdClass que representan a las características almacenadas sobre una propiedad
    $current_stored_features = DBCursor::select("
        SELECT feature_id, feature_content, propFeature_prop_id AS 'prop_id' FROM Feature
        INNER JOIN Property_Feature on feature_id = propFeatureg_feature_id
        HAVING propFeature_prop_id = '$id'
        ORDER BY feature_id;
    ");

    /**
     * Borra los features actuales y pone los nuevos con su relación incluida.
     *
     * @param string $prop_id
     * @param array $new_features
     * @return void
     */
    function ReplaceFeature($prop_id ,$new_features){
        // Borrando características actuales
        $current_features_relation = DBCursor::select("
            SELECT * FROM Property_Feature
            WHERE propFeature_prop_id = '$prop_id';
        ");

        DBCursor::select("
            DELETE FROM Property_Feature
            WHERE propFeature_prop_id = '$prop_id';
        ");

        foreach ($current_features_relation as $relation) {
            $current_features_relation = DBCursor::select("
                DELETE FROM Feature 
                WHERE feature_id = {$relation->propFeatureg_feature_id};
            ");
        }

        // Añadiendo características nuevas 
        $features_id = array();
        foreach ($new_features as $feature) {
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

        // Añadiendo las relaciones
        foreach ($features_id as $feature_id)
            DBCursor::select("INSERT INTO Property_Feature VALUES ('$prop_id', $feature_id);");
    }

    // NOTE: Trabajando sobre las características

    // Si hay una diferencia de categoría
    if($current_property->prop_category !== $_POST['type_select'] && !$already_changed_features){
        // Actualiza la categoría
        $new_cat_id = DBCursor::select("
            SELECT cat_id FROM Category 
            WHERE cat_name = '{$_POST['type_select']}';
        ")[0]->cat_id;
        DBCursor::select("UPDATE Property SET prop_category = $new_cat_id WHERE prop_id = '$id';");

        // Reemplaza las caraterísticas de la propiedad sobre la que se trabaja
        ReplaceFeature($id, $new_features);
    }
    // Si hay diferente cantidad de categorías
    else if(count($current_stored_features) !== count($new_features))
        ReplaceFeature($id, $new_features);
    // Entonces las comprueba todas y si hay una distinta entonces las reemplaza
    else{
        $need_feature_mod = false;

        // Comprueba que las nuevas características sean iguales para determinar el reemplazo
        foreach ($current_stored_features as $feature) 
            if(!in_array($feature->feature_content, $new_features)){
                $need_feature_mod = true;
                break;
            }

        // Si el reemplazo es requerido 
        if($need_feature_mod)
            ReplaceFeature($id, $new_features);   
    }

    // Comprueba el nombre y actualiza en caso necesario
    if($current_property->prop_name !== $_POST['prop_name'])
        DBCursor::select("UPDATE Property SET prop_name = '{$_POST['prop_name']}' WHERE prop_id = '$id';");

    // NOTE: Trabajando sobre la localización
    // Comprueba la localización y actualiza en caso necesario
    // Si hay nueva location
    $current_location_id = DBCursor::select("
        SELECT prop_location FROM Property
        WHERE prop_id = '$id';
    ")[0]->prop_location;

    if(strlen($_POST['prop_new_location']) !== 0){
        // Inserta nueva location en la BD
        DBCursor::select("INSERT INTO Location (lo_name) VALUES('{$_POST['prop_new_location']}');");
        // Actualiza la location de la propiedad
        $new_location_id = DBCursor::select("
            SELECT lo_id 
            FROM Location 
            WHERE lo_name = '{$_POST['prop_new_location']}';
        ")[0]->lo_id;
        DBCursor::select("UPDATE Property SET prop_location = $new_location_id WHERE prop_id = '$id';");
    }
    // Si solo cambia de location
    else if($current_location_id != $_POST['prop_location']){
        // Actualiza la location de la propiedad
        $new_location_id = DBCursor::select("
            SELECT lo_id 
            FROM Location 
            WHERE lo_id = '{$_POST['prop_location']}';
        ")[0]->lo_id;
        
        DBCursor::select("UPDATE Property SET prop_location = $new_location_id WHERE prop_id = '$id';");
    }

    // Comprueba la dirección y actualiza en caso necesario
    if($current_property->prop_address !== $_POST['prop_address'])
        DBCursor::select("UPDATE Property SET prop_address = '{$_POST['prop_address']}' WHERE prop_id = '$id';");

    // Comprueba la descripción y actualiza en caso necesario
    if($current_property->prop_description !== $_POST['prop_description'])
        DBCursor::select("UPDATE Property SET prop_description = '{$_POST['prop_description']}' WHERE prop_id = '$id';");

    // Comprueba el precio y actualiza en caso necesario
    if($current_property->prop_price !== $_POST['prop_price'])
        DBCursor::select("UPDATE Property SET prop_price = {$_POST['prop_price']} WHERE prop_id = '$id';");

    // Comprueba el área y actualiza en caso necesario
    if($current_property->prop_area !== $_POST['prop_area'])
        DBCursor::select("UPDATE Property SET prop_area = {$_POST['prop_area']} WHERE prop_id = '$id';");
    
    // NOTE: Trabajando sobre las imágenes
    // Comprueba las imágenes y actualiza en caso necesario
    // Si se subió algo
    if($_FILES['uploaded_files']['name'][0] !== ''){
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
        
    }

    // NOTE: Redirigir al property-list
    $redirect_url = Path::HOST_NAME().'/property-list';
    header("Location: $redirect_url");
