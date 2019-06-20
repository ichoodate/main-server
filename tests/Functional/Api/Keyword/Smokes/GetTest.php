<?php

namespace Tests\Functional\Api\Keyword\Smokes;

use App\Database\Models\Keyword\Smoke;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/smokes';

    public function test()
    {
        $this->factory(Smoke::class)->create(['id' => 11]);
        $this->factory(Smoke::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
