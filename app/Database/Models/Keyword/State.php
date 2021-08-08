<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class State extends Model
{
    public const ID = 'id';
    public const COUNTRY_ID = 'country_id';
    public const NAME = 'name';

    public const ENTITIES = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];

    protected $table = 'keyword_states';
    protected $fillable = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function residence()
    {
        return $this->hasOne(Residence::class, 'related_id', 'id');
    }
}
