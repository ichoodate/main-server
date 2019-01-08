<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceCountry;
use App\Database\Models\Keyword\State;

class CountryTest extends _TestCase {

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
