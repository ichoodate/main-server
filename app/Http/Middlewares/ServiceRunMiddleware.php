<?php

namespace App\Http\Middlewares;

use App\Model;
use FunctionalCoding\Service;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ServiceRunMiddleware
{
    public function handle($request, $next)
    {
        DB::beginTransaction();

        $response = $next($request);
        $arr = $response->getOriginalContent();

        if (!Service::isInitable($arr)) {
            $response->{'Response' == Arr::last(explode('\\', get_class($response))) ? 'setContent' : 'setData'}([
                'result' => $arr,
            ]);

            return $response;
        }

        $service = Service::initService($arr);
        $result = $service->run();
        $errors = $service->getTotalErrors();
        $body = null;

        if (empty($errors)) {
            // runAfterCommitCallbacks() should be called before restify()
            $service->runAfterCommitCallbacks();
            if ($result instanceof AbstractPaginator) {
                $path = preg_replace('/api\//', '', Request::path());
                $path = $path.'?'.Request::getQueryString();
                $path = preg_replace('/(\&|)page\=\d*/', '', $path);
                $path = str_replace('?&', '?', $path);

                $result->setPath($path);

                $data = $result->getCollection();
                $data = $this->restify($data);
                $data = $result->setCollection(collect($data));
            } else {
                $data = $this->restify($result);
            }
            $body = ['result' => $data];
            $response->setStatusCode(200);
            DB::commit();
        } else {
            $body = ['errors' => $errors];
            $response->setStatusCode(400);
            DB::rollback();
        }

        $response->{'Response' == Arr::last(explode('\\', get_class($response))) ? 'setContent' : 'setData'}($body);

        return $response;
    }

    public static function restify($result)
    {
        if (!is_a($result, Model::class) && !is_a($result, Collection::class)) {
            return $result;
        }

        $isModel = $result instanceof Model ? true : false;
        $return = [];
        $items = $isModel ? [$result] : $result->all();

        foreach ($items as $i => $item) {
            $type = array_flip(Relation::morphMap())[get_class($item)];
            $value = [];
            $value['_type'] = $type;
            $value['_attributes'] = $item->getAttributes();
            $value['_relations'] = [];

            foreach ($item->getRelations() as $key => $relation) {
                $value['_relations'][$key] = static::restify($relation);
            }

            $return[] = $value;
        }

        return $isModel ? $return[0] : $return;
    }
}
