<?php

namespace Tests\Functional\Keyword\MaxStatureRanges;

use App\Models\Keyword\StatureRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/max-age-ranges';

    public function test()
    {
        StatureRange::factory()->create(['id' => 11, 'min' => 21]);
        StatureRange::factory()->create(['id' => 12, 'min' => 22]);
        StatureRange::factory()->create(['id' => 13, 'min' => 22]);

        $this->when(function () {
            $this->setInputParameter('min', 21);

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {
            $this->setInputParameter('min', 22);

            $this->assertResultWithFinding([12, 13]);
        });
    }
}
