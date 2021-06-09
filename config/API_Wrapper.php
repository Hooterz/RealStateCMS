<?php
declare(strict_types=1);
namespace config;

class APIResponses
{
    /**
     * @param $data
     * Send the API responses through HTTP, so JS file can fetch data from the backend.
     */
    public static function SendData(array $data)
    {
        header('Content-Type:aplication/json');
        echo json_encode($data);
    }
}

?>