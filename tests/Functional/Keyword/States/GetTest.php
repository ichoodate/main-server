<?php

namespace Tests\Functional\Keyword\States;

use App\Models\Keyword\Country;
use App\Models\Keyword\State;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/states';

    public function test()
    {
        Country::factory()->create(['id' => 21]);
        Country::factory()->create(['id' => 22]);
        State::factory()->create(['id' => 11, 'country_id' => 21]);
        State::factory()->create(['id' => 12, 'country_id' => 22]);
        State::factory()->create(['id' => 13, 'country_id' => 22]);

        $this->when(function () {
            $this->setInputParameter('country_id', 21);

            $this->runService();

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {
            $this->setInputParameter('country_id', 22);

            $this->runService();

            $this->assertResultWithListing([12, 13]);
        });
    }
}
