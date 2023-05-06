<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;

class CheckJsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isJson()) {
            return ApiResponse::error('Invalid request format. Expected JSON.', 400);
        }

        return $next($request);
    }
}
