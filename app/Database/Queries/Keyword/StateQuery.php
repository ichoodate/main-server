<?php

namespace App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceState;
use App\Database\Models\Keyword\State;
use App\Database\Query;

class StateQuery extends Query {

    public function countryQuery()
    {
        $subQuery = $this->qSelect(State::COUNTRY_ID)->getQuery();

        return inst(Country::class)->aliasQuery()
            ->qWhereIn(Country::ID, $subQuery);
    }

    public function residenceQuery()
    {
        $subQuery = $this->qSelect(State::ID)->getQuery();

        return inst(ResidenceState::class)->aliasQuery()
            ->qWhereIn(ResidenceState::STATE_ID, $subQuery);
    }

}
