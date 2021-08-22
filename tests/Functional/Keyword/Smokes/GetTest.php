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
    protected $uri = 'api/keyword/smokes';

    public function test()
    {
        Smoke::factory()->create(['id' => 11]);
        Smoke::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
