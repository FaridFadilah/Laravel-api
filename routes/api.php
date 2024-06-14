<?php

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::class);

Route::post("/home", function(Request $request){
    $payload = [
        "id" => $request->get("id"),
        "name" => $request->post("name")
    ];

    

    return response()->json([
        'message' => "hello world",
        "status" => true,
        "data" => $payload,
        "errorCode" => "a01"
    ], 400);
});

Route::post("/login", function(Request $request){
    $email = $request->post("email");
    $password = $request->post("password");

    $user = User::where("email", $email)->first();
    if($user == null){
        return response()->json([
            'data' => null,
            "message" => "User tidak ditemukan",
            "status" => false,
            "errorCode" => "a02"
        ]);
    }

    $token = $user->createToken(uniqid());

    return response()->json([
        'data' => $token->plainTextToken,
        "message" => "",
        "status" => true,
        "errorCode" => ""
    ]);
});