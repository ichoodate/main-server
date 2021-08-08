<?php

namespace Tests\Functional\Keyword\StatureRanges;

use App\Database\Models\Keyword\StatureRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/stature-ranges';

    public function test()
    {
        $this->factory(StatureRange::class)->create(['id' => 11]);
        $this->factory(StatureRange::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
