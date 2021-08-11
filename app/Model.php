<?php

namespace App;

use App\Models\Obj;

abstract class Model extends \FunctionalCoding\Illuminate\Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public $incrementing = false;

    // this property related to freshTimestamp method
    // public $timestamps = false;
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function create(array $attributes = [])
    {
        if (Obj::class != static::class && !array_key_exists(static::ID, $attributes)) {
            $obj = new Obj([
                Obj::MODEL_CLASS => static::class,
            ]);
            $obj->save();

            $attributes[static::ID] = $obj->getKey();
        }

        $model = new static($attributes);
        $model->save();

        return $model;
    }

    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    public function newEloquentBuilder($query)
    {
        return new Query($query);
    }

    public function setAttribute($key, $value)
    {
        if ($this->hasSetMutator($key) || in_array($key, $this->getFillable())) {
            parent::setAttribute($key, $value);
        } else {
            $this->setRelation($key, $value);
        }

        return $this;
    }
}
