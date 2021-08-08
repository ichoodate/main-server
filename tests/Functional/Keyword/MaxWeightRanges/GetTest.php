<?php

namespace Tests\Functional\Keyword\MaxWeightRanges;

use App\Database\Models\Keyword\WeightRange;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/max-age-ranges';

    public function test()
    {
        $this->factory(WeightRange::class)->create(['id' => 11, 'min' => 21]);
        $this->factory(WeightRange::class)->create(['id' => 12, 'min' => 22]);
        $this->factory(WeightRange::class)->create(['id' => 13, 'min' => 22]);

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
