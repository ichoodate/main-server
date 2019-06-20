<?php

namespace Tests\Functional\Api\Keyword\Statures;

use App\Database\Models\Keyword\Stature;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/statures';

    public function test()
    {
        $this->factory(Stature::class)->create(['id' => 11]);
        $this->factory(Stature::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
