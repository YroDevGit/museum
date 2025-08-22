<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\venue;

class venueController extends Controller
{
    //
    public function getAll(){
        $this->helper("Response");
        $result = venue::all();
        return success_response(["data"=>$result]);
    }
}
