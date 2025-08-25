<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capture;
use Exception;
use Mockery\Matcher\Type;
use TypeError;
use App\Http\Resources\CaptureUpdates;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Response;

class CaptureController extends Controller
{
    public function getByAlbum(Request $req, $album)
    {
        try {
            $active = 1;
            $this->helper("Response");
            $result = null;
            if ($req->has("saved")) {
                $result = Capture::where(["album_id" => $album, "status" => 1])->get();
            } else {
                $result = Capture::where(["album_id" => $album, "status" => 0])->get();
            }
            return success_response(["data" => $result, "updates" => CaptureUpdates::collection($result)]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }

    public function removeImg($img)
    {
        $this->helper("response");
        try {
            $result =  Capture::where(['id' => $img])->first();
            if (!$result) {
                return failed_response(["error" => "Image id not found!"]);
            }

            $imgID = $result['id'];
            $imgPath = $result['image_path'];

            $del = unlink($imgPath);
            if (!$del) {
                failed_response(["error" => "Unable to delete unexisting image"]);
            }

            $final = Capture::where(['id' => $imgID])->delete();
            if (! $final) {
                failed_response(["error" => "Unable to delete unexisting image"]);
            }
            return success_response(["data" => $result, "deleted" => $final]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }

    public function saveImage($imageId)
    {
        $this->helper("response");
        try {
            $result = Capture::where(["id" => $imageId])->update([
                "status" => 1
            ]);
            return success_response(["data" => $result]);
        } catch (Exception $e) {
            return error_response(["error" => $e->getMessage()]);
        } catch (TypeError $e) {
            return error_response(["error" => $e->getMessage()]);
        }
    }

    public function downloadZip($albumid)
    {
        $folder = $albumid;
        $folderPath = public_path("uploads/$folder");

        if (!file_exists($folderPath)) {
            abort(404, 'Folder not found.');
        }

        $zipFileName = "MyAlbum_".$folder . '.zip';
        $zipPath = public_path("uploads/temp/$zipFileName");

        // Make sure temp folder exists
        if (!file_exists(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($folderPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);

                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();

            // Return download response and delete zip after send
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return response()->json(['error' => 'Unable to create ZIP file'], 500);
    }
}
