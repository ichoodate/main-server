<?php

namespace Tests\Functional\Keyword\EduBgs;

use App\Database\Models\Keyword\EduBg;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/keyword/edu-bgs/{id}';

    public function test()
    {
        $this->factory(EduBg::class)->create(['id' => 11]);
        $this->factory(EduBg::class)->create(['id' => 12]);

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
