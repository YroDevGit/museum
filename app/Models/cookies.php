<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cookies extends Model
{
    protected $table = "cookies";

    protected $fillable = [
        "album",
        "user",
        "homeurl",
        "mainIMGID",
        "remote_id",
        "remotetoken",
        "date_created",
        "status",
        "token"
    ];

    public $timestamps = false;
}
