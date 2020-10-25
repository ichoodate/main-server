<?php

namespace App\Database;

use Illuminate\Support\Arr;

class Collection extends \Illuminate\Database\Eloquent\Collection {

    public function loadVisible($list)
    {
        $list = is_array($list) ? $list : func_get_args();
        $relations = [];

        foreach ( $list as $key )
        {
            Arr::set($relations, $key, true);
        }

        $this->loadRel($this, $relations);
    }

    private function loadRel($collect, $relations)
    {
        if ( $collect->isEmpty() )
        {
            return;
        }

        $collect = $collect->filter(function ($item) {
            return $item != null;
        });

        if ( is_a($collect->first(), static::class) ) {
            $collect = new static($collect->flatten(1)->all());
        }

        foreach ( $relations as $rel => $v )
        {
            $groupLists = $collect->groupBy(function ($item) use ($rel) {
                return get_class($item->{$rel}()->getModel());
            });
            foreach ( $groupLists as $modelClass => $groupList )
            {
                $model = app($modelClass);
                $columns = array_diff(array_merge($model->getFillable(), $model->getGuarded()), $model->getHidden());
                $groupList->load($rel.':'.implode(',', $columns));
            }

            if ( $v !== true )
            {
                $this->loadRel(new static($collect->pluck($rel)->all()), $v);
            }
        }
    }

    public static function modelClass()
    {
        $className = basename(static::class);
        $modelName = preg_replace('/Collection$/', '', $className);
        $modelName = str_replace('Collections', 'Models', $modelName);

        return $modelName;
    }

    public function sortByIds($ids)
    {
        $result = new static;

        foreach ( $ids as $id )
        {
            $item = $this->find($id)? : null;

            $result->push($item);
        }

        return $result;
    }

}
