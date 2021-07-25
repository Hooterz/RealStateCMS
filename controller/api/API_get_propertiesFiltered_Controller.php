<?php
    namespace controller\api;

    use controller\tools\APIRealState;
    use Exception;

    $message = 'State: ';
    try {
        header('Content-Type: application/json');
        $response = APIRealState::getPropertiesFiltered(
            $id = $_GET['filter_id'] ?? null,
            $name = $_GET['filter_name'] ?? null, 
            $date = $_GET['filter_date'] ?? null
        );
        $message .= (empty($response) ? 'Empty' : 'Success');
        echo (json_encode([
            'properties' => $response,
            'message' => $message
        ]));
    }
    catch(Exception $e){
        header('Content-Type: application/json');
        echo json_encode([
            'message' => $message."Error: {$e->getMessage()}"
        ]);
    }
?>