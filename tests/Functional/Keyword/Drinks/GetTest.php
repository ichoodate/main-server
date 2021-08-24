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
    protected $uri = 'keyword/drinks';

    public function test()
    {
        Drink::factory()->create(['id' => 11, 'type' => 'aaa']);
        Drink::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
