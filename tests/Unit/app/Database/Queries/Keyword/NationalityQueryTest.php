<?php

namespace Tests\Unit\App\Database\Queries\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;
use Tests\Unit\App\Database\Queries\_TestCase;

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
