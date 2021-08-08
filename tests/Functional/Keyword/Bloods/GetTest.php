<?php

namespace Tests\Functional\Keyword\Bloods;

use App\Database\Models\Keyword\Blood;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/bloods';

    public function test()
    {
        $this->factory(Blood::class)->create(['id' => 11]);
        $this->factory(Blood::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
