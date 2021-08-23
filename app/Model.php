<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    public $incrementing = false;
    protected $guarded = [];

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

    public function getModelType()
    {
        return array_flip(Relation::morphMap())[static::class];
    }

    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    public function newEloquentBuilder($query)
    {
        return new Query($query);
    }

    public function newSubIdQuery()
    {
        return $this->setKeysForSaveQuery($this->newModelQuery());
    }

    public function relation($related, array $localKeys, array $otherKeys, $isManyRelation)
    {
        $query = (new $related())->newQuery();

        return new Relation($query, $this, $localKeys, $otherKeys, $isManyRelation);
    }

    public function setCast($key, $value)
    {
        $this->casts[$key] = $value;
    }
}
