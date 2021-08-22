<?php

namespace Tests\Functional\Notices;

use App\Models\Notice;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/notices/{id}';

    public function test()
    {
        Notice::factory()->create(['id' => 11]);
        Notice::factory()->create(['id' => 12]);

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

    public function testErrorNotNullRuleModel()
    {
        Notice::factory()->create(['id' => 11]);
        Notice::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('notice for 13 must exist.');
        });
    }
}
