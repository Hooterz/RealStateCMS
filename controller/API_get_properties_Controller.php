<?php
    namespace controller;
    use Twig\{
        Loader\FilesystemLoader,
        Environment
    };
    use RealStateModel\{
    Category,
    PropertyQuery,
        CategoryQuery,
        Property
    };

    if(isset($_GET['offset'], $_GET['limit']))
    {
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];

        $properties = PropertyQuery::create()->find();
        
        foreach($properties as $property)
        {           
            $data = [
                'prop'.$property->getPropId() => [
                    'prop_name' => $property->getPropName(),
                    'prop_address' => $property->getPropAddress(),
                    'prop_location' => $property->getPropLocation(),
                    'prop_description' => $property->getPropDescription(),
                    'prop_area' => $property->getPropArea(),
                    'prop_price' => $property->getPropPrice(),
                    'prop_pubDate' => $property->getPropPubdate(),
                    'prop_isHidden' => $property->getPropIshidden(),
                    'prop_category' => $property->getPropCategory()
                ],
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else
    {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>