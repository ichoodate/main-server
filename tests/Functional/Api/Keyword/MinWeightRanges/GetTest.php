<?php

namespace Tests\Functional\Api\Keyword\MinWeightRanges;

use App\Database\Models\Keyword\WeightRange;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/min-age-ranges';

    public function test()
    {
        $this->factory(WeightRange::class)->create(['id' => 11, 'max' => 21]);
        $this->factory(WeightRange::class)->create(['id' => 12, 'max' => 22]);
        $this->factory(WeightRange::class)->create(['id' => 13, 'max' => 22]);

        $this->when(function () {

            $this->setInputParameter('max', 21);

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {

            $this->setInputParameter('max', 22);

            $this->assertResultWithFinding([12, 13]);
        });
    }

}
