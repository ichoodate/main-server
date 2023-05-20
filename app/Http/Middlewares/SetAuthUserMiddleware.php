<?php

namespace App\Http\Middlewares;

use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SetAuthUserMiddleware
{
    public function handle($request, $next)
    {
        $response = $next($request);
        $content = $response->getOriginalContent();

        if (!Service::isInitable($content)) {
            return $response;
        }

        $class = $content[0];
        $data = $content[1];
        $names = $content[2];

        if (in_array('auth_token', $data) && $data['auth_token']) {
            $authService = new AuthUserFindingService([
                'auth_token' => $data['auth_token'],
            ], [
                'auth_token' => $names['auth_token'],
            ]);
            $authService->run();

            if (empty($authService->getTotalErrors())) {
                Auth::setUser($authService->getData()['result']);
            } else {
                $data['auth_user'] = $authService;
            }
        }

        $response->{'JsonResponse' == Arr::last(explode('\\', get_class($response))) ? 'setData' : 'setContent'}([$class, $data, $names]);

        return $response;
    }
}
