<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inviteToken extends Model
{
    protected $table = "invite_token";

    protected $fillable = [
        "remote_id",
        "album_id",
        "remote_token",
        "date_added",
        "status",
        "token",
        "email"
    ];

    public $timestamps =false;
}
