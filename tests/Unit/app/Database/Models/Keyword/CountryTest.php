<?php

namespace Tests\Unit\App\Database\Models\Keyword;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use Tests\Unit\App\Database\Models\_TestCase;

class CountryTest extends _TestCase {

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
