<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use TypeError;
use App\Services\mailServices;
use App\Models\Remote;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RemoteController extends Controller
{
    //

    public function getRemote($remote)
    {
        try {
            $this->helper("Response");
            $this->helper("Hashing");
            $data = Remote::where(["id" => $remote, "status"=>1])->first();
            $token = my_hash("SALT123" . $remote);
            if (! $data) {
                return failed_response(["error" => "ID $remote not found"]);
            }
            return success_response(["data" => $data, "token" => $token]);
        } catch (Exception $e) {
            echo $e;
        } catch (TypeError $e) {
            echo $e;
        }
    }


    public function addRemote(Request $req)
    {
        try {
            $this->helper("Response");
            $validator = Validator::make($req->all(), [
                "remoteid" => "required|numeric",
                "venue" => "required|numeric"
            ]);

            if ($validator->fails()) {
                return valfailed_response(["error" => $validator->errors()]);
            }

            $find = Remote::where(["id" => $req->input("remoteid")])->first();
            if ($find) {
                $idnum = $req->input("remoteid");
                return failed_response(["error" => "ID #$idnum is already exist"]);
            }

            $result = Remote::create([
                "id" => $req->input("remoteid"),
                "venue_id" => $req->input("venue")
            ]);

            if (! $result) {
                return failed_response(["error" => "Server Error"]);
            }

            return success_response(["message" => "OK"]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }

    public function getAll()
    {
        $this->helper("Response");
        try {
            $result = DB::select("select r.id, v.name, (SELECT count(*) from album a where a.remote_id = r.id and a.status = 'live') as 'online' from remote r, venue v where r.venue_id = v.id and r.status = 1 order by r.id asc;");
            return success_response(["data" => $result]);
        } catch (TypeError $e) {
            return error_response(["error"=>$e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $this->helper("Response");
        try {
            $result = Remote::where(["id" => $id])->update(["status"=>0]);
            return success_response(["message"=>"OK"]);
        } catch (TypeError $e) {
            return error_response(["error"=>$e->getMessage()]);
        }
    }


    public function unlive(mailServices $mail,$id){
        $this->helper("Response");
        try {
            $result = Album::where(["remote_id"=>$id])->update(["status"=>"longterm"]);
            return success_response(["message"=>"OK"]);
        } catch (TypeError $e) {
            return error_response(["error"=>$e->getMessage()]);
        }
    }

    public function check($id){
        $this->helper("Response");
        try {
            $result = Album::where(["remote_id"=>$id, "status"=>"live"])->first();
            if(!$result){
                return failed_response(["error"=>"SESSION EXPIRED"]);
            }
            return success_response(["message"=>"OK"]);
        } catch (TypeError $e) {
            return error_response(["error"=>$e->getMessage()]);
        }
    }

}
