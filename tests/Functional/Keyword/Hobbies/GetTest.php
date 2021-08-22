<?php

namespace Tests\Functional\Keyword\Hobbies;

use App\Models\Keyword\Hobby;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/hobbies';

    public function test()
    {
        Hobby::factory()->create(['id' => 11]);
        Hobby::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
