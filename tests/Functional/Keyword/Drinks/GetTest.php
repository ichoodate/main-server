<?php

namespace Tests\Functional\Keyword\Drinks;

use App\Database\Models\Keyword\Drink;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/drinks';

    public function test()
    {
        $this->factory(Drink::class)->create(['id' => 11]);
        $this->factory(Drink::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
