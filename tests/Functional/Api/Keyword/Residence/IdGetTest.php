<?php

namespace Tests\Functional\Api\Keyword\ResidenceCountries;

use App\Database\Models\Keyword\ResidenceCountry;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/keyword/residence-countries/{id}';

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {

            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

}
