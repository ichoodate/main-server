<?php

namespace App\Http\Middleware;

class Api {

    public function handle($request, $next)
    {
        $response = $next($request);
        $arr      = $response->getData();
        $class    = $arr[0];
        $names    = (array) $arr[2];

        foreach ( $arr[1] as $key => $value )
        {
            if ( ! ($value instanceof \stdClass) )
            {
                $data[$key] = $value;
            }
        }

        $service = inst($class, [null, $data, $names]);

        $service->runProcess();

        $errors = $service->getTotalErrors();
        $result = $service->data()->get('result');

        if ( $errors->isEmpty() )
        {
            $response->setData([
                'success' => $result
            ]);
        }
        else
        {
            $response->setData([
                'error' => $errors
            ]);
        }

        return $response;
    }

}
