<?php

namespace Tests\Functional\Localizables;

use App\Models\Localizable;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/localizables/{id}';

    public function test()
    {
        Localizable::factory()->create(['id' => 11]);
        Localizable::factory()->create(['id' => 12]);

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
        $this->when(function () {
            Localizable::factory()->create(['id' => 11]);
            Localizable::factory()->create(['id' => 12]);

            $this->setRouteParameter('id', 13);

            $this->assertError('localizable for [id] must exist.');
        });
    }

    public function testErrorRequiredRuleId()
    {
        $this->when(function () {
            $this->assertError('[id] is required.');
        });
    }
}
