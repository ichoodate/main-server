<?php

namespace Tests\Functional\Localizables;

use App\Models\Localizable;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'localizables';

    public function test()
    {
        Localizable::factory()->create(['id' => 11]);
        Localizable::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });
    }
}
