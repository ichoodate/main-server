<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Nationality extends Model
{
    public const ID = 'id';
    public const COUNTRY_ID = 'country_id';

    public const ENTITIES = [
        self::ID,
        self::COUNTRY_ID,
    ];

    protected $table = 'keyword_nationalities';
    protected $fillable = [
        self::ID,
        self::COUNTRY_ID,
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
