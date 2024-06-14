<?php

function success($data, $message){
    return response()->json([
        "data" => $data,
        "status" => true,
        "message" => $message
    ]);
}

function fails($message, $errorcode){
    return response()->json([
        "data" => null,
        "status" => false,
        "message" => $message,
    ], $errorcode);
}