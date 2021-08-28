<?php

namespace Tests\Functional\Keyword\StatureRanges;

use App\Models\Keyword\StatureRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'keyword/stature-ranges/{id}';

    public function test()
    {
        StatureRange::factory()->create(['id' => 11, 'min' => 20, 'max' => 30]);
        StatureRange::factory()->create(['id' => 12, 'min' => 21, 'max' => 31]);

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
