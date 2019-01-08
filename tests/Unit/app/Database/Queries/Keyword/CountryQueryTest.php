<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceCountry;
use App\Database\Models\Keyword\State;

class CountryQueryTest extends _TestCase {

    public function testResidenceQuery()
    {
        $this->assertHasOneOrManyQuery(
            'residence',
            ResidenceCountry::class,
            ResidenceCountry::COUNTRY_ID
        );
    }

    public function testStateQuery()
    {
        $this->assertHasOneOrManyQuery(
            'state',
            State::class,
            State::COUNTRY_ID
        );
    }

}
