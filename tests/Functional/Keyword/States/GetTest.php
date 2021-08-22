<?php

namespace Tests\Functional\Keyword\States;

use App\Models\Keyword\State;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/states';

    public function test()
    {
        State::factory()->create(['id' => 11]);
        State::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
