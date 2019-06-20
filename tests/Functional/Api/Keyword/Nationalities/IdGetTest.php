<?php

namespace Tests\Functional\Api\Keyword\Nationalities;

use App\Database\Models\Keyword\Nationality;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/keyword/nationalities/{id}';

    public function test()
    {
        $this->factory(Nationality::class)->create(['id' => 11]);
        $this->factory(Nationality::class)->create(['id' => 12]);

        $this->when(function () {

            $this->setRouteParameter('id', 11);

            $this->assertResultWithFinding(11);
        });

        $this->when(function () {

            $this->setRouteParameter('id', 12);

            $this->assertResultWithFinding(12);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {

            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

}
