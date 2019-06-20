<?php

namespace Tests\Unit\App\Database\Queries\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use Tests\Unit\App\Database\Queries\_TestCase;

class CountryQueryTest extends _TestCase {

    public function testResidenceQuery()
    {
        $this->assertHasOneOrManyQuery(
            'residence',
            Residence::class,
            Residence::RELATED_ID
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
