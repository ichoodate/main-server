<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Nationality extends Model {

    protected $table = 'keyword_nationalities';
    protected $fillable = [
        self::ID,
        self::COUNTRY_ID
    ];

    const ID         = 'id';
    const COUNTRY_ID = 'country_id';

    const ENTITIES = [
        self::ID,
        self::COUNTRY_ID
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

}
