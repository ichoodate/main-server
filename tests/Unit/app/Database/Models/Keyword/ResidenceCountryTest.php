<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceCountry;

class ResidenceCountryTest extends _TestCase {

    public function testCountryQuery()
    {
        $this->assertBelongsToQuery(
            'country',
            ResidenceCountry::COUNTRY_ID,
            Country::class
        );
    }

}
