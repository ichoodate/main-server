<?php

namespace App;

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
        $str = str_replace('?', "'?'", parent::toSql());

        return vsprintf(str_replace('?', '%s', $str), $this->getBindings());
    }
}
