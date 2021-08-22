<?php

namespace Tests\Functional\Keyword\Bodies;

use App\Models\Keyword\Body;
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
        Body::factory()->create(['id' => 11]);
        Body::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
