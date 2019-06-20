<?php

namespace Tests\Functional\Api\Keyword\Weights;

use App\Database\Models\Keyword\Weight;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/weights';

    public function test()
    {
        $this->factory(Weight::class)->create(['id' => 11]);
        $this->factory(Weight::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
