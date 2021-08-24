<?php

namespace App\Models\Keyword;

use App\Model;

class Country extends Model
{
    public const CCTLD = 'cctld';
    public const CURRENCY = 'currency';
    public const E164 = 'e164';
    public const ID = 'id';
    public const ISO = 'iso'; // iso_3166_1_alpha2
    public const LANGUAGE = 'language';
    public const NAME = 'name';

    protected $fillable = [
        self::ID,
        self::ISO,
        self::NAME,
        self::E164,
        self::CCTLD,
        self::CURRENCY,
        self::LANGUAGE,
    ];

    protected $table = 'keyword_countries';

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
