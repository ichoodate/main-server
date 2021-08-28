<?php

namespace Tests\Functional\Keyword\EduBgs;

use App\Models\Keyword\EduBg;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'keyword/education-backgrounds/{id}';

    public function test()
    {
        EduBg::factory()->create(['id' => 11, 'type' => 'aaa']);
        EduBg::factory()->create(['id' => 12, 'type' => 'bbb']);

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
