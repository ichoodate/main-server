<?php

namespace Tests\Unit\App\Database\Models\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use Tests\Unit\App\Database\Models\_TestCase;

class StateTest extends _TestCase {

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
