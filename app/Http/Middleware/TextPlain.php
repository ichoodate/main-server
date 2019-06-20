<?php

namespace App\Http\Middleware;

class TextPlain {

    public function handle($request, $next)
    {
        $response = $next($request);
        $content  = $response->content();
        $response->header('Content-Type', 'text/plain');
        $response->setContent(json_encode($content));

        return $response;
    }

}
