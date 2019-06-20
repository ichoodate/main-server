<?php

namespace App\Database\Queries\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use App\Database\Query;

class StateQuery extends Query {

    public function countryQuery()
    {
        $subQuery = $this->qSelect(State::COUNTRY_ID)->getQuery();

        return inst(Country::class)->query()
            ->qWhereIn(Country::ID, $subQuery);
    }

    public function residenceQuery()
    {
        $subQuery = $this->qSelect(State::ID)->getQuery();

        return inst(Residence::class)->query()
            ->qWhereIn(Residence::RELATED_ID, $subQuery);
    }

}
