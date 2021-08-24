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
    protected $uri = 'keyword/weights';

    public function test()
    {
        Weight::factory()->create(['id' => 11, 'type' => 50]);
        Weight::factory()->create(['id' => 12, 'type' => 51]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
