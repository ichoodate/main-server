<?php

namespace Tests\Functional\Keyword\BirthYears;

use App\Models\Keyword\BirthYear;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/birth-years';

    public function test()
    {
        BirthYear::factory()->create(['id' => 11]);
        BirthYear::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
