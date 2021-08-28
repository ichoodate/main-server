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
    protected $uri = 'keyword/careers';

    public function test()
    {
        Career::factory()->create(['id' => 11]);
        Career::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });
    }
}
