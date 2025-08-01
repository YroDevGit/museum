<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header("apikey");
        if (!$header) {
            return response()->json([
                "code" => env("CODE_UNAUTHORIZE"),
                "message" => "Unauthorize",
                "details" => ["error" => "no apikey found"]
            ]);
        }
        if ($header !== env("API_KEY")) {
            return response()->json([
                "code" => env("CODE_UNAUTHORIZE"),
                "message" => "Unauthorize",
                "details" => ["error" => "Invalid apikey"]
            ]);
        }
        return $next($request);
    }
}
