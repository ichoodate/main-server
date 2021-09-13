<?php

namespace App\Http\Middlewares;

use App\Services\Auth\AuthUserFindingService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SetAuthUserMiddleware
{
    public function handle($request, $next)
    {
        $response = $next($request);
        $content = $response->getOriginalContent();

        if (!$content) {
            return $response;
        }

        $class = $content[0];
        $data = $content[1];
        $names = $content[2];

        if ($data['auth_token']) {
            $authService = new AuthUserFindingService([
                'auth_token' => $data['auth_token'],
            ], [
                'auth_token' => $names['auth_token'],
            ]);
            $authService->run();

            if (empty($authService->totalErrors())) {
                Auth::setUser($authService->data()['result']);
            } else {
                $data['auth_user'] = [AuthUserFindingService::class, [
                    'auth_token' => $data['auth_token'],
                ], [
                    'auth_token' => $names['auth_token'],
                ]];
            }
        }

        $response->{'Response' == Arr::last(explode('\\', get_class($response))) ? 'setContent' : 'setData'}([$class, $data, $names]);

        return $response;
    }
}
