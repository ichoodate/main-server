<?php

namespace App\Services;

use Illuminate\Extend\Service;

class CursoringService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => ['cursor', 'limit', 'query', 'order_by_list', function ($cursor, $limit='', $query, $orderByList) {

                $wheres = [];
                $result = [];

                foreach ( $orderByList as $column => $direction )
                {
                    if ( $direction == 'asc' )
                    {
                        $wheres[] = [$column, '>', $cursor->{$column}];
                    }
                    else
                    {
                        $wheres[] = [$column, '<', $cursor->{$column}];
                    }
                }

                while ( $limit != 0 && count($wheres) != 0 )
                {
                    $newQuery = clone $query;

                    foreach ( $wheres as $i => $where )
                    {
                        if ( $where == end($wheres) )
                        {
                            $newQuery->where($where[0], $where[1], $where[2]);
                        }
                        else
                        {
                            $newQuery->where($where[0], '=', $where[2]);
                        }
                    }

                    array_pop($wheres);

                    $list   = $newQuery->get();
                    $limit  = $limit - count($list);
                    $result = array_merge($result, $list->all());
                }

                return $query->getModel()->newCollection($result);
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
