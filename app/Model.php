<?php

namespace App;

use App\Models\Obj;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

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

    public function save(array $options = [])
    {
        if (Obj::class != static::class && !$this->exists) {
            $attrs = $this->getAttributes();
            $obj = new Obj([
                Obj::MODEL_CLASS => static::class,
            ]);

            if (\in_array(static::ID, array_keys($attrs))) {
                $obj->forceFill([Obj::ID => $attrs[static::ID]]);
            }

            $obj->save();
            $this->setAttribute(static::ID, $obj->getKey());
        }

        return parent::save($options);
    }

    public function setCast($key, $value)
    {
        $this->casts[$key] = $value;
    }
}
