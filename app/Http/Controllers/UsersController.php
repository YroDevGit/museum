<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Exception;
use TypeError;
use App\Models\Album;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    public function __construct()
    {   
        $this->helper("Hashing");
        $this->helper("Response");
    }

    public function register(Request $req)
    {
        try {
            $result = Users::create([
                "name" => $req->input("name"),
                "email" => $req->input("email"),
                "date_add" => now(),
                "log" => "",
                "album_id" => 111
            ]);

            return success_response(["data" => new UserResource($result)]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }

    public function invited(Request $req, $album)
    {
        try {
            $result = Users::create([
                "name" => $req->input("name"),
                "email" => $req->input("email"),
                "date_add" => now(),
                "log" => "",
                "album_id" => $album,
                "org" => 0
            ]);

            $albumResult = Album::where(["id"=>$album])->first();
            $albumId = $album;
            $userId = $result->id;
            $myhash = my_hash("SALT123".$albumId.$userId);
            return success_response(["data" => ["users" => $result, "albums" => $album, "user_id"=>$userId, "album_id"=>$albumId, "hometoken"=>$myhash]]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }
}
