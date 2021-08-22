<?php

namespace Tests\Functional\Keyword\Careers;

use App\Models\Keyword\Career;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/careers';

    public function test()
    {
        Career::factory()->create(['id' => 11]);
        Career::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
