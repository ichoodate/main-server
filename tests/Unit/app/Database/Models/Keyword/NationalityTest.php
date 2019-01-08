<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;

class NationalityTest extends _TestCase {

    public function testCountryQuery()
    {
        $this->assertBelongsToQuery(
            'country',
            Nationality::COUNTRY_ID,
            Country::class
        );
    }

}
