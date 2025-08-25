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
use App\Models\cookies;


Route::get('/', function () {
    return view('scan');
});


Route::get('/logout', function () {
    return view('scan', ["logout"=>"yes"]);
});

Route::get('/qrcode', function () {
    return view('qrgenerate');
});

Route::get('/register', function () {
    return view('form');
});

Route::get('/dashboard', function(){
    return view("phpmyadmin/phpmyadmin");
});

Route::get('/gallery', function(){
    return view("phpmyadmin/pictures");
});

Route::get('/phpmyadmin', function(){
    return view("phpmyadmin/login");
});

Route::get('/cam/{userid}/{albumid}/{utoken}', function ($userid, $albumid, $utoken) {
    $controller = new AlbumController();
    $hash = $controller->validateUserAlbum($userid, $albumid);
    if($hash !== $utoken){
        abort(404, "Page not found.!");exit;
    }
    return view('cam',["userid"=>$userid, "albumid"=>$albumid, "utoken"=>$utoken]);
});

Route::get('/photographer/album/{album}/user/{user}/{token}', function (Request $req, $album,$user, $token) {
    $controller = new AlbumController();
    $hash = $controller->validateUserAlbum($user, $album);
    $userModel = Users::where(['id'=>$user])->first();
    if($hash !== $token){
        abort(404, "Page not found.!");exit;
    }
    return view('main',["userid"=>$user, "albumid"=>$album, "utoken"=> $hash, "codename"=>$userModel['name']]);
});

Route::get('/saved/photographer/album/{album}/user/{user}/{token}', function (Request $req, $album,$user, $token) {
    $controller = new AlbumController();
    $hash = $controller->validateUserAlbum($user, $album);
    $userModel = Users::where(['id'=>$user])->first();
    if($hash !== $token){
        abort(404, "Page not found.!");exit;
    }
    return view('saved',["userid"=>$user, "albumid"=>$album, "utoken"=>$token, "codename"=>$userModel['name']]);
});

Route::get('/shareqr/{remote}/{token}', function ($remote, $token) {
    return view('shareqr', ['token'=>$token, 'remote'=>$remote]);
});

Route::get("/sharemail/{invite_token}", function($invite_token){
    $find = inviteToken::where(["token"=>$invite_token,"status"=>0])->first();
    if(!$find){
        abort(404, "invalid link");exit;
    }
    //to-add:: update status to 1
    return view("tokenprocess", $find);
});

Route::get('/{token}', function ($token) {
    $cookie = inviteToken::where(["token"=>$token])->first();
    if(!$cookie){
        abort(404, "Not found");
    }
    $cookie['inactive'] = "yes";
    return view("tokenprocess", $cookie);
});






