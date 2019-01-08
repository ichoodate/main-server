<?php

namespace App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceCountry;
use App\Database\Query;

class ResidenceCountryQuery extends Query {

    public function countryQuery()
    {
        $subQuery = $this->qSelect(ResidenceCountry::COUNTRY_ID)->getQuery();

        return inst(Country::class)->aliasQuery()
            ->qWhereIn(Country::ID, $subQuery);
    }

}
