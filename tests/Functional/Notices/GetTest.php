<?php

namespace Tests\Functional\Notices;

use App\Models\Notice;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/notices';

    public function test()
    {
        Notice::factory()->create(['id' => 11]);
        Notice::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
