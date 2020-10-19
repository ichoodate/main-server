<?php

namespace App\Database;

use App\Database\Collection;
use App\Database\Models\Obj;

abstract class Model extends \Illuminate\Database\Eloquent\Model {

    const CREATED_AT = null;
    const UPDATED_AT = null;

    // this property related to freshTimestamp method
    // public $timestamps = false;
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $incrementing = false;

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
        return new Collection($models);
    }

    public function relation($related, array $localKeys, array $otherKeys, $isManyRelation)
    {
        $query = (new $related)->newQuery();

        return new Relation($query, $this, $localKeys, $otherKeys, $isManyRelation);
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
}
