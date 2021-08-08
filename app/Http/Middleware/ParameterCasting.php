<?php

namespace App\Http\Middleware;

class ParameterCasting
{
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
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $params[$key] = $this->castAll($value);
            } else {
                $params[$key] = $this->cast($value);
            }
        }

        return $params;
    }

    public function cast($value)
    {
        if ('null' === $value) {
            $value = null;
        } elseif ('true' === $value) {
            $value = true;
        } elseif ('false' === $value) {
            $value = false;
        } elseif (is_string($value) && preg_match('/^\d+$/', $value)) {
            $value = (int) $value;
        }

        return $value;
    }
}
