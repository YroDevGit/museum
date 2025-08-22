<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class venue extends Model
{
    //
    protected $table = "venue";

    protected $fillable = [
        "id",
        "venue_id"
    ];

    public $timestamps = false;
}
