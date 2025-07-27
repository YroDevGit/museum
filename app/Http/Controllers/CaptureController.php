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

    public function removeImg($img){
        try{
            $this->helper("response");
            $result =  Capture::where(['id'=>$img])->first();
            if(!$result){
                return failed_response(["error"=>"Image id not found!"]);
            }

            $imgID = $result['id'];
            $imgPath = $result['image_path'];

            $del = unlink($imgPath);
            if(!$del){
                failed_response(["error"=>"Unable to delete unexisting image"]);
            }

            $final = Capture::where(['id'=>$imgID])->delete();
            if(! $final){
                failed_response(["error"=>"Unable to delete unexisting image"]);
            }


            return success_response(["data"=>$result, "deleted"=>$final]);


            


        }catch(Exception $e){

        }catch(TypeError $e){

        }
    }
}
