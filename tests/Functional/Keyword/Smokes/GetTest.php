<?php

namespace Tests\Functional\Keyword\Smokes;

use App\Models\Keyword\Smoke;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/smokes';

    public function test()
    {
        Smoke::factory()->create(['id' => 11, 'type' => 'aaa']);
        Smoke::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
