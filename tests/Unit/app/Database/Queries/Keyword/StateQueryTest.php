<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\ResidenceState;
use App\Database\Models\Keyword\State;

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
            ResidenceState::class,
            ResidenceState::STATE_ID
        );
    }

}
