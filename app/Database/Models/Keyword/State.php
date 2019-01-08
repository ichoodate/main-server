<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceState;

class State extends Model {

    protected $table = 'keyword_states';
    protected $visible = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME
    ];

    const COUNTRY_ID = 'country_id';
    const NAME       = 'name';

    const ENTITIES = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];

    public function countryQuery()
    {
        return inst(Country::class)->aliasQuery()
            ->qWhere(Country::ID, $this->{static::COUNTRY_ID});
    }

    public function residenceQuery()
    {
        return inst(ResidenceState::class)->aliasQuery()
            ->qWhere(ResidenceState::STATE_ID, $this->{static::ID});
    }

}
