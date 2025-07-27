<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remote extends Model
{
    protected $table = "remote";

    public $fillable = [
        "id",
        "venue_id"
    ];

    public $timestamps = false;
}
