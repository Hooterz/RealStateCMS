<?php
    namespace controller;

    use Propel\Runtime\ActiveQuery\Criteria;
    use Twig\{
            Loader\FilesystemLoader,
            Environment
        };
    use RealStateModel\{
        PropertyQuery,
        LocationQuery,
    };

if(isset($_GET['offset'], $_GET['limit']))
    {
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];

        $properties = PropertyQuery::create()
            ->orderByPropName(Criteria::DESC)
            ->offset($offset)
            ->limit($limit)
            ->find();
        
        foreach($properties as $property)
        {           
            $data = [
                'prop_'.$property->getPropId() => [
                    'prop_name' => $property->getPropName(),
                    'prop_address' => $property->getPropAddress(),
                    'prop_location' => LocationQuery::create()->findPk($property->getPropLocation())->find(),
                    'prop_description' => $property->getPropDescription(),
                    'prop_area' => $property->getPropArea(),
                    'prop_price' => $property->getPropPrice(),
                    'prop_pubDate' => $property->getPropPubdate(),
                    'prop_isHidden' => $property->getPropIshidden(),
                    'prop_category' => $property->getPropCategory()
                ],
            ];

            header('Content-Type: application/json');
            echo json_encode($data);
        }   
    }
    else{
        echo json_encode([
            'message' => 'Error'
        ]);
    }
?>