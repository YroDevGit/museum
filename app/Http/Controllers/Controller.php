<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //

    public function helper(string $helper)
    {
        // __DIR__ points to the directory of the current PHP file
        $path = __DIR__ . '/../Helpers/' . $helper . '.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            throw new \Exception("Helper file not found: $path");
        }
    }


    public function services(string $services)
    {
        require_once base_path("app/Services/$services.php");
    }
}
