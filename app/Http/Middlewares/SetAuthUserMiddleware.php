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

        if ($class::getAllRuleLists()->offsetExists('auth_user')) {
            $authService = new AuthUserFindingService([
                'auth_token' => array_key_exists('auth_token', $data) ? $data['auth_token'] : '',
            ], [
                'auth_token' => $names['auth_token'],
            ]);
            $authUser = $authService->run();
            $names['auth_user'] = 'authorized user';
            $names['auth_user_id'] = 'id of authorized user';
            if (empty($authService->getTotalErrors())) {
                Auth::setUser($authUser);
                $data['auth_user'] = $authUser;
                $data['auth_user_id'] = $authUser->getKey();
            } else {
                $data['auth_user'] = $authService;
            }
        }

        $response->{'JsonResponse' == Arr::last(explode('\\', get_class($response))) ? 'setData' : 'setContent'}([$class, $data, $names]);

        return $response;
    }
}
