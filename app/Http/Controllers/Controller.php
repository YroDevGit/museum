<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //

    public function helper(string $helper)
    {
        require_once base_path("app/Helpers/$helper.php");
    }

    public function services(string $services)
    {
        require_once base_path("app/Services/$services.php");
    }
}
