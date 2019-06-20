<?php

namespace App\Http\Middleware;

class ParameterCasting {

    public function handle($request, $next)
    {
        $request->query->replace($this->castAll($request->query->all()));
        $request->request->replace($this->castAll($request->request->all()));
        $request->server->replace($this->castAll($request->server->all()));
        $request->cookies->replace($this->castAll($request->cookies->all()));

        return $next($request);
    }

    public function castAll(array $params)
    {
        foreach ( $params as $key => $value )
        {
            if ( is_array($value) )
            {
                $params[$key] = $this->castAll($value);
            }
            else
            {
                $params[$key] = $this->cast($value);
            }
        }

        return $params;
    }

    public function cast($value)
    {
        if ( $value == 'null' )
        {
            $value = null;
        }
        else if ( $value === 'true' )
        {
            $value = true;
        }
        else if ( $value === 'false' )
        {
            $value = false;
        }
        else if ( is_string($value) && preg_match('/^\d+$/', $value) )
        {
            $value = (integer)$value;
        }

        return $value;
    }

}
