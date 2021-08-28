<?php

namespace Tests\Functional\Keyword\Religions;

use App\Models\Keyword\Religion;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/religions';

    public function test()
    {
        Religion::factory()->create(['id' => 11, 'type' => 'aaa']);
        Religion::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });
    }
}
