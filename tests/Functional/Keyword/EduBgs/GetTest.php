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
    protected $uri = 'keyword/education-backgrounds';

    public function test()
    {
        EduBg::factory()->create(['id' => 11, 'type' => 'aaa']);
        EduBg::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
