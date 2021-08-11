<?php

namespace Tests\Functional\Notices;

use App\Database\Models\Notice;
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
        $this->factory(Notice::class)->create(['id' => 11]);
        $this->factory(Notice::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}