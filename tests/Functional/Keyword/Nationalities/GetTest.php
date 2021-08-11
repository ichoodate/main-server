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
    protected $uri = 'api/keyword/nationalities';

    public function test()
    {
        $this->factory(Nationality::class)->create(['id' => 11]);
        $this->factory(Nationality::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
