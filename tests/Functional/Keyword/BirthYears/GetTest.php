<?php

namespace Tests\Functional\Keyword\BirthYears;

use App\Database\Models\Keyword\BirthYear;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/keyword/birth-years';

    public function test()
    {
        $this->factory(BirthYear::class)->create(['id' => 11]);
        $this->factory(BirthYear::class)->create(['id' => 12]);

        $this->when(function () {

            $this->assertResultWithListing([11, 12]);
        });
    }

}
