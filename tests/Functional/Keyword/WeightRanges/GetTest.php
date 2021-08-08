<?php

namespace Tests\Functional\Keyword\WeightRanges;

use App\Database\Models\Keyword\WeightRange;
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
        $this->factory(WeightRange::class)->create(['id' => 11]);
        $this->factory(WeightRange::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
