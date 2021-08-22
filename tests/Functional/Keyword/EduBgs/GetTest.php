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
        EduBg::factory()->create(['id' => 11]);
        EduBg::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
