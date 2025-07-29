<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use TypeError;
use App\Models\Remote;


class RemoteController extends Controller
{
    //

    public function getRemote($remote){
        try{
            $this->helper("Response");
            $this->helper("Hashing");
            $data = Remote::where(["id"=>$remote])->first();
            $token = my_hash("SALT123".$remote);
            if(! $data){
                return failed_response(["error"=>"ID $remote not found"]);
            }
            return success_response(["data"=>$data, "token"=>$token]);
        }catch(Exception $e){
            echo $e;
        }catch(TypeError $e){
            echo $e;
        }
    }
}
