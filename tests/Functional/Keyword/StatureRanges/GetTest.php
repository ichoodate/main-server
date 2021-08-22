<?php

namespace Tests\Functional\Keyword\StatureRanges;

use App\Models\Keyword\StatureRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/stature-ranges';

    public function test()
    {
        StatureRange::factory()->create(['id' => 11]);
        StatureRange::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
