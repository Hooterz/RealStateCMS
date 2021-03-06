<?php
    namespace controller\api;

    use controller\tools\APIRealState;
    use Exception;

    $message = 'State: ';
    try {
        header('Content-Type: application/json');
        $response = APIRealState::getProperties(
            $limit = $_GET['limit'] ?? null, 
            $offset = $_GET['offset'] ?? null,
            $all = $_GET['all'] ?? false
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