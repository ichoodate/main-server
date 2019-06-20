<?php

namespace Tests\Unit\App\Database\Models\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;
use Tests\Unit\App\Database\Models\_TestCase;

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
