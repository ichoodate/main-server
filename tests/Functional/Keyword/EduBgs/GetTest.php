<?php

namespace Tests\Functional\Keyword\EduBgs;

use App\Models\Keyword\EduBg;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/edu-bgs';

    public function test()
    {
        $this->factory(EduBg::class)->create(['id' => 11]);
        $this->factory(EduBg::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
