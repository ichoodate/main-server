<?php

namespace Database\Factories\Model;

use App\Database\Models\Obj;
use Mockery;

abstract class ModelFactory {

    abstract public static function default();

    /**
     * foreign key check should be disabled.
     */
    public static function create(array $data = [])
    {
        $model = static::make($data);

        $model->save();

        return $model;
    }

    public static function factory($modelClass)
    {
        $className = basename($modelClass);

        return inst('Database\\Factories\\Model\\' . $className . 'Factory');
    }

    public static function make(array $data = [], $itemCount = null)
    {
        $modelClass = static::class();
        $model      = inst($modelClass);
        $data       = static::setDefault($data);
        $attrs      = array_only($data, $model->getVisible());

        if ( $itemCount != null )
        {
            $collection = inst($modelClass)->newCollection();

            for ( $i = 0; $i < $itemCount; $i++ )
            {
                $collection->push(static::make($data));
            }

            return $collection;
        }

        $model->fill($attrs);

        return $model;
    }

    public static function setDefault($data)
    {
        return array_merge(static::default(), $data);
    }

    public static function class()
    {
        $className  = basename(static::class);
        $modelName  = preg_replace('/Factory$/', '', $className);
        $modelClass = 'App\\Database\\Models\\' . $modelName;

        return $modelClass;
    }

}
