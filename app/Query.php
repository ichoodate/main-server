<?php

namespace App;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Query extends \Illuminate\Database\Eloquent\Builder
{
    public function alias($alias = null)
    {
        $query = $this->getQuery();

        if (is_null($alias)) {
            $alias = $query->from.'_'.static::$instId++;
        }

        $query->from = app('db')->raw($query->from.' as '.$alias);
    }

    public function findMany($ids, $columns = ['*'])
    {
        $result = parent::findMany($ids, $columns);
        $idKey = $this->getModel()->getKeyName();
        $collect = $this->getModel()->newCollection();

        foreach ($ids as $id) {
            $model = $result->where($idKey, $id)->first();

            $collect->push($model);
        }

        return $collect;
    }

    public function getTable()
    {
        $segments = explode(' ', $this->getQuery()->from);

        return array_last($segments);
    }

    public function selectIdQuery()
    {
        $keyName = $this->getModel()->getKeyName();

        return $this->select($keyName)->getQuery();
    }

    public function toSqlWithBindings()
    {
        $toSql = function ($q) use (&$toSql) {
            $str = str_replace('?', "'?'", $q->toSql());
            $bindings = [];

            foreach ($q->getBindings() as $i => $v) {
                if (is_object($v) && ($v instanceof EloquentBuilder || $v instanceof QueryBuilder)) {
                    $v = $toSql($v);
                }
                $bindings[$i] = $v;
            }

            return vsprintf(str_replace('?', '%s', $str), $bindings);
        };

        return $toSql($this);
    }
}
