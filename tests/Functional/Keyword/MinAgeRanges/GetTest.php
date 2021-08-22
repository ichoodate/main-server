<?php

namespace Tests\Functional\Keyword\MinAgeRanges;

use App\Models\Keyword\AgeRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/min-age-ranges';

    public function test()
    {
        AgeRange::factory()->create(['id' => 11, 'max' => 21]);
        AgeRange::factory()->create(['id' => 12, 'max' => 22]);
        AgeRange::factory()->create(['id' => 13, 'max' => 22]);

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
