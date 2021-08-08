<?php

namespace Tests\Functional\Keyword\Bodies;

use App\Database\Models\Keyword\Body;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/bodies';

    public function test()
    {
        $this->factory(Body::class)->create(['id' => 11]);
        $this->factory(Body::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
