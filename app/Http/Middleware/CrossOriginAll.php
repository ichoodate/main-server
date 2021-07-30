<?php

namespace App\Http\Middleware;

class CrossOriginAll {

    public function handle($request, $next)
    {
        $response = $next($request);

        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers','Accept, Authorization, Content-Type, DNT, Origin, Referer, User-Agent, X-XSRF-TOKEN, X-CSRF-TOKEN');
        $response->header('Access-Control-Allow-Credentials',' true');

        return $response;
    }

}
