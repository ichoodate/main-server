<?php

namespace App\Models\Keyword;

use App\Model;

class Nationality extends Model
{
    public const COUNTRY_ID = 'country_id';
    public const ID = 'id';

    protected $fillable = [
        self::ID,
        self::COUNTRY_ID,
    ];

    protected $table = 'keyword_nationalities';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
