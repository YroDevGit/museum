<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capture;
use Exception;
use Mockery\Matcher\Type;
use TypeError;

class CaptureController extends Controller
{
    public function getByAlbum($album){
        try{
            $this->helper("Response");
            $result = Capture::where(["album_id"=>$album])->get();
            return success_response(["data"=>$result]);
        }catch(Exception $e){
            return error_response(["error"=>$e->getMessage()]);
        }catch(TypeError $e){
            return error_response(["error"=>$e->getMessage()]);
        }
    }
}
