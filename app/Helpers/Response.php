<?php

if(! function_exists("success_response")){
    function success_response(array $response){
        return response()->json([
            "code"=> env("CODE_SUCCESS"),
            "message" => "OK",
            "details" => $response
        ]);
    }
}

if(! function_exists("error_response")){
    function error_response(array $response){
        return response()->json([
            "code"=> env("CODE_ERROR"),
            "message" => "SERVER ERROR",
            "details" => $response
        ]);
    }
}

if(! function_exists("failed_response")){
    function failed_response(array $response){
        return response()->json([
            "code"=> env("CODE_CONFLICT"),
            "message" => "FAILED",
            "details" => $response
        ]);
    }
}

if(! function_exists("valfailed_response")){
    function valfailed_response(array $response){
        return response()->json([
            "code"=> env("CODE_VALIDATION_ERROR"),
            "message" => "VALIDATION ERROR",
            "details" => $response
        ]);
    }
}

if(! function_exists("unauthorize_response")){
    function unauthorize_response(array $response){
        return response()->json([
            "code"=> env("CODE_UNAUTHORIZE"),
            "message" => "UNAUTHORIZED",
            "details" => $response
        ]);
    }
}

?>