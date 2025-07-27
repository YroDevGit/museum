<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "album";

    protected $fillable = [
        "remote_id",
        "date_add",
        "date_over",
        "date_upd",
        "status",
        "venue_id"
    ];

    public $timestamps = false;
    //
}
