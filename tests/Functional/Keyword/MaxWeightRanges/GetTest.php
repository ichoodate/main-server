<?php

namespace Tests\Functional\Keyword\MaxWeightRanges;

use App\Models\Keyword\WeightRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/max-age-ranges';

    public function test()
    {
        WeightRange::factory()->create(['id' => 11, 'min' => 21]);
        WeightRange::factory()->create(['id' => 12, 'min' => 22]);
        WeightRange::factory()->create(['id' => 13, 'min' => 22]);

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
