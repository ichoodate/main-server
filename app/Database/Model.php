<?php

namespace App\Database;

use App\Database\Models\Obj;
use Carbon\Carbon;

abstract class Model extends \Illuminate\Database\Eloquent\Model {

    const CREATED_AT = null;
    const UPDATED_AT = null;

    // this property related to freshTimestamp method
    // public $timestamps = false;
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $incrementing = false;

    abstract public function getExpandable();

    public

    public static function query()
    {
        $builder = static::query();

        $builder->alias();

        return $builder;
    }

    public static function create(array $attributes = [])
    {
        if ( static::class != Obj::class && ! array_key_exists(static::ID, $attributes) )
        {
            $obj = inst(Obj::class, [[
                Obj::MODEL_CLASS => static::class
            ]]);
            $obj->save();

            $attributes[static::ID] = $obj->getKey();
        }

        $model = inst(static::class, [$attributes]);
        $model->save();

        return $model;
    }

    public function newCollection(array $models = [])
    {
        $class = str_replace('Models', 'Collections', static::class) . 'Collection';

        return new $class($models);
    }

    public function newEloquentBuilder($query)
    {
        $class = str_replace('Models', 'Queries', static::class) . 'Query';

        return new $class($query);
    }

    public function setAttribute($key, $value)
    {
        if ( $this->hasSetMutator($key) || in_array($key, $this->getFillable()) )
        {
            parent::setAttribute($key, $value);
        }
        else
        {
            $this->setRelation($key, $value);
        }

        return $this;
    }

    public function freshTimestamp()
    {
        return new Carbon(app('nowUtcTime'));
    }

    // deprecated
    // it converted use mysql timestamp option at date column
    // /**
    //  * overriding laravel/framework
    //  */
    // protected function updateTimestamps()
    // {
    //     $time = $this->freshTimestamp();

    //     // if (! $this->isDirty(static::UPDATED_AT)) {
    //     //     $this->setUpdatedAt($time);
    //     // }

    //     if (! $this->exists && ! $this->isDirty(static::CREATED_AT)) {
    //         $this->setCreatedAt($time);
    //     }
    // }

}
