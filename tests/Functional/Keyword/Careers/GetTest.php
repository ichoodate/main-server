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
        $this->factory(Career::class)->create(['id' => 11]);
        $this->factory(Career::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
