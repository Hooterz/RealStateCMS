<?php
    namespace controller;

    use controller\tools\APIRealState;
    use settings\Path;
    use Illuminate\Database\Capsule\Manager as DBCursor;
use Illuminate\Support\Facades\DB;

require('controller/tools/Twig.php');

    $already_changed_features = false;
    $new_features = json_decode($_POST['features']) ?? null;

    // Current stored Property
    $current_property = APIRealState::getProperty($id); 

    // Comparando categoría (diferente)
    if($current_property->prop_category !== $_POST['type_select'] && !$already_changed_features){
        // Actualiza el tipo de categoría
        $new_cat_id = DBCursor::select("SELECT cat_id FROM Category WHERE cat_name = '{$_POST['type_select']}';");
        DBCursor::select("UPDATE Property SET prop_category = $new_cat_id WHERE prop_id = $id;");

        // Actualiza las características

        // Borrando las características actuales
        $feature_ids = DBCursor::select("SELECT propFeatureg_feature_id FROM Property_Feature WHERE propFeature_prop_id = $id;");
        DBCursor::select("DELETE FROM Property_Feature WHERE propFeature_prop_id = $id;");
        foreach ($feature_ids as $feature_id)
            DBCursor::select("DELETE FROM Feature WHERE feature_id = $feature_id;");

        // Integrando las características nuevas
        foreach ($new_features as $feature)
            DBCursor::select("INSERT INTO Feature (feature_content) VALUES($feature);");

        $already_changed_features = true;
    }

    // Comparando características
    // TODO: Hacer la comparación con las características

    // Nombre distinto
    if($current_property->prop_name !== $_POST['prop_name'])
        DBCursor::select("UPDATE Property SET prop_name = {$_POST['prop_name']} WHERE prop_id = $id;");

    // Comprobando localización
    // Si hay nueva location
    if(strlen($_POST['prop_new_location']) !== 0){
        DBCursor::select("INSERT INTO Location (lo_name) VALUES('{$_POST['prop_new_location']}');");

        $new_location_id = DBCursor::select("
            SELECT lo_id 
            FROM Location 
            WHERE lo_name = '{$_POST['prop_new_location']}';
        ")[0]->lo_id;

        DBCursor::select("UPDATE Property SET prop_location = $new_location_id WHERE prop_id = $id;");
    }
    // Si sucede que solo cambia de location
    else{
        $new_location_id = DBCursor::select("
            SELECT lo_id 
            FROM Location 
            WHERE lo_name = '{$_POST['prop_location']}';
        ");
        DBCursor::select("UPDATE Property SET prop_location = $new_location_id WHERE prop_id = $id;");
    }

    // Comprueba la dirección
    if($current_property->prop_address !== $_POST['prop_address'])
        DBCursor::select("UPDATE Property SET prop_address = {$_POST['prop_address']} WHERE prop_id = $id;");

    // Comprueba la descripcióm
    if($current_property->prop_description !== $_POST['prop_description'])
        DBCursor::select("UPDATE Property SET prop_description = {$_POST['prop_description']} WHERE prop_id = $id;");

    // Comprueba el precio
    if($current_property->prop_price !== $_POST['prop_price'])
        DBCursor::select("UPDATE Property SET prop_price = {$_POST['prop_price']} WHERE prop_id = $id;");

    // Comprueba el area
    if($current_property->prop_area !== $_POST['prop_area'])
        DBCursor::select("UPDATE Property SET prop_area = {$_POST['prop_area']} WHERE prop_id = $id;");
    
    // Comprobando los archivos
    // NOTE: Al registrase imágenes nuevas se van a sobreescribir las anteriores, sin llegar a borrarlas del servidor
    // TODO: Hacer la comparación de imágenes

    // NOTE: Redirigir al property-list
    $redirect_url = Path::PATH_FROM_HOST_URL('property-list');
    header("Location: $redirect_url");

?>