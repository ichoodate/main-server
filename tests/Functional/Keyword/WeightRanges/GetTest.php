<?php

namespace Tests\Functional\Keyword\WeightRanges;

use App\Models\Keyword\WeightRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/weight-ranges';

    public function test()
    {
        WeightRange::factory()->create(['id' => 11]);
        WeightRange::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
