<?php

namespace Tests\Functional\Keyword\Languages;

use App\Models\Keyword\Language;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/keyword/languages/{id}';

    public function test()
    {
        Language::factory()->create(['id' => 11]);
        Language::factory()->create(['id' => 12]);

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
