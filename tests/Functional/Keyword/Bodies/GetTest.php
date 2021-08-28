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
    protected $uri = 'keyword/bodies';

    public function test()
    {
        Body::factory()->create(['id' => 11, 'type' => 'aaa']);
        Body::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });
    }
}
