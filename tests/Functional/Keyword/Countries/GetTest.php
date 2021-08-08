<?php

namespace Tests\Functional\Keyword\Countries;

use App\Database\Models\Keyword\Country;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/countries';

    public function test()
    {
        $this->factory(Country::class)->create(['id' => 11]);
        $this->factory(Country::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
