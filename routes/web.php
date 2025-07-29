<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CaptureController;
use Illuminate\Http\Request;
use App\Http\Controllers\RemoteController;

Route::get('/', function () {
    return view('scan');
});

Route::get('/qrcode', function () {
    return view('qrgenerate');
});

Route::get('/register', function () {
    return view('form');
});

Route::get('/cam/{userid}/{albumid}', function ($userid, $albumid) {
    return view('cam',["userid"=>$userid, "albumid"=>$albumid]);
});

Route::get('/photographer/album/{album}/user/{user}/{token}', function (Request $req, $album,$user, $token) {
    $controller = new AlbumController();
    $hash = $controller->validateUserAlbum($user, $album);
    if($hash !== $token){
        abort(404, "Page not found.!");exit;
    }
    return view('main',["userid"=>$user, "albumid"=>$album]);
});

Route::get('/shareqr/{remote}/{token}', function ($remote, $token) {
    return view('shareqr', ['token'=>$token, 'remote'=>$remote]);
});

Route::get('/hello',[AlbumController::class, "add"]);
Route::get("/photographer/remote/{remote}/{token}", [AlbumController::class, "checkRemote"]);
Route::post("/photographer/add", [AlbumController::class, "add"]);
Route::post("/photographer/invited/{album}", [UsersController::class, "invited"]);
Route::post("/upload", [AlbumController::class, "upload"]);

Route::get("/upload/{album}", [CaptureController::class,"getByAlbum"]);
Route::delete("/img/delete/{img}", [CaptureController::class, "removeImg"]);
Route::get("/qr/get/{qrid}", [RemoteController::class, "getRemote"]);
