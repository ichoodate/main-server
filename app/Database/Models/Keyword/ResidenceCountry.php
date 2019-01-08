<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Keyword\Country;

class ResidenceCountry extends Model {

    protected $table = 'keyword_residence_countries';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const COUNTRY_ID = 'country_id';

    const ENTITIES = [
        self::ID,
        self::COUNTRY_ID
    ];

    public function countryQuery()
    {
        return inst(Country::class)->aliasQuery()
            ->qWhere(Country::ID, $this->{static::COUNTRY_ID});
    }

}
