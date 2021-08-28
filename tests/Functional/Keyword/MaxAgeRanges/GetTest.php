<?php

namespace Tests\Functional\Keyword\MaxAgeRanges;

use App\Models\Keyword\AgeRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/max-age-ranges';

    public function test()
    {
        AgeRange::factory()->create(['id' => 11, 'min' => 21, 'max' => 31]);
        AgeRange::factory()->create(['id' => 12, 'min' => 22, 'max' => 32]);
        AgeRange::factory()->create(['id' => 13, 'min' => 22, 'max' => 33]);

        $this->when(function () {
            $this->setInputParameter('min', 21);

            $this->runService();

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {
            $this->setInputParameter('min', 22);

            $this->runService();

            $this->assertResultWithListing([12, 13]);
        });
    }
}
