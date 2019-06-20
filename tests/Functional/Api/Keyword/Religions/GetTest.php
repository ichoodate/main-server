<?php

namespace Tests\Functional\Api\Keyword\Religions;

use App\Database\Models\Keyword\Religion;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/religions';

    public function test()
    {
        $this->factory(Religion::class)->create(['id' => 11]);
        $this->factory(Religion::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
