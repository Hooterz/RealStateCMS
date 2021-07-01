<?php
    // NOTE: Esta script es para probar el correcto funcionamiento de las APIs
    namespace controller\api;
    use Exception;

    $message = 'State: ';
    try {
        header('Content-Type: application/json');
        echo (json_encode([
            'message' => 'This is a test'
        ]));
    }
    catch(Exception $e){
        header('Content-Type: application/json');
        echo json_encode([
            'message' => $message."Error: {$e->getMessage()}"
        ]);
    }
?>