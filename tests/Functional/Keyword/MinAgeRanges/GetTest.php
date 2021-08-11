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
    protected $uri = 'api/keyword/min-age-ranges';

    public function test()
    {
        $this->factory(AgeRange::class)->create(['id' => 11, 'max' => 21]);
        $this->factory(AgeRange::class)->create(['id' => 12, 'max' => 22]);
        $this->factory(AgeRange::class)->create(['id' => 13, 'max' => 22]);

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
