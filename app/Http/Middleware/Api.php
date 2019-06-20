<?php

namespace App\Http\Middleware;

use App\Database\Model;
use App\Database\Collection;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\Relations\Relation;

class Api {

    public function handle($request, $next)
    {
        $response = $next($request);
        $arr      = $response->getOriginalContent();
        $service  = ApiController::servicify($arr);
        $service->run();

        $errors = $service->totalErrors();
        $result = $service->data()->get('result');

        if ( $errors->isEmpty() )
        {
            $response->setData([
                'result' => $this->restify($result)
            ]);
        }
        else
        {
            $response->setData([
                'errors' => $errors
            ]);
        }

        return $response;
    }

    public static function restify($result)
    {
        if ( ! is_a($result, Model::class) && ! is_a($result, Collection::class) )
        {
            return $result;
        }

        $isModel = $result instanceof Model ? true : false;
        $return  = [];
        $items   = $isModel ? [$result] : $result->all();

        foreach ( $items as $i => $item )
        {
            $type = array_flip(Relation::morphMap())[get_class($item)];
            $value = [];
            $value['_type'] = $type;
            $value['_attributes'] = $item->getAttributes();
            $value['_relations'] = [];

            foreach ( $item->getRelations() as $key => $relation )
            {
                $value['_relations'][$key] = static::restify($relation);
            }

            $return[] = $value;
        }

        return $isModel ? $return[0] : $return;
    }

}
