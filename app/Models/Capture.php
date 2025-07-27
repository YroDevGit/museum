<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    protected $table = "capture";
    protected $fillable = [
        "album_id",
        "photobooth_id",
        "remote_id",
        "capture_time",
        "image_path"
    ];

    public $timestamps =false;
}
