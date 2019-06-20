<?php

namespace App\Database;

class Collection extends \Illuminate\Database\Eloquent\Collection {

    public function empty()
    {
        $this->items = [];

        return $this;
    }

    public static function modelClass()
    {
        $className = basename(static::class);
        $modelName = preg_replace('/Collection$/', '', $className);
        $modelName = str_replace('Collections', 'Models', $modelName);

        return $modelName;
    }

    public function fresh($with = [])
    {
        $modelClass = static::modelClass();

        return inst($modelClass)->findMany($this->modelKeys());
    }

    public static function save()
    {
        foreach ( $this->all() as $item )
        {
            $item->save();
        }
    }

    public function sortByIds($ids)
    {
        $result = inst(static::class);

        foreach ( $ids as $id )
        {
            $item = $this->find($id)? : null;

            $result->push($item);
        }

        return $result;
    }

}
