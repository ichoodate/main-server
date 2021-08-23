<?php

namespace Tests\Functional\Keyword\Bloods;

use App\Models\Keyword\Blood;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/bloods';

    public function test()
    {
        Blood::factory()->create(['id' => 11, 'type' => 'A']);
        Blood::factory()->create(['id' => 12, 'type' => 'B']);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
