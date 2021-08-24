<?php

namespace Tests\Functional\Keyword\Smokes;

use App\Models\Keyword\Smoke;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'keyword/smokes/{id}';

    public function test()
    {
        Smoke::factory()->create(['id' => 11, 'type' => 'aaa']);
        Smoke::factory()->create(['id' => 12, 'type' => 'bbb']);

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
