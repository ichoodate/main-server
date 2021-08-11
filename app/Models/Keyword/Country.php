<?php

namespace App\Models\Keyword;

use App\Model;

class Country extends Model
{
    public const ID = 'id';
    public const ISO = 'iso'; // iso_3166_1_alpha2
    public const NAME = 'name';
    public const E164 = 'e164';
    public const CCTLD = 'cctld';
    public const CURRENCY = 'currency';
    public const LANGUAGE = 'language';

    protected $table = 'keyword_countries';
    protected $fillable = [
        self::ID,
        self::ISO,
        self::NAME,
        self::E164,
        self::CCTLD,
        self::CURRENCY,
        self::LANGUAGE,
    ];

    public function nationality()
    {
        return $this->hasOne(Nationality::class, 'country_id', 'id');
    }

    public function residence()
    {
        return $this->hasOne(Residence::class, 'related_id', 'id');
    }

    public function state()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }
}
