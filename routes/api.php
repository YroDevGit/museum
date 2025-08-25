<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CaptureController;
use Illuminate\Http\Request;
use App\Http\Controllers\RemoteController;
use App\Models\Users;
use App\Http\Controllers\processController;
use App\Models\inviteToken;
use App\Http\Controllers\adminController;
use App\Http\Controllers\venueController;

Route::prefix("")->middleware("auth.authenticate")->group(function () {

    Route::get("/photographer/remote/{remote}/{token}", [AlbumController::class, "checkRemote"]);
    Route::post("/photographer/add", [AlbumController::class, "add"]);
    Route::post("/photographer/invited/{album}", [UsersController::class, "invited"]);
    Route::post("/upload", [AlbumController::class, "upload"]);

    Route::get("/upload/{album}", [CaptureController::class, "getByAlbum"]);
    Route::delete("/img/delete/{img}", [CaptureController::class, "removeImg"]);
    Route::get("/qr/get/{qrid}", [RemoteController::class, "getRemote"]);
    Route::post("/share/email", [processController::class, "shareAlbumEmail"]);
    Route::post("/saveimage/{imageid}", [CaptureController::class, "saveImage"]);
    Route::post("/logoutSession/{albumid}", [AlbumController::class, "logoutsession"]); 
    Route::get("/special", [processController::class, "special"]);  
    Route::get("/checkAlbum/{albumid}", [AlbumController::class, "checkAlbum"]);
    Route::get("/showGallery", [CaptureController::class, "showGallery"]);      
});

    Route::get("/download/{albumid}", [CaptureController::class, "downloadZip"]);
    Route::post("/admin/login", [adminController::class, "login"]);
    Route::get("/venue/getall", [venueController::class, "getAll"]);
    Route::post("/remote/add", [RemoteController::class, "addRemote"]);
    Route::get("/remote/getAll", [RemoteController::class, "getAll"]);
    Route::get("/remote/check/{id}", [RemoteController::class, "check"]);
    Route::post("/remote/delete/{id}", [RemoteController::class, "delete"]);
    Route::post("/remote/unlive/{id}", [RemoteController::class, "unlive"]);
