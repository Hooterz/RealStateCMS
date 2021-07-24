<?php
    namespace controller\api;

    use controller\tools\APIRealState;
    use Exception;

    $message = 'State: ';
    try {
        header('Content-Type: application/json');
        $response = APIRealState::countProperties();
        $message .= (empty($response) ? 'Empty' : 'Success');
        echo (json_encode([
            'value' => $response,
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