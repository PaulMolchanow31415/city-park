<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\HandleCors;

class Cors extends HandleCors {
    public function handle($request, \Closure $next) {
        return $next($request) -> header('Access-Control-Allow-Origin', '*')
            -> header(
                'Access-Control-Allow-Methods',
                'GET',
                'POST',
                'PUT',
                'PATCH',
                'DELETE',
                'OPTIONS',
            );
    }
}