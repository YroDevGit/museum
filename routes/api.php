<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UsersController;

Route::prefix("api")->middleware("auth.authenticate")->group(function(){
    

    Route::prefix("album")->controller(AlbumController::class)->group(function(){
        Route::post("/add", "add");
    });

});

Route::post("/remote/add/{remote}/{token}", [AlbumController::class, "checkRemote"]);

