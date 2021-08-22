<?php

namespace Tests\Functional\Keyword\Weights;

use App\Models\Keyword\Weight;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/weights';

    public function test()
    {
        Weight::factory()->create(['id' => 11]);
        Weight::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
