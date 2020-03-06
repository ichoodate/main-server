<?php

namespace App\Http\Middleware;

use App\Database\Model;
use App\Database\Collection;
use App\Service;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;

class Api {

    public function handle($request, $next)
    {
        DB::beginTransaction();

        $response = $next($request);
        $arr      = $response->getOriginalContent();

        if ( !Service::isCanServicify($arr) )
        {
            $response->setContent([
                'result' => $arr
            ]);

            DB::commit();

            return $response;
        }

        $service = Service::initService($arr);
        $service->run();

        $errors = $service->totalErrors();
        $result = $service->data()->get('result');

        if ( $errors->isEmpty() )
        {
            $response->setData([
                'result' => $this->restify($result)
            ]);

            DB::commit();
        }
        else
        {
            $response->setData([
                'errors' => $errors
            ]);

            DB::rollback();
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
