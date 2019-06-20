<?php

namespace Tests\Unit\App\Database\Queries\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use Tests\Unit\App\Database\Queries\_TestCase;

class StateQueryTest extends _TestCase {

    public function testCountryQuery()
    {
        $this->assertBelongsToQuery(
            'country',
            State::COUNTRY_ID,
            Country::class
        );
    }

    public function testResidenceQuery()
    {
        $this->assertHasOneOrManyQuery(
            'residence',
            Residence::class,
            Residence::RELATED_ID
        );
    }

}
