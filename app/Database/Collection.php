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
        $className = basename('\\', static::class);
        $modelName = preg_replace('/Collection$/', '', $className);

        return 'App\\Database\\Models\\' . $modelName;
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

    public function sortById($ids)
    {
        $items = [];

        foreach ( $ids as $id )
        {
            $items[] = $this->find($id);
        }

        return new static($items);
    }

}
