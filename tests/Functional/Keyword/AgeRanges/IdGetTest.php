<?php

namespace Tests\Functional\Keyword\AgeRanges;

use App\Models\Keyword\AgeRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/keyword/age-ranges/{id}';

    public function test()
    {
        AgeRange::factory()->create(['id' => 11]);
        AgeRange::factory()->create(['id' => 12]);

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
