<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;

class NationalityQueryTest extends _TestCase {

    public function testCountryQuery()
    {
        $this->assertBelongsToQuery(
            'country',
            Nationality::COUNTRY_ID,
            Country::class
        );
    }

}
