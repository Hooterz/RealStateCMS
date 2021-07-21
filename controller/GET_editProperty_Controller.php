<?php
    namespace controller;

    use controller\tools\APIRealState;
    use settings\Path;
    use Illuminate\Database\Capsule\Manager as DBCursor;
use Illuminate\Support\Facades\DB;

require('controller/tools/Twig.php');

    // Current Property
    $current_property = APIRealState::getProperty($id); 
    
    // Current Location Id
    $current_lo_id = DBCursor::select("SELECT * FROM Location WHERE lo_name = '{$current_property->prop_location}';");
    $current_lo_id = $current_lo_id[0]->lo_id;

    // Current features
    $current_features = APIRealState::getPropertyFeatures($current_property->prop_id);
    if($current_property->prop_category === 'Casa')
        foreach ( $current_features as $feature) 
            $feature->feature_content = explode(": ", $feature->feature_content)[1];

    echo $twig->render('editproperty.html', [
        'post_response' => Path::HOST_NAME()."/edit-property/{$current_property->prop_id}",
        'categories' => DBCursor::select('SELECT cat_name FROM Category;'),
        'locations' => DBCursor::select('SELECT * FROM Location;'),
        'property' => $current_property,
        'currentLocationID' => $current_lo_id,
        'features' => $current_features
    ]);

?>