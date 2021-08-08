<?php

namespace App\Services;

use Illuminate\Extend\Service;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class PagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.skip' => function ($query, $skip) {

                $query->skip($skip);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => function ($limit, $page, $query) {

                return app()->makeWith(LengthAwarePaginator::class, [
                    'items' => $query->get(),
                    'total' => $query->count(),
                    'perPage' => $limit,
                    'currentPage' => $page,
                    'options' => [
                        'path' => Paginator::resolveCurrentPath(),
                        'pageName' => 'page',
                    ]
                ]);
            },

            'skip' => function ($limit, $page) {

                return ( $page - 1 ) * $limit;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'page'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
