<?php
namespace App\Services;
use Illuminate\Support\Facades\Validator;
use App\Models\Album;
use App\Models\Users;

class AlbumServices{


    public function addAlbum($req){
        try{
        $validator = Validator::make($req->all(),[
                "remote_id" => "required",
                "status" => "required",
                "venue_id" => "required"
            ]);

            if($validator->fails()){
                return valfailed_response(["details"=>$validator->errors()]);
            }

            $album = Album::create([
                "remote_id" => $req->input("remote_id"),
                "date_add" => now(),
                "date_over" => now(),
                "date_upd" => now(),
                "status" => $req->input("status"),
                "venue_id" => $req->input("venue_id")
            ]);

            if(!$album){
                return null;
            }
            $users = Users::create([
                "name" => $req->input("name"),
                "email" => $req->input("email"),
                "date_add" => now(),
                "log" => "",
                "album_id" => 111
            ]);

            return compact("album", "users");
        }catch(Exception $e){
            throw $e;
        }catch(TypeError $e){
            throw $e;
        }
    }
}

?>