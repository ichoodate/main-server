<?php

namespace Tests\Functional\Keyword\Weights;

use App\Models\Keyword\Weight;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'keyword/weights/{id}';

    public function test()
    {
        Weight::factory()->create(['id' => 11, 'type' => 50]);
        Weight::factory()->create(['id' => 12, 'type' => 51]);

        $this->when(function () {
            $this->setRouteParameter('id', 11);

            $this->runService();

            $this->assertResultWithFinding(11);
        });

        $this->when(function () {
            $this->setRouteParameter('id', 12);

            $this->runService();

            $this->assertResultWithFinding(12);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->runService();

            $this->assertError('abcd must be an integer.');
        });
    }
}
