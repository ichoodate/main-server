<?php

namespace Tests\Functional\Keyword\Countries;

use App\Models\Keyword\Country;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/countries';

    public function test()
    {
        Country::factory()->create(['id' => 11]);
        Country::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
