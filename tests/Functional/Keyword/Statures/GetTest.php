<?php

namespace Tests\Functional\Keyword\Statures;

use App\Models\Keyword\Stature;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/statures';

    public function test()
    {
        Stature::factory()->create(['id' => 11]);
        Stature::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
