<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = "user";

    protected $fillable = [
        "date_add",
        "album_id",
        "email",
        "name",
        "log",
        "org"
    ];

    public $timestamps = false;

    protected $hidden =[
        "log"
    ];
}
