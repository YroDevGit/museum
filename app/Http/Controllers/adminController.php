<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Http\Resources\CaptureUpdates;

class adminController extends Controller
{
    public function login(Request $req){
        $this->helper("Response");
        
        $result = admin::where(["username"=>$req->input("username"), "password"=>$req->input("password")])->first();
        if(! $result){
            return success_response(["details"=>$result, "login"=>0]); 
        }
        return success_response(["details"=>$result, "login"=>1]);
    }
}
