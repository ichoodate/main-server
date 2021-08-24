<?php

namespace Tests\Functional\Keyword\Residence;

use App\Models\Keyword\Residence;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'keyword/residences/{id}';

    public function test()
    {
        Residence::factory()->create(['id' => 11]);
        Residence::factory()->create(['id' => 12]);

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
