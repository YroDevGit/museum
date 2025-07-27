<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use TypeError;
use App\Models\Album;
use Illuminate\Support\Facades\Validator;
use App\Services\AlbumServices;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Capture;
use App\Models\Remote;

class AlbumController extends Controller
{
    //
    public function __construct()
    {
        $this->helper("Response");
    }

    public function add(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                "remote_id" => "required",
                "venue_id" => "required",
                "name" => "required",
                "email" => "required|email"
            ]);

            if ($validator->fails()) {
                return valfailed_response(["errors" => $validator->errors()]);
            }

            $album = Album::create([
                "remote_id" => $req->input("remote_id"),
                "date_add" => now(),
                "date_over" => now(),
                "date_upd" => now(),
                "status" => "live",
                "venue_id" => $req->input("venue_id")
            ]);

            if (!$album) {
                return failed_response(["error" => "Unable to proceed", "details" => $album]);
            }
            $users = Users::create([
                "name" => $req->input("name"),
                "email" => $req->input("email"),
                "date_add" => now(),
                "log" => "",
                "album_id" => $album->id
            ]);

            return success_response(["data" => ["users" => $users, "albums" => $album]]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }


    public function checkRemote(Request $req, $remote, $token)
    {
        $id =  $remote;
        try {
            if (!$id || !$token) {
                return failed_response(["details" => "Param remote id and token is required"]);
            }

            $rem = Remote::where(["id"=>$id])->first();
            if(! $rem){
               return failed_response(["error" => "Remote not found!"]); 
            }
            $result = Album::where(["remote_id" => $id, "status" => "live"])->first();
            if ($result) {
                return failed_response(["error" => "This device is already in use"]);
            }

            return success_response(["data" => "REMOTE IS READY", "remote" => $id]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }



    public function upload(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|string',
                'user_id' => 'required|integer',
                "album_id" => 'required',
                "remote_id" => "required",
            ]);

            $userId = $request->input('user_id');
            $albumId = $request->input('album_id');
            $base64Image = $request->input('image');
            $remoteId = $request->input("remote_id");

            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $extension = strtolower($type[1]); // jpg, png, gif

                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return response()->json(['error' => 'Invalid image type'], 400);
                }
            } else {
                return response()->json(['error' => 'Invalid base64 string'], 400);
            }

            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                return response()->json(['error' => 'Base64 decode failed'], 400);
            }

            $filename = Str::random(40) . '.jpg'; // save as jpg always
            $relativePath = "uploads/" . $albumId . "/$userId/$filename";
            $fullPath = public_path($relativePath);

            File::ensureDirectoryExists(dirname($fullPath));

            file_put_contents($fullPath, $imageData);

            $result = Capture::create([
                "album_id" => $albumId,
                "photobooth_id" => "1",
                "remote_id" => $remoteId,
                "capture_time" => now(),
                "image_path" => $relativePath,
            ]);

            return response()->json([
                'code' => 200,
                'success' => true,
                'path' => asset($relativePath),
                'filename' => $filename
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => env("CODE_ERROR"),
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } catch (TypeError $e) {
            return response()->json([
                'code' => env("CODE_ERROR"),
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
