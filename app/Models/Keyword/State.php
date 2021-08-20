<?php

namespace App\Models\Keyword;

use App\Model;

class State extends Model
{
    public const COUNTRY_ID = 'country_id';

    public const ENTITIES = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];
    public const ID = 'id';
    public const NAME = 'name';
    protected $fillable = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];

    protected $table = 'keyword_states';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function residence()
    {
        return $this->hasOne(Residence::class, 'related_id', 'id');
    }
}
