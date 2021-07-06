<?php
    // NOTE: Esta script es para probar el correcto funcionamiento de las APIs
    namespace controller\api;
    use Exception;
    use Illuminate\Database\Capsule\Manager as DBCursor;

    $message = 'State: ';
    try {
        // header('Content-Type: application/json');
        DBCursor::select("
            INSERT INTO Location 
            (lo_name) 
            VALUES ('{$_GET['location']}');
        ");

        $response = DBCursor::select(" SELECT lo_id FROM Location WHERE lo_name = '{$_GET['location']}';");


        d($response[0]->lo_id);
        // echo (json_encode([
        //     'message' => 'This is a test'
        // ]));
    }
    catch(Exception $e){
        header('Content-Type: application/json');
        echo json_encode([
            'message' => $message."Error: {$e->getMessage()}"
        ]);
    }
?>