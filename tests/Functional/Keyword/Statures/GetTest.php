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
    protected $uri = 'api/keyword/statures';

    public function test()
    {
        $this->factory(Stature::class)->create(['id' => 11]);
        $this->factory(Stature::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
