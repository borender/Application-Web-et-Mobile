<?php
abstract class Json
{
    public static function sendJSON(
        $info
    ) {
        header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        // header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');
      
        header('Content-Type: application/json');
        echo json_encode($info);
    }
}