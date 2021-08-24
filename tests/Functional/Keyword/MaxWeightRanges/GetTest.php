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
    protected $uri = 'keyword/max-weight-ranges';

    public function test()
    {
        WeightRange::factory()->create(['id' => 11, 'min' => 21, 'max' => 31]);
        WeightRange::factory()->create(['id' => 12, 'min' => 22, 'max' => 32]);
        WeightRange::factory()->create(['id' => 13, 'min' => 22, 'max' => 33]);

        $this->when(function () {
            $this->setInputParameter('min', 21);

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {
            $this->setInputParameter('min', 22);

            $this->assertResultWithListing([12, 13]);
        });
    }
}
