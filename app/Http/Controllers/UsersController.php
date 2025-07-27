<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Exception;
use TypeError;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->helper("Response");
    }

    public function register(Request $req){
        try{
            $result = Users::create([
            "name"=> $req->input("name"),
            "email" => $req->input("email"),
            "date_add" => now(),
            "log" => "",
            "album_id" => 111
        ]);

        return success_response(["data"=>new UserResource($result)]);
        }catch(Exception $e){
            return error_response(["error"=>$e->getMessage()]);
        }
        catch(TypeError $e){
            return error_response(["error"=>$e->getMessage()]);
        }

    }
}
