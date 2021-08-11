<?php

namespace Tests\Functional\Keyword\Hobbies;

use App\Database\Models\Keyword\Hobby;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/hobbies';

    public function test()
    {
        $this->factory(Hobby::class)->create(['id' => 11]);
        $this->factory(Hobby::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}