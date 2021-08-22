<?php

namespace Tests\Functional\Keyword\Nationalities;

use App\Models\Keyword\Nationality;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/nationalities';

    public function test()
    {
        Nationality::factory()->create(['id' => 11]);
        Nationality::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
