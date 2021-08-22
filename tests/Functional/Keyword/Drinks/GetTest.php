<?php

namespace Tests\Functional\Keyword\Drinks;

use App\Models\Keyword\Drink;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/drinks';

    public function test()
    {
        Drink::factory()->create(['id' => 11]);
        Drink::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
