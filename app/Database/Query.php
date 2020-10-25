<?php

namespace App\Database;

class Query extends \Illuminate\Extend\Query {

    public static $instId = 1;

    public function alias($alias = null)
    {
        $query = $this->getQuery();

        if ( is_null($alias) )
        {
            $alias = $query->from . '_' . static::$instId++;
        }

        $query->from = app('db')->raw($query->from . ' as ' . $alias);
    }

    public function findMany($ids, $columns = ['*'])
    {
        $result  = parent::findMany($ids, $columns);
        $idKey   = $this->getModel()->getKeyName();
        $collect = $this->getModel()->newCollection();

        foreach ( $ids as $id )
        {
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

    public function orQWhere($column, $operator = null, $value = null)
    {
        return $this->qWhere($column, $operator, $value, 'or');
    }

    public function qGroupBy(...$columns)
    {
        $first = array_first($columns);

        if ( is_array($first) )
        {
            $columns = $first;
        }

        foreach ( $columns as $i => $column )
        {
            $columns[$i] = $this->getTable() . '.'. $column;
        }

        return call_user_func_array([$this, 'groupBy'], [$columns]);
    }

    public function qOrWhere($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'orWhere'], $args);
    }

    public function qOrWhereIn($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'orWhereIn'], $args);
    }

    public function qWhere($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'where'], $args);
    }

    public function qWhereBetween($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereBetween'], $args);
    }

    public function qWhereIn($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereIn'], $args);
    }

    public function qWhereNotIn($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereNotIn'], $args);
    }

    public function qWhereNull($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereNull'], $args);
    }

    public function qWhereNotNull($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereNotNull'], $args);
    }

    public function qWhereSub($column)
    {
        $args = func_get_args();

        $args[0] = $this->getTable() . '.' . $column;

        return call_user_func_array([$this, 'whereSub'], $args);
    }

    public function qSelect($columns)
    {
        $columns = is_array($columns) ? $columns : [$columns];

        foreach ( $columns as $i => $column )
        {
            $columns[$i] = $this->getTable() . '.' . $column;
        }

        return call_user_func_array([$this, 'selectRaw'], [implode(',', $columns)]);
    }

    public function qOrderBy($column, $direction)
    {
        $column = $this->getTable() . '.' . $column . ' ' . $direction;

        return call_user_func_array([$this, 'orderByRaw'], [$column]);
    }

    public function selectIdQuery()
    {
        $keyName = $this->getModel()->getKeyName();

        return $this->qSelect($keyName)->getQuery();
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if ( $column instanceof \Closure )
        {
            $query = $this->model->newQueryWithoutScopes();

            $query->from($this->getTable());

            call_user_func($column, $query);

            $this->query->addNestedWhereQuery($query->getQuery(), $boolean);
        }
        else
        {
            call_user_func_array([$this->query, 'where'], func_get_args());
        }

        return $this;
    }

    /**
     * overriding laravel/framework
     *
     * @param  array  $values
     * @return int
     */
    public function update(array $values)
    {
        // return $this->toBase()->update($this->addUpdatedAtColumn($values));

        return $this->toBase()->update($values);
    }

}
