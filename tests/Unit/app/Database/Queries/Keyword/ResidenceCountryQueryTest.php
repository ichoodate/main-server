<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceCountry;

class ResidenceCountryQueryTest extends _TestCase {

    public function testCountryQuery()
    {
        $this->assertBelongsToQuery(
            'country',
            ResidenceCountry::COUNTRY_ID,
            Country::class
        );
    }

}
