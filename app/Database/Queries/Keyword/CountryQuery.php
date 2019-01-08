<?php

namespace App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\State;
use App\Database\Models\Keyword\ResidenceCountry;
use App\Database\Query;

class CountryQuery extends Query {

    public function residenceQuery()
    {
        $subQuery = $this->qSelect(Country::ID)->getQuery();

        return inst(ResidenceCountry::class)->aliasQuery()
            ->qWhereIn(ResidenceCountry::COUNTRY_ID, $subQuery);
    }

    public function stateQuery()
    {
        $subQuery = $this->qSelect(Country::ID)->getQuery();

        return inst(State::class)->aliasQuery()
            ->qWhereIn(State::COUNTRY_ID, $subQuery);
    }

}
