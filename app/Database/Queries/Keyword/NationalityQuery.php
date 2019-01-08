<?php

namespace App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;
use App\Database\Query;

class NationalityQuery extends Query {

    public function countryQuery()
    {
        $subQuery = $this->qSelect(Nationality::COUNTRY_ID)->getQuery();

        return inst(Country::class)->aliasQuery()
            ->qWhereIn(Country::ID, $subQuery);
    }

}
