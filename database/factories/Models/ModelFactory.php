<?php

namespace Database\Factories\Models;

use App\Database\Models\Card;
use App\Database\Models\Obj;
use Mockery;

abstract class ModelFactory {

    abstract public static function default();

    public static function create(array $data = [])
    {
        $class = static::class();
        $model = static::make($data);
        $attrs = $model->getAttributes();

        if ( $class != Obj::class )
        {
            $obj = new Obj;
            $obj->forceFill([
                Obj::MODEL_CLASS => $class,
                Obj::ID => $model->{$class::ID},
            ]);
            $obj->save();
        }

        app('db')->getSchemaBuilder()->disableForeignKeyConstraints();

        $model->save();
        $model = $model->fresh();

        app('db')->getSchemaBuilder()->enableForeignKeyConstraints();

        return $model;
    }

    public static function factory($modelClass)
    {
        $path = str_replace('App\\Database\\Models\\', '', $modelClass);

        return inst('Database\\Factories\\Models\\' . $path . 'Factory');
    }

    public static function make(array $data = [], $itemCount = null)
    {
        $modelClass = static::class();
        $model      = inst($modelClass);
        $data       = static::setDefault($data);
        $attrs      = array_only($data, $model->getFillable());

        if ( $itemCount != null )
        {
            $collection = inst($modelClass)->newCollection();

            for ( $i = 0; $i < $itemCount; $i++ )
            {
                $collection->push(static::make($data));
            }

            return $collection;
        }

        foreach ( $attrs as $attr => $value )
        {
            $model->setAttribute($attr, $value);
        }

        return $model;
    }

    public static function setDefault($data)
    {
        return array_merge(static::default(), $data);
    }

    public static function class()
    {
        $path = str_replace('Database\\Factories\\Models\\', '', static::class);

        return 'App\\Database\\Models\\' . str_replace('Factory', '', $path);
    }

}
