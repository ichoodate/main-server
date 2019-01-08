<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Keyword\ResidenceCountry;
use App\Database\Models\Keyword\State;

class Country extends Model {

    protected $table = 'keyword_coutries';
    protected $visible = [
        self::ID,
        self::ISO,
        self::NAME,
        self::E164,
        self::CCTLD,
        self::CURRENCY,
        self::LANGUAGES
    ];

    const ISO       = 'iso'; // iso_3166_1_alpha2
    const NAME      = 'name';
    const E164      = 'e164';
    const CCTLD     = 'cctld';
    const CURRENCY  = 'currency';
    const LANGUAGES = 'languages';
    const DATA      = 'data';

    const DATA_VALUES = [
        ['KR', 'South Korea', '82', '.kr', 'KRW', 'ko-KR']
    ];

    public function setDataAttribute($value)
    {
        $this->attributes[static::ISO]       = $value[0];
        $this->attributes[static::NAME]      = $value[1];
        $this->attributes[static::E164]      = $value[2];
        $this->attributes[static::CCTLD]     = $value[3];
        $this->attributes[static::CURRENCY]  = $value[4];
        $this->attributes[static::LANGUAGES] = $value[5];
    }

    public function residenceQuery()
    {
        return inst(ResidenceCountry::class)->aliasQuery()
            ->qWhere(ResidenceCountry::COUNTRY_ID, $this->{static::ID});
    }

    public function stateQuery()
    {
        return inst(State::class)->aliasQuery()
            ->qWhere(State::COUNTRY_ID, $this->{static::ID});
    }

}
