<?php

namespace Tests\Functional\Api\Keyword\Hobbies;

use App\Database\Models\Keyword\Hobby;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/keyword/hobbies/{id}';

    public function test()
    {
        $this->factory(Hobby::class)->create(['id' => 11]);
        $this->factory(Hobby::class)->create(['id' => 12]);

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
