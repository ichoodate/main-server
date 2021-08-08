<?php

namespace Tests\Functional\Keyword\States;

use App\Database\Models\Keyword\State;
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
        $this->factory(State::class)->create(['id' => 11]);
        $this->factory(State::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
