<?php

namespace App\Database\Queries\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use App\Database\Query;

class CountryQuery extends Query {

    public function residenceQuery()
    {
        $subQuery = $this->qSelect(Country::ID)->getQuery();

        return inst(Residence::class)->query()
            ->qWhereIn(Residence::RELATED_ID, $subQuery);
    }

    public function stateQuery()
    {
        $subQuery = $this->qSelect(Country::ID)->getQuery();

        return inst(State::class)->query()
            ->qWhereIn(State::COUNTRY_ID, $subQuery);
    }

}
